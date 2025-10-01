<div class="tab-menu-background-container">
    <div class="tab-menu-container" data-style="vertical">

        {{-- Referral --}}
        <a href="{{ url('/mobile/referral/guidance') }}" 
           data-active="{{ request()->is('mobile/referral/guidance') ? 'true' : 'false' }}">
            <i data-icon="referral"
               style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral.svg?v=20250528);
                      --active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral-active.svg?v=20250528);">
            </i>
            Referral
        </a>

        {{-- Ringkasan Pendaftaran --}}
        <a href="{{ url('/mobile/referral/signups-summary') }}" 
           data-active="{{ request()->is('mobile/referral/signups-summary') ? 'true' : 'false' }}">
            <i data-icon="referral-signups-summary"
               style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral-signups-summary.svg?v=20250528);
                      --active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral-signups-summary-active.svg?v=20250528);">
            </i>
            Ringkasan Pendaftaran
        </a>

        {{-- Riwayat Klaim --}}
        <a href="{{ url('/mobile/referral/commision') }}" 
           data-active="{{ request()->is('mobile/referral/claimed-history') ? 'true' : 'false' }}">
            <i data-icon="referral-claimed-history"
               style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral-claimed-history.svg?v=20250528);
                      --active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/referral-claimed-history-active.svg?v=20250528);">
            </i>
            Riwayat Klaim
        </a>

    </div>
</div>
