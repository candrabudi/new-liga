<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Provider;
use App\Models\Game;
use App\Models\Category;
use App\Models\ProviderCredential;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function slot($a)
    {
        return view('mobile.games.slot', compact('a'));
    }

    public function playGame($provider_id, $game_code)
    {
        $credential = ProviderCredential::first();
        $provider   = Provider::findOrFail($provider_id);
        $member     = Auth::user()->member;

        $response = Http::post('https://api.telo.is/api/v2/game_launch', [
            'agent_code'    => $credential->agent_code,
            'agent_token'   => $credential->agent_token,
            'user_code'     => $member->ext_code,
            'game_type'     => 'slot',
            'provider_code' => $provider->code,
            'game_code'     => $game_code,
            'lang'          => 'en',
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['status']) && $data['status'] == 1) {
            return redirect()->away($data['launch_url']); // langsung buka game
        }

        return back()->with('error', $data['msg'] ?? 'Gagal memulai game');
    }
    public function games($a)
    {
        $user = Auth::user();

        $provider = Provider::where('code', strtoupper($a))->first();
        $games = Game::with(['provider', 'categories'])
            ->where('provider_id', $provider->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        $response = $games->map(function ($game) use ($user) {
            return [
                "category"    => $game->main_category ?? "DEFAULT",
                "categories"  => $game->categories->map(function ($cat) {
                    return [
                        "name"  => $cat->name,
                        "seqNo" => $cat->pivot->seq_no ?? -1,
                    ];
                })->values(),
                "provider"    => $game->provider->id ?? 0,
                "providerId"  => $game->provider_id, // provider id wajib ada
                "name"        => $game->name,
                "gameCode"    => $game->game_code,
                "gameImage"   => $game->game_image,
                "link"        => $user
                    ? route('secret.games.play', [
                        'providerId' => $game->provider_id,
                        'gameCode'   => $game->game_code
                    ])
                    : "/mobile/login",
                "isFavourite" => $user
                    ? $user->favouriteGames->contains($game->id)
                    : false,
                "rtpValue"    => rand(95, 99) + (rand(0, 9) / 10),
                "rtpChanged"  => null,
            ];
        });

        return response()->json($response);
    }


    public function import()
    {
        $url = "https://ligamansion2ksto.site/mobile/slots/games/NOLIMITCITY";

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $gamesData = $response->json();

        $provider = Provider::firstOrCreate(
            ['code' => "NOLIMITCITY"],
            ['name' => strtoupper("NOLIMITCITY")]
        );

        $imported = 0;

        foreach ($gamesData as $gameData) {
            $game = Game::updateOrCreate(
                ['game_code' => $gameData['gameCode']],
                [
                    'provider_id'   => $provider->id,
                    'name'          => $gameData['name'],
                    'game_image'    => "https://dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/" . $gameData['gameImage'],
                    'main_category' => $gameData['category'] ?? 'DEFAULT',
                    'sort_order'    => 0,
                    'is_maintenance' => false,
                ]
            );

            foreach ($gameData['categories'] as $cat) {
                $category = Category::firstOrCreate(
                    ['name' => $cat['name']],
                    ['sort_order' => 0]
                );

                $game->categories()->syncWithoutDetaching([
                    $category->id => ['seq_no' => $cat['seqNo'] ?? -1]
                ]);
            }

            $imported++;
        }

        return response()->json([
            'message'   => "Imported {$imported} games for provider PGSOFT",
            'provider'  => $provider->code,
            'count'     => $imported
        ]);
    }
}
