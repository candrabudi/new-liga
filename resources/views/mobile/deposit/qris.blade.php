@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/Wallet/mobile-deposit-css.css') }}">
@endpush

@section('content')
    @include('mobile.deposit.components.head')
    <div class="standard-form-container deposit-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="alert-danger" id="register_alert" hidden></div>
                        <div class="alert-success" id="register_success_alert" hidden></div>
                    </div>

                    <form action="/Wallet/QrDeposit" enctype="multipart/form-data" id="deposit_form" method="post"
                        name="depositForm" novalidate="novalidate">
                        @csrf
                        @include('mobile.deposit.components.menu-deposit')

                        <div class="balance-info-container">
                            <a href="/mobile/history/deposit">Riwayat Deposit</a>
                            <div class="total-balance">
                                <p>Saldo Saya</p>
                                <span>0.00</span>
                            </div>
                        </div>

                        <hr class="deposit-gap">

                        {{-- Input Nominal --}}
                        <div class="form-group deposit-form-group">
                            <div class="deposit-qr-label-container">
                                <label for="Amount">Jumlah <span data-section="asterisk">*</span></label>
                                <div class="deposit-qr-label-bank-info">
                                    <img loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/banks/qris.svg?v=20250528">
                                    <div class="bank-info-badge" data-type="instant">Manual</div>
                                </div>
                            </div>
                            <div class="deposit-amount-container">
                                <div data-section="depo-amount">
                                    <div data-field="amount" class="deposit-amount" data-currency="idr">
                                        <div class="currency-label">IDR</div>
                                        <input type="text" class="form-control deposit_amount_display"
                                            inputmode="decimal">
                                        <input autocomplete="off" class="form-control deposit_amount_input" data-val="true"
                                            data-val-required="The Amount field is required." id="Amount"
                                            inputmode="decimal" name="Amount" type="hidden" value="0">
                                        <div class="currency-suffix">.000,-</div>
                                    </div>
                                </div>
                                <div class="deposit-amount-range">
                                   <span id="deposit_amount_range_label">Min: {{ number_format(round($financeSetting->min_deposit), 0, ',', '.') }} | Max:
                                        {{ number_format(round($financeSetting->max_deposit), 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Pilihan QRIS Tujuan --}}
                        <div class="form-group qr-to-account-form-group" style="display: block;">
                            <div data-section="input" data-bank-type="qr" class="bank-info" id="bank_info"
                                data-high-priority="true" data-has-qr-code="true">

                                <div class="recommended-for-instant-process">
                                    Rekomendasi <span>(Proses Manual)</span>
                                </div>

                                @forelse ($paymentOwners as $owner)
                                    <div class="qris-item text-center mb-4">
                                        <h5 class="mb-2">{{ $owner->account_name }}</h5>
                                        @if ($owner->qris_image)
                                            <img src="{{ asset('storage/' . $owner->qris_image) }}"
                                                alt="QRIS {{ $owner->account_name }}" class="img-fluid rounded border mb-2"
                                                style="max-width:250px;">
                                            <div>
                                                <a href="{{ asset('storage/' . $owner->qris_image) }}"
                                                    download="qris-{{ $owner->account_name }}.png"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Unduh QRIS
                                                </a>
                                            </div>
                                            <input type="hidden" name="ToQrisAccount" value="{{ $owner->id }}">
                                        @else
                                            <p class="text-muted">QRIS belum tersedia</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-center text-danger">Belum ada QRIS aktif</p>
                                @endforelse

                                <h4 id="qr_code_note">Pindai kode QR di atas lalu lakukan transfer sesuai jumlah</h4>
                                <hr>

                                {{-- Upload Bukti Transfer --}}
                                <div class="form-group">
                                    <label for="transaction_receipt_input">Upload Bukti Pembayaran <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="transaction_receipt_input"
                                        name="TransactionReceipt" accept="image/*" required>
                                </div>

                                <div class="admin-fee-container">
                                    Biaya Admin:
                                    <div class="admin-fee admin_fee_display">IDR 0.00</div>
                                </div>
                            </div>
                        </div>

                        {{-- Ringkasan Deposit --}}
                        <div class="deposit-form-group">
                            <style>
                                .deposit-summary-content {
                                    display: none;
                                    transition: all 0.3s ease;
                                }

                                .deposit-summary-container.active .deposit-summary-content {
                                    display: block;
                                }

                                .toggler {
                                    cursor: pointer;
                                    transition: transform 0.3s ease;
                                }

                                .deposit-summary-container.active .toggler i {
                                    transform: rotate(180deg);
                                }
                            </style>

                            <div class="deposit-summary-container" id="deposit_summary">
                                <div class="deposit-summary-header" id="deposit_summary_header">
                                    <span class="summary-title">Jumlah yang ditransfer</span>
                                    <span class="summary-transfer-amount transfer-amount transfer_amount"
                                        data-location="summary">
                                        <span>IDR</span> 0
                                    </span>
                                    <span class="toggler" id="deposit_summary_detail_toggler">
                                        <i class="glyphicon glyphicon-chevron-down"></i>
                                    </span>
                                </div>
                                <div class="deposit-summary-content" id="deposit_summary_content">
                                    <div class="deposit-summary-body">
                                        <span class="deposit-summary-title">Rincian Deposit</span>
                                        <div class="deposit-detail-container">
                                            <div class="deposit-detail-item">
                                                <span>Jumlah yang ditransfer</span>
                                                <span class="transfer-amount transfer_amount"><span>IDR</span> 0</span>
                                            </div>
                                            <div class="deposit-detail-item" id="unique_code_container"
                                                style="display: none;">
                                                <span>Kode unik</span>
                                                <span class="unique-code" id="unique_code"></span>
                                            </div>
                                            <div class="deposit-detail-item">
                                                <span>Biaya Admin</span>
                                                <span class="admin_fee_display">IDR 0.00</span>
                                            </div>
                                            <div class="deposit-detail-item" id="bonus_amount_container"
                                                style="display: none;">
                                                <span>Bonus</span>
                                                <span class="bonus-amount" id="bonus_amount"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="deposit-summary-footer">
                                        <span>Jumlah yang didapat</span>
                                        <span id="net_credited_amount"><span>IDR</span> 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="register_alert" class="alert alert-danger" hidden></div>
                        <div id="register_success_alert" class="alert alert-success" hidden></div>

                        <div class="standard-button-group">
                            <input type="submit" class="standard-secondary-button" value="KIRIM">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById("deposit_summary");
            const header = document.getElementById("deposit_summary_header");

            header.addEventListener("click", function() {
                container.classList.toggle("active");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputDisplay = document.querySelector(".deposit_amount_display");
            const inputHidden = document.querySelector(".deposit_amount_input");
            const summaryTransferEls = document.querySelectorAll(".transfer_amount");
            const netCreditedEl = document.getElementById("net_credited_amount");

            function formatIDR(value) {
                return new Intl.NumberFormat("id-ID").format(value);
            }

            inputDisplay.addEventListener("input", function() {
                let raw = this.value.replace(/\D/g, "");
                let amount = parseInt(raw || "0");

                inputHidden.value = amount;
                this.value = formatIDR(amount);
                let converted = amount * 1000;

                summaryTransferEls.forEach(el => {
                    el.innerHTML = `<span>IDR</span> ${formatIDR(converted)}`;
                })
                netCreditedEl.innerHTML = `<span>IDR</span> ${formatIDR(converted)}`;
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("deposit_form");
            const amountInputHidden = document.querySelector(".deposit_amount_input");
            const toQrisInput = document.querySelector("input[name='ToQrisAccount']");
            const receiptInput = document.getElementById("transaction_receipt_input");

            const alertError = document.getElementById("register_alert");
            const alertSuccess = document.getElementById("register_success_alert");

            const minAmount = 20000;
            const maxAmount = 10000000;

            function formatIDR(value) {
                return new Intl.NumberFormat("id-ID").format(value);
            }

            function showError(msg) {
                alertError.innerHTML = msg;
                alertError.hidden = false;
                alertSuccess.hidden = true;
            }

            function showSuccess(msg) {
                alertSuccess.innerHTML = msg;
                alertSuccess.hidden = false;
                alertError.hidden = true;
            }

            function clearAlerts() {
                alertError.hidden = true;
                alertSuccess.hidden = true;
            }

            function validateForm() {
                let errors = [];
                const amount = parseInt(amountInputHidden.value * 1000 || "0");
                if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
                    errors.push(`Jumlah harus antara ${formatIDR(minAmount)} dan ${formatIDR(maxAmount)}.`);
                }
                if (!toQrisInput) errors.push("QRIS tujuan belum tersedia.");
                if (!receiptInput.files.length) errors.push("Bukti pembayaran harus diupload.");
                return errors;
            }

            form.addEventListener("submit", function(e) {
                e.preventDefault();
                clearAlerts();

                const errors = validateForm();
                if (errors.length > 0) {
                    showError(errors.join("<br>"));
                    return;
                }

                const formData = new FormData(form);
                let rawAmount = parseInt(amountInputHidden.value || "0");
                formData.set("Amount", rawAmount * 1000);

                axios.post(form.action, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        }
                    })
                    .then(res => {
                        showSuccess("✅ Deposit berhasil dikirim, menunggu konfirmasi!");
                        form.reset();
                        document.querySelector(".deposit_amount_display").value = "";
                        document.querySelectorAll(".transfer_amount").forEach(el => el.innerHTML =
                            "<span>IDR</span> 0");
                        document.getElementById("net_credited_amount").innerHTML = "<span>IDR</span> 0";
                    })
                    .catch(err => {
                        const msg = err.response?.data?.message || "❌ Terjadi kesalahan server.";
                        showError(msg);
                    });
            });
        });
    </script>
@endpush
