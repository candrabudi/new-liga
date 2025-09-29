<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Game;
use App\Models\Website;

class HomeController extends Controller
{
    public function index()
    {
        $website = Website::first();
        $banners = Banner::all();

        $popularGameNames = [
            'Sweet Bonanza Super Scatter',
            'Mahjong Ways',
            'Mahjong Wins 3 – Black Scatter',
            'Wukong - Black Scatter',
            'Sticky Bandits Thunder Rail',
            'Bang Gacor 1000',
            'Le Viking',
            'Fortune Gems',
            'Mahjong Ways 2',
            'Gates of Olympus Super Scatter',
            'Wild Bounty Showdown',
            'Lucky Twins Nexus',
            'Nexus Koi Gate',
            'The Crypt',
            'Nexus Mahjong Jackpots',
            'Fire in the Hole 3',
            '777 Rush',
            'Hot Hot Nexus',
            'Le Pharaoh',
            'JetX',
        ];

        $popularGames = Game::whereIn('name', $popularGameNames)
            ->orderByRaw("FIELD(name, '".implode("','", $popularGameNames)."')")
            ->get();

        return view('mobile.home.index', compact('banners', 'website', 'popularGames'));
    }
}
