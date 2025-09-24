@if (Auth::check())
    <div class="fixed-footer">
        <a href="/" data-active="{{ request()->is('/') ? 'true' : 'false' }}">
            <img alt="Home" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/home.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/home-active.svg?v=20250528);"
                width="25">
            Beranda
        </a>

        <a href="/mobile/promotion" data-active="{{ request()->is('mobile/promotion*') ? 'true' : 'false' }}">
            <img alt="Promotion" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/promotion.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/promotion-active.svg?v=20250528);"
                width="25">
            Promosi
        </a>

        <a href="/mobile/deposit" data-active="{{ request()->is('mobile/deposit*') ? 'true' : 'false' }}">
            <img alt="Deposit" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/banking.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/banking-active.svg?v=20250528);"
                width="25">
            Depo/WD
        </a>

        <a href="/mobile/contact-us" data-active="{{ request()->is('mobile/contact-us*') ? 'true' : 'false' }}">
            <img alt="Contact Us" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/live-chat.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/live-chat-active.svg?v=20250528);"
                width="25">
            Hub. Kami
        </a>

        <a href="/mobile/account-summary"
            data-active="{{ request()->is('mobile/account-summary*') ? 'true' : 'false' }}">
            <img alt="My Account" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/my-account.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/my-account-active.svg?v=20250528);"
                width="25">
            Akun Saya
        </a>
    </div>
@else
    <div class="fixed-footer">
        <a href="/" data-active="{{ request()->is('/') ? 'true' : 'false' }}">
            <img alt="Home" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/home.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/home-active.svg?v=20250528);"
                width="25">
            Beranda
        </a>

        <a href="/mobile/promotion" data-active="{{ request()->is('mobile/promotion*') ? 'true' : 'false' }}">
            <img alt="Promotion" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/promotion.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/promotion-active.svg?v=20250528);"
                width="25">
            Promosi
        </a>

        <a data-require-login="/mobile/deposit" data-active="false">
            <img alt="Masuk" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/login.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/login-active.svg?v=20250528);"
                width="25">
            Masuk
        </a>

        <a href="/mobile/contact-us" data-active="{{ request()->is('mobile/contact-us*') ? 'true' : 'false' }}">
            <img alt="Contact Us" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/live-chat.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/live-chat-active.svg?v=20250528);"
                width="25">
            Hub. Kami
        </a>

        <a data-require-login="/mobile/account-summary" data-active="false">
            <img alt="My Account" height="25" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/my-account.svg?v=20250528"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/layout/footer/my-account-active.svg?v=20250528);"
                width="25">
            Akun Saya
        </a>
    </div>
@endif
