<ul class="metismenu" id="menu">
    <li>
        <a href="#">
            <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    <li class="menu-label">Informasi</li>
    <li>
        <a href="{{ route('secret.promotions.index') }}">
            <div class="parent-icon"><i class="bx bx-info-circle"></i></div>
            <div class="menu-title">Promosi</div>
        </a>
    </li>

    <li class="menu-label">Transaksi</li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-credit-card"></i></div>
            <div class="menu-title">Deposit</div>
        </a>
        <ul>
            <li><a href="{{ route('secret.deposits.pending') }}"><i class='bx bx-radio-circle'></i>Deposit Pending</a>
            </li>
            <li><a href="{{ route('secret.deposits.history') }}"><i class='bx bx-radio-circle'></i>Riwayat Deposit</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-wallet"></i></div>
            <div class="menu-title">Withdraw</div>
        </a>
        <ul>
            <li><a href="{{ route('secret.withdraws.pending') }}"><i class='bx bx-radio-circle'></i>Withdraw Pending</a>
            </li>
            <li><a href="{{ route('secret.withdraws.history') }}"><i class='bx bx-radio-circle'></i>Riwayat Withdraw</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <div class="parent-icon"><i class="bx bx-gift"></i></div>
            <div class="menu-title">Bonus</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.adjustments.index') }}">
            <div class="parent-icon"><i class="bx bx-dollar-circle"></i></div>
            <div class="menu-title">Saldo Member</div>
        </a>
    </li>

    <li class="menu-label">Sistem</li>
    <li>
        <a href="{{ route('secret.payment_owners.index') }}">
            <div class="parent-icon"><i class="bx bx-wallet"></i></div>
            <div class="menu-title">Rekening Deposit</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.finance.index') }}">
            <div class="parent-icon"><i class="bx bx-transfer-alt"></i></div>
            <div class="menu-title">Pengaturan Keuangan</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.members.index') }}">
            <div class="parent-icon"><i class="bx bx-user"></i></div>
            <div class="menu-title">Member</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.profile.index') }}">
            <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
            <div class="menu-title">Profile</div>
        </a>
    </li>
    <li>
        <a href="#">
            <div class="parent-icon"><i class="bx bx-history"></i></div>
            <div class="menu-title">History Log Akses</div>
        </a>
    </li>

    <li class="menu-label">Website</li>
    <li>
        <a href="{{ route('secret.banners.index') }}">
            <div class="parent-icon"><i class="bx bx-image"></i></div>
            <div class="menu-title">Banner</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.website.index') }}">
            <div class="parent-icon"><i class="bx bx-globe"></i></div>
            <div class="menu-title">Website</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.provider.index') }}">
            <div class="parent-icon"><i class="bx bx-key"></i></div>
            <div class="menu-title">Provider Credentials</div>
        </a>
    </li>
    <li>
        <a href="{{ route('secret.contacts.index') }}">
            <div class="parent-icon"><i class="bx bx-phone"></i></div>
            <div class="menu-title">Kontak</div>
        </a>
    </li>
</ul>
