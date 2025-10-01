@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/Register/mobile-css.css') }}">
@endpush

@section('content')
    <div class="standard-form-container alternate-background register-page" style="margin-top: 70px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form id="register_form" method="post" novalidate="novalidate">
                        @csrf
                        <div class="standard-sub-section">
                            <div class="form-group">
                                <div class="alert-danger p-2 rounded" id="register_alert" hidden=""></div>
                            </div>
                            <div class="form-group">
                                <div class="alert-success p-2 rounded" id="register_success_alert" hidden=""></div>
                            </div>
                        </div>

                        {{-- ================= INFORMASI PRIBADI ================= --}}
                        <div class="standard-sub-section">
                            <div class="standard-form-title">
                                Informasi Pribadi
                            </div>
                            <div class="standard-form-content form_subcategory">
                                <div class="form-group required-form-group">
                                    <label for="username_field">Nama Pengguna</label>
                                    <input maxlength="12" autocomplete="off" class="form-control lowercase"
                                        id="username_field" name="UserName" placeholder="Nama Pengguna Anda" type="text">
                                    <span id="username_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group required-form-group standard-password-field">
                                    <label for="password_field">Kata Sandi</label>
                                    <input maxlength="20" class="form-control" id="password_field" name="Password"
                                        placeholder="Kata Sandi Anda" type="password">
                                    <span id="password_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group required-form-group standard-password-field">
                                    <label for="ConfirmedPassword">Ulangi Kata Sandi</label>
                                    <input maxlength="20" class="form-control" id="ConfirmedPassword"
                                        name="ConfirmedPassword" placeholder="Ulangi Kata Sandi Anda" type="password">
                                    <span id="confirm_password_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group required-form-group">
                                    <label for="FullName">Nama Lengkap</label>
                                    <input maxlength="100" autocomplete="off" class="form-control" id="FullName"
                                        name="FullName" placeholder="Nama Lengkap Anda" type="text">
                                    <span id="fullname_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input maxlength="100" autocomplete="off" class="form-control" id="Email"
                                        name="Email" placeholder="Email@contoh.com" type="text">
                                    <span id="email_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group">
                                    <label for="WhatsApp">WhatsApp</label>
                                    <input class="form-control format_phone" id="WhatsApp" name="WhatsApp"
                                        placeholder="Nomor WhatsApp" type="text" maxlength="16">
                                    <span id="whatsapp_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group referral-glyphicon-container">
                                    <div class="referral-code-header">
                                        <label>Kode Referral</label>
                                    </div>
                                    <div class="referral-code-content" style="display: block;">
                                        <input autocomplete="off" class="form-control referral-code-input" id="ReferrerCode"
                                            name="ReferrerCode" placeholder="Kode Referral" type="text" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- ================= INFORMASI PEMBAYARAN ================= --}}
                        <div class="standard-sub-section" id="bank_account_section">
                            <div class="standard-form-title">
                                Informasi Pembayaran
                            </div>
                            <div class="standard-form-content form_subcategory">
                                <div class="form-group required-form-group">
                                    <label for="selected_bank_select">Bank</label>
                                    <select class="form-control" id="selected_bank_select" name="SelectedBank">
                                        <option value="">-- Pilih Bank --</option>
                                        @foreach ($paymentChannels as $paymentChannel)
                                            <option value="{{ $paymentChannel->id }}">{{ $paymentChannel->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="bank_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group required-form-group">
                                    <label for="bank_account_number_input">Nomor Rekening</label>
                                    <input maxlength="24" autocomplete="off" class="form-control format_account_number"
                                        id="bank_account_number_input" name="BankAccountNumber"
                                        placeholder="Nomor rekening anda" type="text">
                                    <span id="bank_number_error" class="text-danger small"></span>
                                </div>
                                <div class="form-group required-form-group">
                                    <label for="bank_account_name_input">Nama Rekening</label>
                                    <input maxlength="100" autocomplete="off" class="form-control"
                                        id="bank_account_name_input" name="BankAccountName"
                                        placeholder="Nama Lengkap Anda" type="text">
                                    <span id="bank_name_error" class="text-danger small"></span>
                                </div>
                            </div>
                        </div>

                        <div class="standard-button-group">
                            <button type="submit" class="standard-secondary-button btn-primary"
                                id="register_submit_button">
                                <span id="btn_text">DAFTAR!</span>
                                <span id="btn_loading" class="spinner-border spinner-border-sm"
                                    style="display:none;"></span>
                            </button>
                        </div>
                    </form>

                    <div class="register-page-reminder mt-3">
                        Dengan klik tombol DAFTAR, saya menyatakan bahwa saya berumur diatas 18 tahun.
                        Saya telah membaca dan menyetujui Syarat dan Ketentuan.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const ref = urlParams.get('ref');
            const input = document.getElementById("ReferrerCode");

            if (ref) {
                input.value = ref.trim();
                input.readOnly = true;
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("register_form");
            const alertBox = document.getElementById("register_alert");
            const successBox = document.getElementById("register_success_alert");
            const btnText = document.getElementById("btn_text");
            const btnLoading = document.getElementById("btn_loading");

            function showError(id, message) {
                const span = document.getElementById(id + "_error");
                if (span) span.textContent = message || "";
            }

            const validators = {
                UserName: function() {
                    const val = document.getElementById("username_field").value.trim();
                    if (!/^[0-9a-zA-Z]{3,12}$/.test(val)) {
                        showError("username", "Nama pengguna harus 3-12 karakter alfanumerik tanpa spasi.");
                        return false;
                    }
                    showError("username", "");
                    return true;
                },
                Password: function() {
                    const user = document.getElementById("username_field").value.trim();
                    const pass = document.getElementById("password_field").value;
                    if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9!@#$%^*()_+\[\]{}|:;',.?/~`\\-]{8,20}$/.test(
                        pass)) {
                    showError("password",
                        "Kata sandi harus 8-20 karakter, mengandung huruf dan angka.");
                    return false;
                }
                if (pass.includes(user)) {
                    showError("password", "Kata sandi tidak boleh mengandung username.");
                    return false;
                }
                if (/[&<>]/.test(pass)) {
                    showError("password", "Kata sandi tidak boleh mengandung simbol & < >.");
                    return false;
                }
                showError("password", "");
                return true;
            },
            ConfirmedPassword: function() {
                const pass = document.getElementById("password_field").value;
                const confirm = document.getElementById("ConfirmedPassword").value;
                if (pass !== confirm) {
                    showError("confirm_password", "Konfirmasi kata sandi tidak cocok.");
                    return false;
                }
                showError("confirm_password", "");
                return true;
            },
            FullName: function() {
                const val = document.getElementById("FullName").value.trim();
                if (!/^[\p{L}\p{N}\s]+$/u.test(val) || val.length < 3) {
                    showError("fullname", "Nama lengkap hanya huruf/angka, min. 3 karakter.");
                    return false;
                }
                showError("fullname", "");
                return true;
            },
            Email: function() {
                const val = document.getElementById("Email").value.trim();
                if (val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
                    showError("email", "Format email tidak valid.");
                    return false;
                }
                showError("email", "");
                return true;
            },
            WhatsApp: function() {
                const val = document.getElementById("WhatsApp").value.trim();
                if (val && !/^[0-9\-]{8,16}$/.test(val)) {
                    showError("whatsapp", "Nomor WhatsApp hanya angka/strip, 8-16 digit.");
                    return false;
                }
                showError("whatsapp", "");
                return true;
            },
            SelectedBank: function() {
                const val = document.getElementById("selected_bank_select").value;
                if (!val) {
                    showError("bank", "Silakan pilih bank.");
                    return false;
                }
                showError("bank", "");
                return true;
            },
            BankAccountNumber: function() {
                const val = document.getElementById("bank_account_number_input").value.trim();
                if (val && !/^[0-9\-]+$/.test(val)) {
                    showError("bank_number", "Nomor rekening hanya boleh angka.");
                    return false;
                }
                showError("bank_number", "");
                return true;
            },
            BankAccountName: function() {
                const fullName = document.getElementById("FullName").value.trim();
                const bankName = document.getElementById("bank_account_name_input").value.trim();
                if (bankName && bankName !== fullName) {
                    showError("bank_name", "Nama rekening harus sama dengan nama lengkap.");
                    return false;
                }
                showError("bank_name", "");
                return true;
            }
        };

        // Pas blur → validasi per field
        Object.keys(validators).forEach(field => {
            const el = document.querySelector(`[name="${field}"]`);
                if (el) el.addEventListener("blur", validators[field]);
            });

            // Submit pakai axios
            // Submit pakai axios
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                // Jangan kirim kalau sudah loading
                if (btnLoading.style.display === "inline-block") return;

                let ok = true;
                Object.keys(validators).forEach(f => {
                    if (!validators[f]()) ok = false;
                });
                if (!ok) return;

                alertBox.hidden = true;
                successBox.hidden = true;

                btnText.style.display = "none";
                btnLoading.style.display = "inline-block";
                form.querySelector("button[type=submit]").disabled = true; // 🔒 lock tombol

                const formData = new FormData(form);

                axios.post("{{ route('register.process') }}", formData)
                    .then(res => {
                        if (res.data.status) {
                            successBox.innerHTML = res.data.message;
                            successBox.hidden = false;
                            form.reset();
                            window.location.href = "/mobile/register-done";
                        }
                    })
                    .catch(err => {
                        if (err.response && err.response.status === 422) {
                            const errors = err.response.data.errors;
                            Object.keys(errors).forEach(key => {
                                let spanId = key.toLowerCase();
                                if (key === "ConfirmedPassword") spanId = "confirm_password";
                                showError(spanId, errors[key][0]);
                            });
                        } else {
                            alertBox.innerHTML = "Terjadi kesalahan server, coba lagi.";
                            alertBox.hidden = false;
                        }
                    })
                    .finally(() => {
                        btnText.style.display = "inline";
                        btnLoading.style.display = "none";
                        form.querySelector("button[type=submit]").disabled = false; // 🔓 buka lagi
                    });

            });

        });
    </script>
@endpush
