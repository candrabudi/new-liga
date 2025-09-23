<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdateGameController extends Controller
{
    public function getGameList()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('https://api.telo.is/api/v2/game_list', [
            'agent_code'   => 'bareverplay389',
            'agent_token'  => '177191891f51fcadcf8b768f11fcf0a7',
            'provider_code' => 'CQ9',
            'lang'         => 'en',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // return $data;
            if ($data['status'] == 1) {
                foreach ($data['games'] as $gm) {
                    $game = Game::where('name', $gm['game_name'])
                        ->first();

                    if ($game) {
                        $game->game_code = $gm['game_code'];
                        $game->save();
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => $data['msg'],
                    'games'   => $data['games'],
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['msg'] ?? 'Unknown error',
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to connect API',
        ], $response->status());
    }
}
