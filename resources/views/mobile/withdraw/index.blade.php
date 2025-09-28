@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/withdrawal.css') }}">
    <style>
        /* Simple alert box styling */
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
    <div class="tab-menu-background-container" style="margin-top: 0px;">
        <div class="tab-menu-container">
            <a href="/mobile/deposit/bank" data-active="false">
                <i data-icon="deposit"
                    style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/deposit.svg?v=20250528);
                      --active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/deposit-active.svg?v=20250528);"></i>
                Deposit
            </a>
            <a href="/mobile/withdrawal" data-active="true">
                <i data-icon="withdrawal"
                    style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/withdrawal.svg?v=20250528);
                      --active-image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/tabs/withdrawal-active.svg?v=20250528);"></i>
                Penarikan
            </a>
        </div>
    </div>

    <div class="standard-form-container withdrawal-container">
        <div class="container">
            <div class="row">
                <div id="withdrawal_container" class="col-sm-12">

                    <!-- Alert Box -->
                    <div id="alert_box"></div>

                    <form id="withdrawal_form" method="post" name="withdrawalForm" novalidate>
                        @csrf

                        <!-- Metode Pembayaran: Bank Only -->
                        <div class="form-group withdrawal-form-group">
                            <label for="PaymentMethod">Metode Pembayaran</label>
                            <div id="payment_method_selection" class="payment-method-selection">
                                <div>
                                    <input type="radio" name="PaymentType" id="payment_method_BANK" value="BANK"
                                        checked>
                                    <label for="payment_method_BANK">
                                        <img loading="lazy"
                                            src="//dsuown9evwz4y.cloudfront.net/Images/payment-types/BANK.svg?v=20250528">
                                        <span>Bank</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Saldo -->
                        <div class="balance-info-container">
                            <a href="/mobile/history/withdrawal">Riwayat Penarikan</a>
                            <div class="total-balance">
                                <p>Saldo Saya</p>
                                <span id="current_balance">{{ Auth::user()->member->balance }}</span> <!-- contoh saldo -->
                            </div>
                        </div>

                        <hr class="withdrawal-gap">

                        <!-- Jumlah Penarikan -->
                        <div class="form-group withdrawal-form-group">
                            <label for="Amount">Jumlah Penarikan <span data-section="asterisk">*</span></label>
                            <div data-section="wd-amount">
                                <div data-field="amount" class="withdrawal-amount" data-currency="idr">
                                    <div class="currency-label">IDR</div>
                                    <input type="text" class="form-control withdrawal_amount_display" inputmode="numeric"
                                        placeholder="0">
                                    <input autocomplete="off" class="form-control withdrawal_amount_input" id="Amount"
                                        inputmode="numeric" name="Amount" type="hidden" value="0">
                                    <div class="currency-suffix">.000,-</div>
                                </div>
                            </div>
                        </div>

                        <!-- Pilih Bank -->
                        <div class="form-group withdrawal-form-group">
                            <label for="ToAccount">Pilih Bank Anda <span data-section="asterisk">*</span></label>
                            <div class="player-account-container">
                                <div class="player-account-input">
                                    <select name="PlayerBankAccountNumber" id="withdrawal_account_select"
                                        class="form-control">
                                        <option value="{{ Auth::user()->member->payment_channel_id }}" data-account-holder="{{ Auth::user()->member->account_name }}">{{ Auth::user()->member->paymentChannel->name }} |
                                            {{ Auth::user()->member->account_number }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="withdrawal-summary-container">
                            <div class="withdrawal-summary-header">
                                <span class="summary-title">Jumlah yang ditransfer</span>
                                <span class="summary-transfer-amount transfer_amount"><span>IDR</span> </span>
                            </div>
                            <div class="withdrawal-summary-content">
                                <div class="withdrawal-summary-body">
                                    <span class="withdrawal-summary-title">Rincian Penarikan</span>
                                    <div class="withdrawal-detail-container">
                                        <div class="withdrawal-detail-item">
                                            <span>Jumlah yang ditransfer</span>
                                            <span class="transfer_amount"><span>IDR</span> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="withdrawal-summary-footer">
                                    <span>Sisa Saldo</span>
                                    <span id="remaining_balance"><span>IDR </span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Button Tarik -->
                        <div class="standard-button-group">
                            <button type="submit" class="standard-secondary-button">TARIK</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const amountDisplay = document.querySelector('.withdrawal_amount_display');
            const amountInput = document.querySelector('.withdrawal_amount_input');
            const transferAmountElements = document.querySelectorAll('.transfer_amount span');
            const remainingBalanceEl = document.getElementById('remaining_balance').querySelector('span');
            const currentBalanceEl = document.getElementById('current_balance');
            const withdrawalForm = document.getElementById('withdrawal_form');
            const alertBox = document.getElementById('alert_box');

            const formatIDR = (amount) => {
                // Format angka ribuan
                return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            };

            const updateSummary = (value) => {
                // jika kosong, tampilkan 0
                let amountToDisplay = value ? parseInt(value) * 1000 : 0;
                transferAmountElements.forEach(el => el.textContent = formatIDR(amountToDisplay));

                // update sisa saldo
                const remaining = parseInt(currentBalanceEl.textContent) - amountToDisplay;
                remainingBalanceEl.textContent = formatIDR(remaining > 0 ? remaining : 0);
            };

            const showAlert = (message, type = 'success') => {
                alertBox.textContent = message;
                alertBox.className = '';
                alertBox.classList.add(type);
                alertBox.style.display = 'block';
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 5000);
            };

            // Inisialisasi ringkasan awal
            updateSummary(0);

            amountDisplay.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                amountInput.value = value;
                updateSummary(value);
            });

            withdrawalForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const amount = amountInput.value;
                const bank_id = document.getElementById('withdrawal_account_select').value;

                if (!amount || parseInt(amount) <= 0) {
                    showAlert('Jumlah penarikan harus diisi dan lebih dari 0.', 'error');
                    return;
                }
                if (amount.includes('.') || amount.includes(',')) {
                    showAlert('Nominal tidak boleh mengandung desimal.', 'error');
                    return;
                }

                axios.post('/Wallet/withdrawal', {
                        Amount: amount * 1000,
                        bank_id: bank_id
                    })
                    .then(res => {
                        showAlert(res.data.message || 'Transaksi berhasil', 'success');
                        // Update saldo lokal
                        currentBalanceEl.textContent = parseInt(currentBalanceEl.textContent) - (
                            parseInt(amount) * 1000);
                        updateSummary(0);
                        amountDisplay.value = '';
                        amountInput.value = 0;
                    })
                    .catch(err => {
                        console.error(err);
                        showAlert(err.response?.data?.message || 'Terjadi kesalahan', 'error');
                    });
            });
        });
    </script>
@endpush
