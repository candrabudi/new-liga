@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <style>
        #alert_box {
            display: none;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-weight: bold;
        }

        #alert_box.success {
            background-color: #d4edda;
            color: #155724;
        }

        #alert_box.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
@endpush

@section('content')
    @include('mobile.referral.components.tab')
    <div class="standard-form-container" bis_skin_checked="1">
        <div class="container" bis_skin_checked="1">
            <div class="row referral-container" bis_skin_checked="1">
                <div class="col-sm-12 referral-banner-container" bis_skin_checked="1">
                    <picture>
                        <source srcset="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.webp?v=20250528"
                            type="image/webp">
                        <source srcset="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.png?v=20250528"
                            type="image/png"><img alt="id" loading="lazy"
                            src="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.png?v=20250528">
                    </picture>
                </div>


                <div class="col-sm-12 referral-feature-container" bis_skin_checked="1">
                    <h3 class="referral-guidance-note">Sekali ID Anda terverifikasi, Anda dapat menikmati manfaat penuh dari
                        program referral kami:</h3>
                    <div class="referral-features" bis_skin_checked="1">
                        <div class="referral-features-item" bis_skin_checked="1">
                            <div class="feature-icon" bis_skin_checked="1">
                                <div bis_skin_checked="1">
                                    <img alt="Referral Comission" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-commission.svg?v=20250528">
                                </div>
                            </div>
                            <div class="feature-info" bis_skin_checked="1">
                                <span>Komisi Referral</span>
                                <p>Tarik komisi dari referral yang sudah Anda miliki sebelumnya dan nikmati hasilnya.</p>
                            </div>
                        </div>
                        <div class="referral-features-item" bis_skin_checked="1">
                            <div class="feature-icon" bis_skin_checked="1">
                                <div bis_skin_checked="1">
                                    <img alt="Referral Sharing" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-sharing.svg?v=20250528">
                                </div>
                            </div>
                            <div class="feature-info" bis_skin_checked="1">
                                <span>Kemudahan Berbagi Referral</span>
                                <p>Berbagi kode referral Anda ke player lain dengan mudah dan cepat.</p>
                            </div>
                        </div>
                        <div class="referral-features-item" bis_skin_checked="1">
                            <div class="feature-icon" bis_skin_checked="1">
                                <div bis_skin_checked="1">
                                    <img alt="Referral Summary" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-summary.svg?v=20250528">
                                </div>
                            </div>
                            <div class="feature-info" bis_skin_checked="1">
                                <span>Ringkasan Referral</span>
                                <p>Lihat ringkasan mengenai progress dari hasil referral Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="standard-button-group" bis_skin_checked="1">
                        <a href="/mobile/referral/verification" class="btn btn-primary standard-secondary-button">
                            Verifikasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
