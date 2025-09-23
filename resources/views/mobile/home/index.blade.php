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

    @if (Auth::user())
        <div class="loyalty-info-container" id="loyalty_info_container" bis_skin_checked="1">
            <div class="loyalty-info" bis_skin_checked="1">
                <div class="loyalty-info-wrapper" bis_skin_checked="1">
                    <div class="loyalty-username-section" bis_skin_checked="1">
                        <span class="username">{{ Auth::user()->username }}</span>
                    </div>
                    <div class="user-info" bis_skin_checked="1">
                        <div class="balance-container" id="intro_wallet_balance" bis_skin_checked="1">
                            <div class="balance" bis_skin_checked="1">
                                <a href="#" data-toggle="dropdown">
                                    IDR
                                    <span class="total_balance">
                                        {{ round(Auth::user()->member->balance / 1000, 2) }}
                                    </span>
                                </a>
                                <div class="dropdown-menu vendor-balances-container" bis_skin_checked="1">
                                    <div class="vendor-balances-header" bis_skin_checked="1">
                                        <div bis_skin_checked="1">SALDO KREDIT</div>
                                        <div bis_skin_checked="1">0.00</div>
                                    </div>
                                    <div class="vendor-balances-content" bis_skin_checked="1">
                                        <div bis_skin_checked="1">
                                            <strong>Slots</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Slot88 x PP</div>
                                                    <div data-vendor-game-code="40" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">PG Soft</div>
                                                    <div data-vendor-game-code="9" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Pragmatic Play</div>
                                                    <div data-vendor-game-code="7" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fat Panda</div>
                                                    <div data-vendor-game-code="112" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">No Limit City</div>
                                                    <div data-vendor-game-code="92" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Jili</div>
                                                    <div data-vendor-game-code="70" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Habanero</div>
                                                    <div data-vendor-game-code="16" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">MicroGaming</div>
                                                    <div data-vendor-game-code="17" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">5GG</div>
                                                    <div data-vendor-game-code="114" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Spade Gaming</div>
                                                    <div data-vendor-game-code="29" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fast Spin</div>
                                                    <div data-vendor-game-code="110" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Joker</div>
                                                    <div data-vendor-game-code="6" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fachai</div>
                                                    <div data-vendor-game-code="72" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">AdvantPlay</div>
                                                    <div data-vendor-game-code="54" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Naga Games</div>
                                                    <div data-vendor-game-code="87" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">JDB</div>
                                                    <div data-vendor-game-code="51" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Playstar</div>
                                                    <div data-vendor-game-code="65" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Spinix</div>
                                                    <div data-vendor-game-code="91" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Crowd Play</div>
                                                    <div data-vendor-game-code="73" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Bigpot</div>
                                                    <div data-vendor-game-code="75" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">ION Slot</div>
                                                    <div data-vendor-game-code="50" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">VPower</div>
                                                    <div data-vendor-game-code="77" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">AMB Slot</div>
                                                    <div data-vendor-game-code="61" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Worldmatch</div>
                                                    <div data-vendor-game-code="89" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Octoplay</div>
                                                    <div data-vendor-game-code="109" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Mario Club</div>
                                                    <div data-vendor-game-code="80" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Dragoonsoft</div>
                                                    <div data-vendor-game-code="81" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fun Gaming</div>
                                                    <div data-vendor-game-code="79" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Funky Games</div>
                                                    <div data-vendor-game-code="35" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Live22</div>
                                                    <div data-vendor-game-code="45" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">CQ9</div>
                                                    <div data-vendor-game-code="13" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Netent</div>
                                                    <div data-vendor-game-code="94" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Big Time Gaming</div>
                                                    <div data-vendor-game-code="95" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Red Tiger</div>
                                                    <div data-vendor-game-code="93" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Skywind</div>
                                                    <div data-vendor-game-code="90" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Yggdrasil</div>
                                                    <div data-vendor-game-code="42" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Play'n Go</div>
                                                    <div data-vendor-game-code="18" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Live Casino</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">ION Casino</div>
                                                    <div data-vendor-game-code="1" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">PP Casino</div>
                                                    <div data-vendor-game-code="41" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">MG Live</div>
                                                    <div data-vendor-game-code="66" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Evo Gaming</div>
                                                    <div data-vendor-game-code="38" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Ping Pong</div>
                                                    <div data-vendor-game-code="105" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Sexy Baccarat</div>
                                                    <div data-vendor-game-code="27" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Pretty Gaming</div>
                                                    <div data-vendor-game-code="39" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Oriental Gaming</div>
                                                    <div data-vendor-game-code="100" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Asia Gaming</div>
                                                    <div data-vendor-game-code="14" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">AllBet</div>
                                                    <div data-vendor-game-code="44" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">SA Gaming</div>
                                                    <div data-vendor-game-code="84" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Ebet</div>
                                                    <div data-vendor-game-code="85" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Dream Gaming</div>
                                                    <div data-vendor-game-code="43" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">568Win Casino</div>
                                                    <div data-vendor-game-code="10" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Race</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Togel</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Nex4D</div>
                                                    <div data-vendor-game-code="48" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Olahraga</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">SBO Sportsbook</div>
                                                    <div data-vendor-game-code="5" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Saba Sportsbook</div>
                                                    <div data-vendor-game-code="23" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">WBet</div>
                                                    <div data-vendor-game-code="69" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">CMD</div>
                                                    <div data-vendor-game-code="83" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Opus</div>
                                                    <div data-vendor-game-code="71" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">IM Sportsbook</div>
                                                    <div data-vendor-game-code="86" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">UMbet</div>
                                                    <div data-vendor-game-code="102" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fairbet</div>
                                                    <div data-vendor-game-code="103" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">SBO Virtual Sports</div>
                                                    <div data-vendor-game-code="11" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">PP Virtual Sports</div>
                                                    <div data-vendor-game-code="55" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Crash Game</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">PP Casino</div>
                                                    <div data-vendor-game-code="41" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Aviator</div>
                                                    <div data-vendor-game-code="82" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">MicroGaming</div>
                                                    <div data-vendor-game-code="17" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Spinix</div>
                                                    <div data-vendor-game-code="91" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Gemini</div>
                                                    <div data-vendor-game-code="107" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">AdvantPlay Mini Game</div>
                                                    <div data-vendor-game-code="62" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Joker</div>
                                                    <div data-vendor-game-code="6" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Dragoonsoft</div>
                                                    <div data-vendor-game-code="81" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Funky Games</div>
                                                    <div data-vendor-game-code="35" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Arcade</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">MicroGaming</div>
                                                    <div data-vendor-game-code="17" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Jili</div>
                                                    <div data-vendor-game-code="70" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Gemini</div>
                                                    <div data-vendor-game-code="107" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Aviator</div>
                                                    <div data-vendor-game-code="82" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fachai</div>
                                                    <div data-vendor-game-code="72" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Joker</div>
                                                    <div data-vendor-game-code="6" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Spinix</div>
                                                    <div data-vendor-game-code="91" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">AMB Slot</div>
                                                    <div data-vendor-game-code="61" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Crowd Play</div>
                                                    <div data-vendor-game-code="73" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">VPower</div>
                                                    <div data-vendor-game-code="77" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Worldmatch</div>
                                                    <div data-vendor-game-code="89" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Mario Club</div>
                                                    <div data-vendor-game-code="80" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Dragoonsoft</div>
                                                    <div data-vendor-game-code="81" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">CQ9</div>
                                                    <div data-vendor-game-code="13" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Fun Gaming</div>
                                                    <div data-vendor-game-code="79" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">MM Tangkas</div>
                                                    <div data-vendor-game-code="96" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Skywind</div>
                                                    <div data-vendor-game-code="90" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">JDB</div>
                                                    <div data-vendor-game-code="51" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">Funky Games</div>
                                                    <div data-vendor-game-code="35" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Poker</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">9Gaming</div>
                                                    <div data-vendor-game-code="32" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>E-Sports</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">TF Gaming</div>
                                                    <div data-vendor-game-code="58" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div bis_skin_checked="1">
                                            <strong>Sabung Ayam</strong>
                                            <div class="vendor-balance-item" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <div bis_skin_checked="1">SV388</div>
                                                    <div data-vendor-game-code="57" bis_skin_checked="1">
                                                        0.00 </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="refresh-container" bis_skin_checked="1">
                        <button title="Refresh" class="refresh_balance" data-loading="true">
                            <picture>
                                <source
                                    srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/refresh.webp?v=20250528"
                                    type="image/webp">
                                <source
                                    srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/refresh.png?v=20250528"
                                    type="image/png"><img alt="Refresh Balance" loading="lazy"
                                    src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/refresh.png?v=20250528">
                            </picture>
                        </button>
                    </div>
                </div>
                <div class="locked-balance-wrapper" id="wallet_container" data-locked-balance="false"
                    bis_skin_checked="1">
                    <div class="locked-balance" bis_skin_checked="1">
                        <span class="locked-balance-label">
                            Lock Balance
                        </span>
                        <div class="locked-balance-value" bis_skin_checked="1">
                            <img alt="Locked Balance" loading="lazy"
                                src="//dsuown9evwz4y.cloudfront.net/Images/icons/wallet/lock-balance.svg?v=20250528">
                            IDR
                            <span class="total_locked_balance">
                                0.00
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loyalty-experience" id="loyalty_experience" bis_skin_checked="1">
                <div class="experience-point-section" id="intro_loyalty_section" bis_skin_checked="1">
                    <a href="/mobile/loyalty/benefits" class="loyalty-experience-link">
                        <div class="loyalty-point-badge" bis_skin_checked="1">
                            <img class="loyalty_level"
                                data-image-path="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/loyalty/badge/"
                                loading="lazy"
                                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/loyalty/badge/bronze.svg?v=20250528">
                            <span class="loyalty-level">bronze</span>
                        </div>
                        <div class="loyalty-experience-wrapper" id="intro_loyalty_experience" bis_skin_checked="1">
                            <div class="xp-label" bis_skin_checked="1">EXP</div>
                            <div class="loyalty-experience-progress" bis_skin_checked="1">
                                <span id="loyalty_experience_percentage">0%</span>
                                <div class="progress loyalty_experience_progress" style="width: 0%" bis_skin_checked="1">
                                </div>
                            </div>
                            <div class="loyalty-pointer-right" bis_skin_checked="1"></div>
                        </div>
                    </a>
                </div>
                <div class="loyalty-point-section" id="intro_loyalty_point" bis_skin_checked="1">
                    <a href="/mobile/loyalty/rewards" class="loyalty-experience-link">
                        <div class="loyalty-point-title" bis_skin_checked="1">
                            <img alt="Loyalty Point Icon" loading="lazy"
                                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/loyalty/loyalty-point-icon.svg?v=20250528">
                            <span>Loyalty Point</span>
                        </div>
                        <div class="loyalty-point-info" id="loyalty_point_info" bis_skin_checked="1">
                            <div class="loyalty-point-info-lp" bis_skin_checked="1">
                                <div class="lp-label" bis_skin_checked="1">LP</div>
                                <div class="loyalty-point loyalty_point" bis_skin_checked="1">0</div>
                            </div>
                            <div class="loyalty-pointer-right" bis_skin_checked="1"></div>
                        </div>
                    </a>
                </div>
                <div class="chest-section" bis_skin_checked="1">
                    <div class="daily-reward daily_reward_button" data-platform="Mobile"
                        data-daily-reward-available="true"
                        style="--chest-claimed-background: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/loyalty/chest-claimed.webp?v=20250528);
            --chest-available-background: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/loyalty/chest-available.webp?v=20250528);"
                        bis_skin_checked="1">
                        <a class="btn daily-reward-button" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
            <a href="register.html" class="register-button">
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
                                JULI - 31 AGUSTUS 2025</span>&nbsp;)</strong></h3>
                    <p style="text-align: center;"><strong>Link Alternatif {{ $website->website_name }} :</strong></p>
                    <table
                        style="height: 140px; width: 33.474%; border-collapse: collapse; background-color: #393838; border-color: #ffffff; margin-left: auto; margin-right: auto;"
                        border="1">
                        <tbody style="padding-left: 40px;">
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><strong><span
                                            style="color: #ffcc00;"><a style="color: #ffcc00;"
                                                href="https://resmi.vip/lm2">Link Alternatif 2</a></span></strong>
                                </td>
                            </tr>
                            <tr style="padding-left: 40px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://resmi.vip/lm2">Link Alternatif 2</a></strong></span>
                                </td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://resmi.vip/lm2">Link Alternatif 3</a></strong></span>
                                </td>
                            </tr>
                            <tr style="height: 35px;">
                                <td style="width: 254.708px; text-align: center; height: 35px;"><span
                                        style="color: #ffcc00;"><strong><a style="color: #ffcc00;"
                                                href="https://resmi.vip/lm2">Link Alternatif 4</a></strong></span>
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
