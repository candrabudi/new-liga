@php
    use App\Models\Contact;
    $contacts = Contact::all();
@endphp
<footer class="site-footer">
    <ul class="contact-list">
        @foreach ($contacts as $contact)
            @if ($contact->platform == 'telegram')
                <li>
                    <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow">
                        <i>
                            <img alt="telegram" height="18" loading="lazy"
                                src="http://dsuown9evwz4y.cloudfront.net/Images/communications/telegram.svg?v=20250528"
                                width="18" />
                        </i>
                        {{ '@'.$contact->name }}
                    </a>
                </li>
            @endif

            @if ($contact->platform == 'whatsapp')
                <li>
                    <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow">
                        <i>
                            <img alt="telegram" height="18" loading="lazy"
                                src="http://dsuown9evwz4y.cloudfront.net/Images/communications/telegram.svg?v=20250528"
                                width="18" />
                        </i>
                        {{ $contact->name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    <h2>Metode Pembayaran</h2>
    <ul class="bank-list">
        <li>
            <div data-online="true">
                <picture>
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/QR.webp?v=20250528"
                        type="image/webp" />
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/QR.png?v=20250528"
                        type="image/png" /><img alt="NXPAY DEPOSIT QR" height="40" loading="lazy"
                        src="../../dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/QRe252.png?v=20250528"
                        width="80" />
                </picture>
            </div>
        </li>
        <li>
            <div data-online="true">
                <picture>
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/VA.webp?v=20250528"
                        type="image/webp" />
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/VA.png?v=20250528"
                        type="image/png" /><img alt="NXPAY DEPOSIT VA BCA" height="40" loading="lazy"
                        src="../../dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/VAe252.png?v=20250528"
                        width="80" />
                </picture>
            </div>
        </li>
        <li>
            <div data-online="true">
                <picture>
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/OVO.webp?v=20250528"
                        type="image/webp" />
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/OVO.png?v=20250528"
                        type="image/png" /><img alt="NXPAY DEPOSIT EMONEY OVO" height="40" loading="lazy"
                        src="../../dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/OVOe252.png?v=20250528"
                        width="80" />
                </picture>
            </div>
        </li>
        <li>
            <div data-online="true">
                <picture>
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/DANA.webp?v=20250528"
                        type="image/webp" />
                    <source srcset="//dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/DANA.png?v=20250528"
                        type="image/png" /><img alt="NXPAY DEPOSIT EMONEY DANA" height="40" loading="lazy"
                        src="../../dsuown9evwz4y.cloudfront.net/Images/footer/bank-list/DANAe252.png?v=20250528"
                        width="80" />
                </picture>
            </div>
        </li>

        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/BCA_e1bab23f-dda6-4835-b3ce-d5039f28546c_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/BNI_3d30334c-d871-46fb-80b3-0fcb12f99b87_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/BRI_a458ab91-91a3-49ac-98b3-1bfc5d1966bd_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/DANA_cb3bce7a-fa0c-4d8c-93c7-e6e4b5a0a18c_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/GOPAY_fa571dd7-0add-44fa-9aef-184f8fb1a66d_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/LINKAJA_1ad00c17-5bb0-49f6-896c-57408f81777b_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/MANDIRI_ec4427ff-2e6e-4657-a2fe-b3702bc15e7c_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/OVO_ddd6e876-f366-4b0b-a506-d0e8210c55e9_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/QRIS_54c3e101-286b-4bd9-908a-29835a548e8a_1722478644047.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/TELKOMSEL_708c135d-74c5-482f-9d03-27a5f7035c60_1713031468740.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
        <li>
            <div data-online="true">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/XL_ea2a82b1-ca96-4eb1-9a52-cf378c6405e7_1713031481760.png"
                    width="80" height="40" alt="-" loading="lazy" />
            </div>
        </li>
    </ul>
    <h2>Tetap terhubung dengan kami</h2>
    <ul class="social-media-list">
        <li>
            <a href="https://t.me/{{ $website->website_name }}" target="_blank" rel="nofollow">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/Telegram_8cce9d2b-6b34-4b97-8b2d-f5b4efdfd7fb_1599462102260.png"
                    alt="-" width="32" height="32" loading="lazy" />
            </a>
        </li>
        <li>
            <a href="https://www.instagram.com/{{ $website->website_name }}/" target="_blank" rel="nofollow">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/Intagram_ef828ab4-d3d4-4173-9bc7-aba72f288a7e_1602839509807.png"
                    alt="-" width="32" height="32" loading="lazy" />
            </a>
        </li>
        <li>
            <a href="https://www.facebook.com/{{ $website->website_name }}/" target="_blank" rel="nofollow">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/Facebook_10baf2ba-78f9-4e11-9da1-ed3414c8d560_1602839528260.png"
                    alt="-" width="32" height="32" loading="lazy" />
            </a>
        </li>
        <li>
            <a href="https://twitter.com/{{ $website->website_name }}" target="_blank" rel="nofollow">
                <img src="../../api2-lm2.imgnxb.com/images/3EVO99w9oUw/Twitter_2f8bb764-3e6c-46bc-88b6-4c38354cf7d5_1602839546807.png"
                    alt="-" width="32" height="32" loading="lazy" />
            </a>
        </li>
    </ul>
    <ul class="footer-links">
        <li>
            <a href="about-us.html">Tentang {{ $website->website_name }}</a>
        </li>
        <li>
            <a href="responsible-gaming.html">Responsible Gambling</a>
        </li>
        <li>
            <a href="faq.html">Pusat Bantuan</a>
        </li>
        <li>
            <a href="terms-of-use.html">Syarat dan Ketentuan</a>
        </li>
    </ul>
    <div class="site-description">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ $website->website_name }}: Link Situs Slot Online Gacor Hari Ini Judi Slot88 Resmi Terbaru Terpercaya
                        2025</h1>
                    Selamat datang di {{ $website->website_name }}! Sebagai salah satu situs slot gacor terpercaya di Indonesia,
                    kami bekerja sama dengan penyedia judi slot88 resmi untuk menyajikan RTP slot online yang
                    transparan serta ribuan game terbaru. Tidak hanya slot online, kami juga menawarkan beragam
                    permainan seru seperti Live Casino, Judi Bola, Tembak Ikan, Togel Online, dan Arcade Games.
                    Dengan layanan customer service 24 jam siap membantu, proses deposit, withdraw, maupun panduan
                    permainan Anda akan lebih mudah dan lancar.

                    <h3>Raih Jackpot Hari Ini & Rasakan Sensasi Menang Berlipat!</h3>

                    <p>Bosan dengan situs slot biasa yang menjanjikan tapi tak membuahkan kemenangan? {{ $website->website_name }}
                        hadir sebagai solusi terbaik bagi para pencinta slot online di Indonesia! Sebagai link situs
                        slot gacor maxwin hari ini terpercaya, kami tak cuma menawarkan janji, tapi bukti nyata
                        kemenangan yang diraih member setiap harinya. Dengan RTP slot tertinggi (hingga 98,75%!) dan
                        koleksi game dari provider premium, peluang Anda meraih maxwin jutaan rupiah terbuka lebar!
                    </p>

                    <h3>✨ Mengapa {{ $website->website_name }} Jadi Pilihan Utama Slot Gacor Gampang Menang?</h3>
                    <ul>
                        <li><strong>WIN RATE TINGGI & RTP LIVE TERUPDATE:</strong> Kami menyajikan info RTP slot
                            gacor hari ini secara real-time! Bermain di sini berarti Anda punya akses ke mesin slot
                            dengan persentase pembayaran tertinggi, dijamin gacor dan gampang maxwin bahkan dengan
                            modal kecil (mulai Rp 10.000 saja!).</li>

                        <li><strong>JACKPOT SETIAP HARI & BONUS INSTAN TANPA CLAIM!</strong> Jadikan hari-hari Anda
                            berwarna dengan jackpot yang sering keluar! Nikmati juga bonus deposit langsung mengalir
                            ke akun tanpa ribet klaim. Modal minim, peluang maxwin maksimal!</li>

                        <li><strong>KEMUDAHAN TRANSFER 24 JAM:</strong> Deposit atau withdraw kapan saja? Bisa
                            banget! {{ $website->website_name }} mendukung semua metode pembayaran favorit Anda: Transfer Bank
                            Lokal, E-Wallet (DANA, OVO, Gopay, LinkAja), dan QRIS (super cepat!). Proses instan,
                            aman, tanpa potongan mengganggu.</li>
                    </ul>

                    <h3>LENGKAP! Bukan Cuma Slot Gacor, Tapi Juga:</h3>
                    <ul>
                        <li>Judi Bola Sbobet (Pasang taruhan di liga top dunia)</li>
                        <li>Live Casino Online (Dealer cantik & profesional, sensasi Vegas langsung di gadget)</li>
                        <li>Poker Online (Adu strategi dan keberuntungan)</li>
                        <li>Tembak Ikan (Game arcade seru dengan winrate tinggi)</li>
                    </ul>
                    <p>Satu akun, ragam keseruan tanpa batas!</p>

                    <h3>SLOT PROVIDER PREMIUM & TERLENGKAP:</h3>
                    <p>Nikmati ratusan game slot gacor maxwin dari provider ternama dan terpercaya dunia:</p>
                    <p><strong>Pragmatic Play, PG Soft (Pocket Games), Habanero, Microgaming, NoLimit City, Slot88,
                            Slot777, Joker123, IDN Slot</strong>, dan masih banyak lagi! Setiap game dijamin fair
                        play & diawasi badan hukum resmi.</p>

                    <h3>PELAYANAN PRIMA 24JAM & LINK ALTERNATIF ANTI-BLOKIR:</h3>
                    <p>CS ramah dan profesional siap membantu Anda 24 jam non-stop via Live Chat, WA, atau Telegram.
                        Deposit kendala? Withdraw pending? Game error? Tenang, tim kami solusikan cepat! Akses situs
                        pun selalu lancar berkat link alternatif terupdate yang bisa diakses dimana saja, kapan saja
                        via smartphone.</p>

                    <h3>🔥 Rekomendasi Slot Gacor Maxwin Modal Receh!</h3>
                    <p>Bermain slot gacor di {{ $website->website_name }} tak perlu modal besar! Nikmati game seru dengan taruhan
                        mulai Rp 100, Rp 200, hingga Rp 400 perak saja! Dengan RTP tinggi, peluang maxwin mesin slot
                        bet kecil ini terbuka lebar untuk semua pemain.</p>

                    <h3>📢 Daftar Sekarang! Gratis & Cuma 30 Detik!</h3>
                    <p>Sudah siap meraih maxwin hari ini? Pendaftaran member baru di {{ $website->website_name }} GRATIS dan super
                        mudah! Syaratnya simpel:</p>
                    <ol>
                        <li>Berusia minimal 18 tahun.</li>
                        <li>Memiliki data diri asli (KTP/SIM/KK).</li>
                    </ol>
                    <p><a href="#">👉 Klik Link Daftar Resmi {{ $website->website_name }} Sekarang!</a></p>
                    <p>Bergabunglah dengan puluhan ribu member setia kami dan buktikan sendiri sensasi menang
                        beruntun di situs slot gacor terpercaya nomor satu!</p>

                    <h2>{{ $website->website_name }}: Situs Slot Online Terpercaya, Gacor Maxwin, Gampang Menang!</h2>
                    <p>Link Resmi Situs Slot Gacor Hari Ini dengan RTP Tertinggi & Winrate Terbaik!</p>

                    <p><strong>⚠️ Ingat Selalu:</strong></p>
                    <ul>
                        <li>Bermainlah dengan santai dan nikmati setiap permainan.</li>
                        <li>Tetapkan batas waktu & budget bermain Anda.</li>
                        <li>Judi adalah aktivitas beresiko. Main dengan bijak!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright"
        style="background-image: url(../../dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/layout/footer-backgrounde252.jpg?v=20250528);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="https://ambengine.com/" target="_blank" rel="nofollow noopener"
                        class="powered-by-link">
                        <picture>
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/platform-engine/amb-engine.webp?v=20250528"
                                type="image/webp" />
                            <source
                                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/platform-engine/amb-engine.png?v=20250528"
                                type="image/png" /><img alt="amb-engine" class="powered-by-logo" height="30"
                                loading="lazy"
                                src="../../dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/platform-engine/amb-enginee252.png?v=20250528" />
                        </picture>
                    </a>
                    ©2025 {{ $website->website_name }} menawarkan berbagai macam provider pilihan terbaik dan didukung oleh Layanan
                    Pelanggan profesional 24/7 yang siap melayani Anda.<br /><br />
                </div>
            </div>
        </div>
    </div>
</footer>
