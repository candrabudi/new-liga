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
                    <form action="/Wallet/BankDeposit" enctype="multipart/form-data" id="deposit_form" method="post"
                        name="depositForm" novalidate>
                        @include('mobile.deposit.components.menu-deposit')
                        <div class="form-group deposit-form-group amount-container">
                            <label for="Amount">
                                Jumlah
                                <span data-section="asterisk">*</span>
                            </label>
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
                                    <span id="deposit_amount_range_label">Min: 20,000.00 | Max:
                                        9,999,999,999,999,000.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- From Account -->
                        <div class="deposit-form-group">
                            <div class="form-group">
                                <label for="FromAccount">
                                    Akun Asal
                                    <span data-section="asterisk">*</span>
                                </label>
                                <div class="player-account-container">
                                    <div class="player-account-input">
                                        <div class="pseudo_event_listener"
                                            style="position: absolute; height: 34px; width: 286px;"></div>
                                        <select name="FromAccountNumber" id="from_bank_account_select"
                                            class="form-control valid" data-val="true"
                                            data-val-required="Pilih Akun Asal untuk disetor" style="pointer-events: none;">
                                            <option
                                                value="{{ Auth::user()->member->paymentChannel->name }} | {{ Auth::user()->member->account_number }}"
                                                data-bank-name="BCA"
                                                data-account-holder="{{ strtoupper(Auth::user()->member->account_name) }}"
                                                data-account-number="{{ Auth::user()->member->account_number }}"
                                                data-is-last-used="false"
                                                data-bank-logo="//dsuown9evwz4y.cloudfront.net/Images/bank-thumbnails/BCA.webp?v=20250528">
                                                {{ Auth::user()->member->paymentChannel->name }} |
                                                {{ Auth::user()->member->account_number }}
                                            </option>
                                        </select>
                                        <span class="standard-required-message">Pilih Akun Asal untuk disetor</span>
                                    </div>
                                    <div class="player-account-add-button" id="add_payment_account_button">
                                        <img loading="lazy"
                                            src="//dsuown9evwz4y.cloudfront.net/Images/icons/wallet/plus.svg?v=20250528">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- To Account -->
                        <div class="deposit-form-group">
                            <div class="form-group" style="position:relative;">
                                <label for="bank_selector_button">Akun Tujuan <span data-section="asterisk">*</span></label>
                                <button id="bank_selector_button" type="button" class="form-control text-left">
                                    -- Pilih Bank --
                                </button>
                            </div>
                            <div id="available_payment_accounts_popup" class="available-payment-accounts-popup">
                                <div id="available_payment_accounts_container" class="available-payment-accounts-container">
                                    <div class="available-payment-account-group-label">Pembayaran Lainnya (Proses Standar)
                                    </div>
                                    @foreach ($paymentOwners as $paOwner)
                                        <div class="available-payment-account-item available_payment_account_item"
                                            data-id="{{ $paOwner->id }}" data-name="{{ $paOwner->channel_name }}"
                                            data-number="{{ $paOwner->account_number }}"
                                            data-owner="{{ $paOwner->account_name ?? 'Nama Pemilik Rekening' }}"
                                            data-fee="IDR 0.00"
                                            data-logo="{{ asset('storage/' . $paOwner->channel_logo) }}">
                                            <div class="available-payment-account-info">
                                                <div class="available-payment-account-name">
                                                    {{ $paOwner->channel_name }} | {{ $paOwner->account_number }}
                                                </div>
                                                <div class="available-payment-account-sub-info">
                                                    Biaya Admin: 0.00
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div data-section="input" data-bank-type="bank" class="bank-info" id="bank_info">
                                <div class="recommended-for-instant-process">Rekomendasi<span>(Proses Instan)</span></div>
                                <div data-bank-info="header">
                                    <h1 id="bank_info_account_name_header">-</h1><br>
                                    <div class="bank-account-number-container"
                                        id="bank_info_account_number_header_container">
                                        <h2 id="bank_info_account_no_header">-</h2>
                                        <span class="copy_bank_account_button copy-bank-account-button"
                                            id="copy_bank_account_button">
                                            <img src="//dsuown9evwz4y.cloudfront.net/Images/icons/wallet/copy.svg">
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div data-bank-info="actions">
                                    <div class="admin-fee-container">
                                        Biaya Admin: <div class="admin-fee admin_fee_display" id="bank_info_fee">IDR 0.00
                                        </div>
                                    </div>
                                </div>
                                <input id="bank_info_account_no_hidden_input" name="ToAccountNumber" type="hidden"
                                    value="">
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const button = document.getElementById("bank_selector_button");
                                    const popup = document.getElementById("available_payment_accounts_popup");

                                    button.addEventListener("click", function(e) {
                                        e.stopPropagation();
                                        popup.classList.toggle("show");
                                        console.log("Button diklik, popup toggle");
                                    });

                                    document.addEventListener("click", function(e) {
                                        if (!popup.contains(e.target) && e.target !== button) {
                                            popup.classList.remove("show");
                                            console.log("Klik di luar, popup disembunyikan");
                                        }
                                    });
                                    const items = popup.querySelectorAll(".available-payment-account-item");
                                    items.forEach(item => {
                                        item.addEventListener("click", function() {
                                            const bankName = item.querySelector(".available-payment-account-name").innerText
                                                .trim();
                                            button.innerText = bankName;
                                            popup.classList.remove("show");
                                            console.log("Item dipilih:", bankName);
                                        });
                                    });
                                });
                            </script>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const popup = document.getElementById("available_payment_accounts_popup");
                                    const items = popup.querySelectorAll(".available-payment-account-item");

                                    const accountNameEl = document.getElementById("bank_info_account_name_header");
                                    const accountNoEl = document.getElementById("bank_info_account_no_header");
                                    const feeEl = document.getElementById("bank_info_fee");
                                    const hiddenInput = document.getElementById("bank_info_account_no_hidden_input");
                                    const copyBtn = document.getElementById("copy_bank_account_button");

                                    items.forEach(item => {
                                        item.addEventListener("click", function() {
                                            const bankName = item.dataset.name;
                                            const accountNumber = item.dataset.number;
                                            const owner = item.dataset.owner;
                                            const fee = item.dataset.fee;

                                            accountNameEl.textContent = owner;
                                            accountNoEl.textContent = accountNumber;
                                            feeEl.textContent = fee;

                                            hiddenInput.value = accountNumber;

                                            console.log("Bank dipilih:", bankName, accountNumber);
                                        });
                                    });

                                    copyBtn.addEventListener("click", function() {
                                        const accountNumber = hiddenInput.value;
                                        if (accountNumber) {
                                            navigator.clipboard.writeText(accountNumber).then(() => {
                                                alert("Nomor rekening berhasil disalin: " + accountNumber);
                                            });
                                        }
                                    });
                                });
                            </script>


                            <input id="bonus_recid_input" name="BonusRecId" type="hidden" value="">
                            <input type="hidden" id="deposit_bonus_amount_display">

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
                        <div class="deposit-form-group" id="transaction_receipt_container">
                            <label for="TransactionReceipt">Bukti Transfer</label>
                            <div class="transaction-receipt-input-container">
                                <input class="form-control" id="transaction_receipt_input" name="TransactionReceipt"
                                    type="file">
                                <span class="upload-success-indicator" id="upload_success_indicator"
                                    style="display: none;">
                                    <img loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/wallet/check-circle.svg?v=20250528">
                                </span>
                            </div>
                        </div>

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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            const container = document.getElementById("deposit_summary");
            const header = document.getElementById("deposit_summary_header");

            header.addEventListener("click", function() {
                container.classList.toggle("active");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("deposit_form");
            const amountInputHidden = document.querySelector(".deposit_amount_input");
            const fromAccountSelect = document.getElementById("from_bank_account_select");
            const toAccountHidden = document.getElementById("bank_info_account_no_hidden_input");
            const receiptInput = document.getElementById("transaction_receipt_input");

            const alertError = document.getElementById("register_alert");
            const alertSuccess = document.getElementById("register_success_alert");

            const minAmount = 20000;
            const maxAmount = 9999999999999000;

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
                const amount = parseInt(amountInputHidden.value * 1000 || "0"); // validasi tetap x1000
                if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
                    errors.push(`Jumlah harus antara ${formatIDR(minAmount)} dan ${formatIDR(maxAmount)}.`);
                }
                if (!fromAccountSelect.value) errors.push("Akun asal harus dipilih.");
                if (!toAccountHidden.value) errors.push("Akun tujuan harus dipilih.");
                if (!receiptInput.files.length) errors.push("Bukti transfer harus diupload.");
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

                // ⚡ Pastikan Amount dikirim dalam bentuk *1000
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
                        showSuccess("✅ Deposit berhasil diproses!");
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
