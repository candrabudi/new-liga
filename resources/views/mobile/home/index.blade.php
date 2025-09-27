@extends('mobile.template.app')

@section('content')
    <div class="announcement-container">
        <div data-section="date">
            <i data-icon="news"
                style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/news.svg?v=20250528);"></i>
        </div>
        <div data-section="announcements">
            <ul class="announcement-list" id="announcement_list">
                <li>Pemeliharaan Terjadwal: AdvantPlay Mini Game pada 17-Agt-2025 dari 20.02.52 sampai 08-Agt-2026
                    23.57.58. Selama waktu ini, AdvantPlay Mini Game permainan tidak akan tersedia. Kami memohon maaf
                    atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                <li>Pemeliharaan Terjadwal: Spinix pada 01-Okt-2024 dari 23.00.00 sampai 31-Des-2025 23.59.59. Selama
                    waktu ini, Spinix permainan tidak akan tersedia. Kami memohon maaf atas ketidaknyamanan yang mungkin
                    ditimbulkan.</li>
                <li>Pemeliharaan Terjadwal: Fairbet pada 14-Jan-2025 dari 12.00.00 sampai 01-Jan-2026 00.00.00. Selama
                    waktu ini, Fairbet permainan tidak akan tersedia. Kami memohon maaf atas ketidaknyamanan yang
                    mungkin ditimbulkan.</li>
                <li>Pemeliharaan Terjadwal: PP Virtual Sports pada 06-Des-2024 dari 21.36.12 sampai 31-Des-2025
                    12.00.00. Selama waktu ini, PP Virtual Sports permainan tidak akan tersedia. Kami memohon maaf atas
                    ketidaknyamanan yang mungkin ditimbulkan.</li>
            </ul>
        </div>
    </div>

   @include('mobile.components.head_balance')
    <div class="banner">
        <div id="banner_carousel" class="banner-carousel">
            @foreach ($banners as $banner)
                <div class="">
                    <a href="#" target="_self" rel="">
                        <img src="{{ $banner->image_path }}" alt="{{ $website->website_name }}"
                            title="{{ $website->website_name }}" loading="eager" fetchpriority="high" width="1920"
                            height="600" />
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    @if (!Auth::user())
        <div class="login-links-container">
            <a href="/mobile/register" class="register-button">
                Daftar
            </a>
            <a data-require-login class="login-button">
                Masuk
            </a>
        </div>
    @endif

    <div data-section="jackpot">
        <a href="slots/pragmaticb421.html?PromotionCategory=Jackpot+Play+Games">
            <div class="home-progressive-jackpot">
                <div class="jackpot-play-section">
                    <div>
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/jackpot/jackpot-play-logo-v2.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/jackpot/jackpot-play-logo-v2.png?v=20250528"
                                type="image/png" /><img alt="Jackpot Play" height="56" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/jackpot/jackpot-play-logo-v2e252.png?v=20250528"
                                width="250" />
                        </picture>
                        <div class="jackpot-play-text">Jackpot <label>Play</label></div>
                    </div>
                </div>
                <div class="jackpot-container">
                    <div class="jackpot-inner-container">
                        <div class="jackpot-border-container">
                            <span class="jackpot-currency">IDR</span>
                            <span id="progressive_jackpot"
                                data-progressive-jackpot-url="https://jp-api2.namesvr.dev"></span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <div class="main-menu-outer-container" id="main_menu_outer_container">
        <i class="glyphicon glyphicon-chevron-left left_trigger"></i>
        <main>
            <a href="hot-games.html" data-game-category="Unknown" data-active="false">
                <img alt="Hot Games" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/hot-games.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/hot-games-active.svg?v=20250528);"
                    width="25" />
                Hot Games
            </a>
            <a href="slots.html" data-game-category="Slots" data-active="false">
                <img alt="Slots" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/slots.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/slots-active.svg?v=20250528);"
                    width="25" /> Slots
            </a>
            <a href="casino.html" data-game-category="Casino" data-active="false">
                <img alt="Live Casino" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/casino.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/casino-active.svg?v=20250528);"
                    width="25" /> Live Casino
            </a>
            <a href="race.html" data-game-category="Race" data-active="false">
                <img alt="Race" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/race.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/race-active.svg?v=20250528);"
                    width="25" /> Race
            </a>
            <a href="others.html" data-game-category="Others" data-active="false">
                <img alt="Togel" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/others.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/others-active.svg?v=20250528);"
                    width="25" /> Togel
            </a>
            <a href="sport.html" data-game-category="Sports" data-active="false">
                <img alt="Olahraga" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/sports.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/sports-active.svg?v=20250528);"
                    width="25" /> Olahraga
            </a>
            <a href="crash-game.html" data-game-category="CrashGame" data-active="false">
                <img alt="Crash Game" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/crash-game.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/crash-game-active.svg?v=20250528);"
                    width="25" /> Crash Game
            </a>
            <a href="arcade.html" data-game-category="Arcade" data-active="false">
                <img alt="Arcade" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/arcade.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/arcade-active.svg?v=20250528);"
                    width="25" /> Arcade
            </a>
            <a href="poker.html" data-game-category="Poker" data-active="false">
                <img alt="Poker" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/poker.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/poker-active.svg?v=20250528);"
                    width="25" /> Poker
            </a>
            <a href="e-sports.html" data-game-category="ESports" data-active="false">
                <img alt="E-Sports" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/e-sports.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/e-sports-active.svg?v=20250528);"
                    width="25" /> E-Sports
            </a>
            <a href="cockfight.html" data-game-category="Cockfight" data-active="false">
                <img alt="Sabung Ayam" height="25" loading="lazy"
                    src="http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/cockfight.svg?v=20250528"
                    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/menu/cockfight-active.svg?v=20250528);"
                    width="25" /> Sabung Ayam
            </a>
        </main>
        <i class="glyphicon glyphicon-chevron-right right_trigger"></i>
    </div>


    <div id="menu_preview_container" class="menu-preview-container">
        <div class="game-list-container" data-game-category="Unknown">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Slots">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Casino">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Race">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Others">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Sports">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="CrashGame">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Arcade">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Poker">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="ESports">
            <div class="game-list"></div>
        </div>
        <div class="game-list-container" data-game-category="Cockfight">
            <div class="game-list"></div>
        </div>
    </div>



    <div class="popular-game-title-container">
        <div class="container-title">
            <span>Game Populer</span>
        </div>
        <div class="container-content" id="popular_game_container">
            <i class="left-chevron left_trigger"
                style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/icons/chevron-down.svg?v=20250528);"></i>
            <div class="game-list">
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Sweet Bonanza Super Scatter">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20swbonsup.webp?v=20250528"
                                type="image/webp" />
                            <source srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20swbonsup.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Sweet Bonanza Super Scatter" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20swbonsupe252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Sweet Bonanza Super Scatter</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Mahjong Ways">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_65.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_65.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Mahjong Ways" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_65e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Mahjong Ways</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Mahjong Wins 3 – Black Scatter">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vswaysmahwblck.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vswaysmahwblck.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Mahjong Wins 3 – Black Scatter" height="100"
                                loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PP/vswaysmahwblcke252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Mahjong Wins 3 – Black Scatter</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Wukong - Black Scatter">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vswayswkngblck.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vswayswkngblck.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Wukong - Black Scatter" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vswayswkngblcke252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Wukong - Black Scatter</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Sticky Bandits Thunder Rail">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PLAYTECH/pop_001378cc_qsp.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PLAYTECH/pop_001378cc_qsp.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Sticky Bandits Thunder Rail" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PLAYTECH/pop_001378cc_qspe252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Sticky Bandits Thunder Rail</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Bang Gacor 1000">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vs20gacorx.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vs20gacorx.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Bang Gacor 1000" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/SLOT88/vs20gacorxe252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Bang Gacor 1000</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Le Viking">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1689.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1689.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Le Viking" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1689e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Le Viking</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Fortune Gems">
                        <picture>
                            <source srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/JILI/JILI_109.webp?v=20250528"
                                type="image/webp" />
                            <source srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/JILI/JILI_109.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Fortune Gems" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/JILI/JILI_109e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Fortune Gems</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Mahjong Ways 2">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_74.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_74.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Mahjong Ways 2" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_74e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Mahjong Ways 2</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Gates of Olympus Super Scatter">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20olympgold.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20olympgold.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Gates of Olympus Super Scatter" height="100"
                                loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PP/vs20olympgolde252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Gates of Olympus Super Scatter</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Wild Bounty Showdown">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Wild Bounty Showdown" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Wild Bounty Showdown</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Lucky Twins Nexus">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexus.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexus.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Lucky Twins Nexus" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexuse252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Lucky Twins Nexus</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Nexus Koi Gate">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGNexusKoiGate.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGNexusKoiGate.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Nexus Koi Gate" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGNexusKoiGatee252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Nexus Koi Gate</div>
                    </a>
                    <a href="?login" class="game-item" data-game="The Crypt">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000.jpg?v=20250528"
                                type="image/jpeg" /><img alt="The Crypt" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">The Crypt</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Nexus Mahjong Jackpots">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_nexusMahjongJackpots.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_nexusMahjongJackpots.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Nexus Mahjong Jackpots" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/MICROGAMING/SMG_nexusMahjongJackpotse252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Nexus Mahjong Jackpots</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Fire in the Hole 3">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/fireinthehole300.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/fireinthehole300.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Fire in the Hole 3" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/NOLIMITCITY/fireinthehole300e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Fire in the Hole 3</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="777 Rush">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/FATPANDA/vs5t8goldfp.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/FATPANDA/vs5t8goldfp.jpg?v=20250528"
                                type="image/jpeg" /><img alt="777 Rush" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/FATPANDA/vs5t8goldfpe252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">777 Rush</div>
                    </a>
                    <a href="?login" class="game-item" data-game="Hot Hot Nexus">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGHotHotNexus.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGHotHotNexus.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Hot Hot Nexus" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/HABANERO/SGHotHotNexuse252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Hot Hot Nexus</div>
                    </a>
                </div>
                <div class="games-group">
                    <a href="?login" class="game-item" data-game="Le Pharaoh">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1562.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1562.jpg?v=20250528"
                                type="image/jpeg" /><img alt="Le Pharaoh" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1562e252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">Le Pharaoh</div>
                    </a>
                    <a href="?login" class="game-item" data-game="JetX">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SMARTSOFT/JetX_JetX.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/providers/SMARTSOFT/JetX_JetX.jpg?v=20250528"
                                type="image/jpeg" /><img alt="JetX" height="100" loading="lazy"
                                src="dsuown9evwz4y.cloudfront.net/Images/providers/SMARTSOFT/JetX_JetXe252.jpg?v=20250528"
                                width="100" />
                        </picture>
                        <div class="game-name">JetX</div>
                    </a>
                </div>
            </div>
            <i class="right-chevron right_trigger"
                style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/icons/chevron-down.svg?v=20250528);"></i>
        </div>
    </div>


    <div id="popup_modal" class="modal popup-modal" role="dialog"
        data-title="INFORMASI UNTUK MEMBER {{ $website->website_name }}" aria-label="Popup Modal">
        <div class="modal-dialog">
            <div class="modal-content"
                style="--desktop-popup-alert-src: url(dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/desktop/layout/popup/alerte252.png?v=20250528);;--desktop-popup-notification-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/desktop/layout/popup/notification.png?v=20250528);;--mobile-popup-alert-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/popup/alert.png?v=20250528);;--mobile-popup-notification-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/popup/notification.png?v=20250528);;--event-giveaway-popper-src: url(//dsuown9evwz4y.cloudfront.net/Images/giveaway/popper.png?v=20250528);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="popup_modal_title">
                        INFORMASI UNTUK MEMBER {{ $website->website_name }}
                    </h4>
                </div>
                <div class="modal-body" id="popup_modal_body">
                    <p></p>
                    <h3 style="text-align: center;"><strong>Kami Menyediakan <span style="color: #ffcc00;">Event
                                Loyalty</span> Untuk member {{ $website->website_name }} ( <span
                                style="color: #ffcc00;">PERIODE TGL 1
                                JULI - 31 AGUSTUS 2026</span>&nbsp;)</strong></h3>
                    <p style="text-align: center;"><strong>Link Alternatif {{ $website->website_name }} :</strong></p>
                    <table
                        style="height: 140px; width: 33.474%; border-collapse: collapse; background-color: #393838; border-color: #ffffff; margin-left: auto; margin-right: auto;"
                        border="1">
                        <tbody style="padding-left: 40px;">
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><strong><span
                                            style="color: #ffcc00;"><a style="color: #ffcc00;"
                                                href="https://heylink.me/jakartabetting69/">Link Alternatif 2</a></span></strong>
                                </td>
                            </tr>
                            <tr style="padding-left: 40px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://heylink.me/jakartabetting69/">Link Alternatif 2</a></strong></span>
                                </td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://heylink.me/jakartabetting69/">Link Alternatif 3</a></strong></span>
                                </td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://heylink.me/jakartabetting69/">Link Alternatif 4</a></strong></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;"><strong>Silahkan di simpan dan bookmark di browser anda untuk
                            kemudahan dan kenyaman bermain<br /></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        id="popup_modal_dismiss_button">
                        OK
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="popup_modal_cancel_button" style="display: none">
                        Tidak
                    </button>
                    <button type="button" class="btn btn-primary" id="popup_modal_confirm_button"
                        style="display: none">
                        Ya
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @include('mobile.components.all_app')
@endsection
