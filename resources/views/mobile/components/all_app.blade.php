<div class="download-apk-container" id="download_apk"
    style="--image-src: url(http://dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/download-apk-background.webp?v=20250528);">
    <div>
        <picture>
            <source
                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/download-apk-phone.webp?v=20250528"
                type="image/webp" />
            <source
                srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/download-apk-phone.png?v=20250528"
                type="image/png" /><img alt="Download APK" class="img-responsive" height="165" loading="lazy"
                src="../../dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/home/download-apk-phonee252.png?v=20250528"
                width="215" />
        </picture>
    </div>
    <div>
        <div class="h2">
            Unduh
            <strong>{{ $website->website_name }} App</strong>
        </div>
        <div class="h3">
            Nikmati berbagai permainan dalam satu genggaman
        </div>
        <div class="download-apk-info">
            <div class="download-apk-section">
                <picture>
                    <source
                        srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/android-logo.webp?v=20250528"
                        type="image/webp" />
                    <source
                        srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/home/android-logo.png?v=20250528"
                        type="image/png" /><img alt="Download Android APK" class="img-responsive" height="50"
                        loading="lazy"
                        src="../../dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/home/android-logoe252.png?v=20250528"
                        width="50" />
                </picture>
                <a href="https://apk-bank.s3.ap-southeast-1.amazonaws.com/{{ $website->website_name }}.apk">Unduh</a>
            </div>
        </div>
        <div>
            <a class="download-apk-guide" href="#" data-toggle="modal"
                data-target="#apk_install_guide_modal">Panduan instalasi</a>
        </div>
    </div>
</div>
<div id="apk_install_guide_modal" class="modal download-popup-modal" role="dialog" data-title="Panduan Instalasi"
    aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-title" id="apk_install_guide_modal_title">
                    Panduan Instalasi
                </div>
            </div>
            <div class="modal-body" id="apk_install_guide_modal_body">
                <span><img alt="Android" height="20" loading="lazy"
                        src="http://dsuown9evwz4y.cloudfront.net/Images/icons/android-logo.svg?v=20250528"
                        width="20" /> Instalasi Android</span>
                <ol>
                    <li>
                        Pindai kode QR untuk Android
                    </li>
                    <li>
                        Pilih buka situs web
                    </li>
                    <li>
                        Pilih "UNDUH" untuk mengunduh {{ $website->website_name }} App
                    </li>
                    <li>
                        Pilih "PENGATURAN"
                    </li>
                    <li>
                        Pilih "Mengizinkan" dari sumber kami
                    </li>
                    <li>
                        Pilih "Terima"
                    </li>
                    <li>
                        Pilih "INSTAL"
                    </li>
                </ol>
                <div class="download-32-bit-cntr">
                    <div>Instalasi gagal?</div>
                    <div>Coba versi 32-bit <a
                            href="https://apk-bank.s3.ap-southeast-1.amazonaws.com/{{ $website->website_name }}-32bit.apk"
                            target="_blank">di sini</a> jika versi bawaan tidak bisa diinstal.</div>
                </div>
            </div>
        </div>
    </div>
</div>


@php
    use App\Models\Website;
    $website = Website::first();
@endphp
<div class="telegram-banner-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ $website->link_telegram }}" rel="nofollow" target="_blank">

                    <picture>
                        <source
                            srcset="//dsuown9evwz4y.cloudfront.net/Images/communications/telegram-banner/telegram-bot-banner-mobile-id.webp?v=20250528"
                            type="image/webp" />
                        <source
                            srcset="//dsuown9evwz4y.cloudfront.net/Images/communications/telegram-banner/telegram-bot-banner-mobile-id.webp?v=20250528"
                            type="image/webp" /><img alt="Telegram" loading="lazy"
                            src="http://dsuown9evwz4y.cloudfront.net/Images/communications/telegram-banner/telegram-bot-banner-mobile-id.webp?v=20250528" />
                    </picture>
                </a>
            </div>
        </div>
    </div>
</div>
