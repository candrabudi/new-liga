<div class="tab-menu-background-container">

    <div class="tab-menu-container" data-style="vertical">
        <a href="/mobile/account-summary" data-active="{{ request()->is('mobile/account-summary') ? 'true' : 'false' }}">
            <i data-icon="profile"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/profile.svg?v=20250528);--active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/profile-active.svg?v=20250528);"></i>
            Akun Saya
        </a>
    
        <a href="/mobile/password" data-active="{{ request()->is('mobile/password') ? 'true' : 'false' }}">
            <i data-icon="password"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/password.svg?v=20250528);--active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/password-active.svg?v=20250528);"></i>
            Ubah Kata Sandi
        </a>
    
        <a href="/mobile/profile" data-active="{{ request()->is('mobile/profile') ? 'true' : 'false' }}">
            <i data-icon="bank-account"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/edit.svg?v=20250528);--active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/edit-active.svg?v=20250528);"></i>
            Profil Saya
        </a>
    
        <a href="/loyalty/redemption-history" target="_blank"
            data-active="{{ request()->is('loyalty/redemption-history') ? 'true' : 'false' }}">
            <i data-icon="redemption-history"
                style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/redemption-history.svg?v=20250528);--active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/redemption-history-active.svg?v=20250528);"></i>
            Riwayat Penukaran
        </a>
    </div>
</div>
<script>
    document.querySelectorAll('.tab-menu-container a').forEach(link => {
        if (link.getAttribute('href') === window.location.pathname) {
            link.setAttribute('data-active', 'true');
        } else {
            link.setAttribute('data-active', 'false');
        }
    });
</script>
