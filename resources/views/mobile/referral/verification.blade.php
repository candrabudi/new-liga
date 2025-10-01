@extends('mobile.template.app')

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <div class="standard-form-container" style="padding: 20px;">
        <div class="standard-form-title">
            Verifikasi Akun Anda
        </div>
        <div class="container">
            <div class="row referral-verification-container">
                <form action="{{ route('kyc.store') }}" enctype="multipart/form-data" id="kyc_form" method="post" novalidate>
                    @csrf
                    <div id="alert_box"></div>

                    <div class="form-group">
                        <div class="standard-form-note with-icon">
                            <span>Catatan:</span>
                            <ol>
                                <li>Mohon verifikasi <b>Nomor WhatsApp</b> pada halaman <b>Profile</b> untuk bisa
                                    melanjutkan proses verifikasi.</li>
                                <li>Untuk merubah <b>Nomor WhatsApp</b>, kunjungi halaman profil.</li>
                                <li><b>Nama lengkap</b> harus sama dengan <b>Nama KTP</b> dan <b>Nama Rekening</b>.
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="FullName">Nama Lengkap</label>
                        <span data-section="asterisk">*</span>
                        <input maxlength="150" class="form-control" id="FullName" name="full_name"
                            placeholder="Nama Lengkap Anda" required type="text" value="{{ Auth::user()->full_name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="VerificationFile">Foto KTP</label>
                        <span data-section="asterisk">*</span>
                        <input class="form-control" id="VerificationFile" name="file" required type="file"
                            accept="image/png,image/jpeg">
                        <p class="simple-form-note">Format file: <b>PNG</b>, <b>JPEG</b>, <b>JPG</b> (Maks <b>5MB</b>).</p>
                    </div>

                    <input type="hidden" name="document_type" value="KTP">

                    <div class="form-group terms-conditions-container">
                        <h3>Syarat &amp; Ketentuan</h3>
                        <ol>
                            <li>Saya menyetujui bahwa verifikasi KTP adalah syarat wajib untuk menggunakan layanan ini.</li>
                            <li>Saya tidak akan terlibat dalam tindakan phising atau manipulasi data.</li>
                            <li>Data KTP hanya digunakan untuk tujuan verifikasi.</li>
                        </ol>
                    </div>

                    <div class="form-group">
                        <div class="standard-checkbox-container">
                            <input type="checkbox" id="terms_condition_checkbox" required>
                            <label for="terms_condition_checkbox">Saya telah membaca dan menyetujui syarat & ketentuan.</label>
                        </div>
                    </div>

                    <div class="standard-button-group">
                        <input type="submit" class="standard-secondary-button" id="submit_button" value="Kirim" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("kyc_form");
            const submitBtn = document.getElementById("submit_button");
            const alertBox = document.getElementById("alert_box");
            const checkbox = document.getElementById("terms_condition_checkbox");

            // Enable tombol setelah centang
            checkbox.addEventListener("change", () => {
                submitBtn.disabled = !checkbox.checked;
            });

            form.addEventListener("submit", async function (e) {
                e.preventDefault();

                submitBtn.disabled = true;
                const formData = new FormData(form);

                try {
                    const response = await axios.post(form.action, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    });

                    showAlert("Dokumen berhasil diupload, menunggu verifikasi admin.", "success");
                    console.log(response.data);

                } catch (error) {
                    let message = "Terjadi kesalahan!";
                    if (error.response) {
                        message = error.response.data?.message || message;
                    }
                    showAlert(message, "error");
                } finally {
                    submitBtn.disabled = false;
                }
            });

            function showAlert(message, type) {
                alertBox.innerText = message;
                alertBox.className = "";
                alertBox.classList.add(type);
                alertBox.style.display = "block";
            }
        });
    </script>
@endpush
