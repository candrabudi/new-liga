@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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

        #alert_box.warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .referral-link-box {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .referral-link-box p {
            margin: 0;
        }

        .copy-btn {
            margin-top: 10px;
            padding: 6px 12px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    @include('mobile.referral.components.tab')

    <div class="standard-form-container">
        <div class="container">
            <div class="row referral-container">

                {{-- Referral Link di bagian atas --}}
                @if ($kyc && $kyc->status === 'approved')
                    <div class="col-sm-12">
                        <div class="referral-link-box">
                            <p><strong>Kode Referral:</strong> {{ $kyc->referral_code }}</p>
                            <p><strong>Link Referral:</strong></p>
                            <input type="text" id="referral_link" class="form-control"
                                value="{{ url('/register?ref=' . $kyc->referral_code) }}" readonly>
                            <button class="btn btn-primary copy-btn" onclick="copyReferral()">
                                <i class='bx bx-copy'></i> Salin Link
                            </button>
                        </div>
                    </div>
                @endif

                <div class="col-sm-12 referral-banner-container">
                    <picture>
                        <source srcset="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.webp?v=20250528"
                            type="image/webp">
                        <source srcset="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.png?v=20250528"
                            type="image/png">
                        <img alt="id" loading="lazy"
                            src="//dsuown9evwz4y.cloudfront.net/Images/referral/banners/desktop/id.png?v=20250528">
                    </picture>
                </div>

                <div class="col-sm-12 referral-feature-container">
                    <h3 class="referral-guidance-note">
                        Sekali ID Anda terverifikasi, Anda dapat menikmati manfaat penuh dari program referral kami:
                    </h3>

                    <div class="referral-features">
                        <div class="referral-features-item">
                            <div class="feature-icon">
                                <img alt="Referral Comission" loading="lazy"
                                    src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-commission.svg?v=20250528">
                            </div>
                            <div class="feature-info">
                                <span>Komisi Referral</span>
                                <p>Tarik komisi dari referral yang sudah Anda miliki sebelumnya dan nikmati hasilnya.</p>
                            </div>
                        </div>
                        <div class="referral-features-item">
                            <div class="feature-icon">
                                <img alt="Referral Sharing" loading="lazy"
                                    src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-sharing.svg?v=20250528">
                            </div>
                            <div class="feature-info">
                                <span>Kemudahan Berbagi Referral</span>
                                <p>Berbagi kode referral Anda ke player lain dengan mudah dan cepat.</p>
                            </div>
                        </div>
                        <div class="referral-features-item">
                            <div class="feature-icon">
                                <img alt="Referral Summary" loading="lazy"
                                    src="//dsuown9evwz4y.cloudfront.net/Images/referral/referral-summary.svg?v=20250528">
                            </div>
                            <div class="feature-info">
                                <span>Ringkasan Referral</span>
                                <p>Lihat ringkasan mengenai progress dari hasil referral Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="standard-button-group mt-3">
                        @if ($kyc)
                            @if ($kyc->status === 'approved')
                                <div id="alert_box" class="success" style="display: block;">
                                    ✅ KYC Anda sudah berhasil diverifikasi
                                </div>
                            @elseif ($kyc->status === 'pending')
                                <div id="alert_box" class="warning" style="display: block;">
                                    ⏳ KYC Anda sedang dalam proses verifikasi. Harap menunggu.
                                </div>
                            @elseif ($kyc->status === 'rejected')
                                <div id="alert_box" class="error" style="display: block;">
                                    ❌ KYC Anda ditolak. Alasan: {{ $kyc->rejection_reason ?? 'Tidak diketahui' }}
                                </div>
                                <a href="/mobile/referral/verification"
                                    class="btn btn-primary standard-secondary-button mt-2">
                                    Upload Ulang Dokumen
                                </a>
                            @endif
                        @else
                            <a href="/mobile/referral/verification" class="btn btn-primary standard-secondary-button">
                                Verifikasi Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyReferral() {
            var copyText = document.getElementById("referral_link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value).then(function() {
                alert("Link referral berhasil disalin!");
            }, function(err) {
                alert("Gagal menyalin link: " + err);
            });
        }
    </script>
@endpush
