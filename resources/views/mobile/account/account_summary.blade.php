@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/profile.css') }}">
    
@endpush
@section('content')
    @include('mobile.components.head_balance')

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
    @include('mobile.account.components.tab')
    <div class="standard-form-container profile-container" bis_skin_checked="1">
        <div class="container" bis_skin_checked="1">
            <div class="row" bis_skin_checked="1">
                <div class="col-sm-12" bis_skin_checked="1">
                    <div class="standard-form-title" bis_skin_checked="1">
                        INFORMASI AKUN
                    </div>
                    <div class="standard-content-info" bis_skin_checked="1">
                        <div class="standard-content-block" bis_skin_checked="1">
                            <table class="table profile-summary-table">
                                <tbody>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{ strtoupper(Auth::user()->member->account_name) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>
                                            {{ strtolower(Auth::user()->email) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <td>:</td>
                                        <td>{{ strtolower(Auth::user()->username) }}</td>
                                    </tr>
                                    <tr>
                                        <th>ID Pengguna Aplikasi Mobile</th>
                                        <td>:</td>
                                        <td>{{ strtolower(Auth::user()->member->ext_code) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mata Uang</th>
                                        <td>:</td>
                                        <td>IDR</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="standard-content-block" bis_skin_checked="1">
                            <div class="banking-details-header" bis_skin_checked="1">
                                <label>Detail Perbankan</label>
                                {{-- <a href="/mobile/bank-account">
                                    <img alt="Edit" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/edit.svg?v=20250528">
                                </a> --}}
                            </div>
                            <div id="bank_account_carousel" class="carousel slide bank-info-container" data-interval="false"
                                data-ride="carousel" bis_skin_checked="1">
                                <ol class="carousel-indicators">
                                    <li data-target="#bank_account_carousel" data-slide-to="0" class="active"></li>
                                </ol>
                                <div class="carousel-inner" bis_skin_checked="1">
                                    <div class="bank-info-block item active" bis_skin_checked="1">
                                        <div class="account-name" bis_skin_checked="1">
                                            {{ strtoupper(Auth::user()->member->account_name) }}
                                            {{-- <img alt="BCA" class="bank-icon" loading="lazy"
                                                onerror="this.style.display='none'"
                                                src="//dsuown9evwz4y.cloudfront.net/Images/banks/bca.svg?v=20250528"> --}}
                                        </div>
                                        <div class="account-number" bis_skin_checked="1">
                                            {{ Auth::user()->member->account_number }}
                                        </div>
                                        <hr>
                                        <div class="bank-name" bis_skin_checked="1">
                                            {{ strtoupper(Auth::user()->member->paymentChannel->name) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="standard-form-title" bis_skin_checked="1">
                        REFERRAL
                    </div>
                    <div class="standard-content-info" bis_skin_checked="1">
                        <div class="standard-form-content-info" bis_skin_checked="1">
                            <section class="referral-field">
                                <label>Kode Referral:</label>
                                <a href="#">
                                    <div id="ReferralCode" class="referral-code-container" bis_skin_checked="1"></div>
                                </a>
                            </section>
                        </div>
                    </div>
                    <div class="standard-form-title" bis_skin_checked="1">
                        STATUS DEPOSIT / PENARIKAN
                    </div>
                    <div class="standard-content-info" bis_skin_checked="1">
                        <div bis_skin_checked="1">
                            <h2>
                                Status Deposit Terakhir
                            </h2>
                            <table class="table last-transaction-table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Jumlah
                                        </th>
                                        <th scope="col">
                                            Tanggal/Waktu WIB
                                        </th>
                                        <th scope="col" class="text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="empty" colspan="3">Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div bis_skin_checked="1">
                            <h2>
                                Status Penarikan Terakhir
                            </h2>
                            <table class="table last-transaction-table">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Jumlah
                                        </th>
                                        <th scope="col">
                                            Tanggal/Waktu WIB
                                        </th>
                                        <th scope="col" class="text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="empty" colspan="3">Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
