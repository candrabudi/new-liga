@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/Register/mobile-css.css') }}">
@endpush
@section('content')
    <div class="register-done-container alternate-background" bis_skin_checked="1" style="margin-top: 70px;">
        <div class="logo-register" bis_skin_checked="1">
            <img alt="{{ $website->website_name }} | Situs Judi Slot Online Resmi Terbaik Terpercaya" loading="lazy"
                src="{{ $website->website_logo }}" style="width: 120px;">
        </div>
        <h2>Selamat bergabung di <span>{{ $website->website_name }}!</span></h2>
        <h3>Deposit hari ini juga dapatkan bonus menarik dan nikmati keseruan bermain di <span>{{ $website->website_name }}</span></h3>
        <a href="/mobile/deposit/bank" class="btn-deposit">
            Deposit
        </a>
        <div class="buttons-container-register-done" bis_skin_checked="1">
            <a href="/" class="btn">
                Beranda
            </a>
            <a href="/mobile/promotion" class="btn">
                Promosi
            </a>
        </div>
        <div class="register-verification-done" bis_skin_checked="1">
            <div class="info" bis_skin_checked="1">i</div>
            <div bis_skin_checked="1">
                Semua data Anda akan memasuki tahap verifikasi, silahkan lengkapi informasi Anda di halaman <a
                    href="/mobile/profile">Profile</a>, dan dapatkan pengalaman terbaik bersama kami.
            </div>
        </div>
    </div>
@endsection
