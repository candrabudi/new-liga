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
                                        {{ number_format(round(Auth::user()->member->balance), 0, ',', '.') }}
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
