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

    <div class="standard-form-container" bis_skin_checked="1">
        <div class="standard-form-title" bis_skin_checked="1">
            Verifikasi Akun Anda
        </div>
        <div class="container" bis_skin_checked="1">
            <div class="row referral-verification-container" bis_skin_checked="1">
                

                <form action="/Referral/SubmitReferralVerification" enctype="multipart/form-data" id="referral_form"
                    method="post" name="referralForm" novalidate="novalidate"><input name="__RequestVerificationToken"
                        type="hidden"
                        value="p1PXvyoP9yWFvP-_o9XJsE5vZIkqIRF_xrzlh4GmlOqbyojz_uSd56ZWLZbiqY5V6T1R8196f0pfxBOwWW4egNx33Ao1">
                    <div data-is-contact-verified="true" bis_skin_checked="1">

                        <div class="form-group" bis_skin_checked="1">
                            <div class="standard-form-note with-icon" bis_skin_checked="1">
                                <div bis_skin_checked="1">
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
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="FullName">
                                Nama Lengkap
                            </label>
                            <span data-section="asterisk">*</span>
                            <div data-section="input" bis_skin_checked="1">
                                <input maxlength="100" autocomplete="off" class="form-control" data-val="true"
                                    data-val-regex="The field FullName must match the regular expression '^[\u4e00-\u9fa5\u0E00-\u0E7F\u0400-\u04FF\u00C0-\u00FF\u0100-\u017F\u0180-\u024Fa-zA-Z0-9\uFF10-\uFF19\uFF21-\uFF3A\uFF41-\uFF5A\u0905-\u097F\u3000 ]+$'."
                                    data-val-regex-pattern="^[\u4e00-\u9fa5\u0E00-\u0E7F\u0400-\u04FF\u00C0-\u00FF\u0100-\u017F\u0180-\u024Fa-zA-Z0-9\uFF10-\uFF19\uFF21-\uFF3A\uFF41-\uFF5A\u0905-\u097F\u3000 ]+$"
                                    data-val-required="The FullName field is required." id="FullName" name="FullName"
                                    placeholder="Nama Lengkap Anda" required="required" type="text"
                                    value="BAGUS CANDRA BUDI LAKSANA">
                                <span class="standard-required-message">Nama lengkap hanya boleh berisi karakter
                                    alfanumerik.</span>
                            </div>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="IDCardPhoto">
                                Foto KTP
                            </label>
                            <span data-section="asterisk">*</span>
                            <div data-section="input" bis_skin_checked="1">
                                <input class="form-control" data-val="true"
                                    data-val-required="The VerificationFile field is required." id="VerificationFile"
                                    name="VerificationFile" required="required" type="file" value="">
                                <span class="standard-required-message">Kolom ini tidak boleh kosong.</span>
                            </div>
                            <p class="simple-form-note">Format file: <b>PNG</b>, <b>JPEG</b> dan <b>JPG (</b>Maks
                                <b>5MB)</b>.</p>
                        </div>
                        <div class="form-group terms-conditions-container" bis_skin_checked="1">
                            <h3>Syarat &amp; Ketentuan</h3>
                            <ol class="referral-verification-terms-conditions">
                                <li>Saya, sebagai pengguna, menyetujui bahwa verifikasi KTP adalah syarat wajib untuk
                                    menggunakan layanan ini, demi keamanan dan integritas platform.</li>
                                <li>Saya menegaskan bahwa saya tidak akan terlibat dalam tindakan phising. Saya memahami
                                    bahwa tindakan ini dapat mengakibatkan akun diblokir.</li>
                                <li>Terkait dengan perjanjian ini, saya dengan tegas berkomitmen untuk tidak mempromosikan
                                    referral saya di situs web pemerintahan atau lembaga sejenis.</li>
                                <li>Saya memahami dan menyetujui bahwa verifikasi KTP harus dilakukan dengan data pribadi
                                    yang sesuai dengan Kartu Tanda Penduduk (KTP) yang saya miliki, tanpa adanya perubahan
                                    atau manipulasi.</li>
                                <li>Saya memahami dan menyetujui bahwa penggunaan data KTP untuk proses verifikasi hanya
                                    akan digunakan untuk tujuan tersebut dan tidak akan disalahgunakan.</li>
                                <li>Saya setuju bahwa syarat dan ketentuan ini adalah mutlak dan dapat diubah atau
                                    diperbarui sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
                            </ol>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <div class="standard-checkbox-container" bis_skin_checked="1">
                                <input type="checkbox" name="TermsConditions" id="terms_condition_checkbox" required="">
                                <label for="terms_condition_checkbox">Saya telah membaca, memberikan persetujuan, dan
                                    menyetujui syarat dan ketentuan di atas dan setuju untuk melanjutkan proses ini.</label>
                            </div>
                        </div>
                        <div class="verification-footer" bis_skin_checked="1">
                            <picture>
                                <source
                                    srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/referral/footer/asf.webp?v=20250528"
                                    type="image/webp">
                                <source
                                    srcset="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/referral/footer/asf.png?v=20250528"
                                    type="image/png"><img loading="lazy"
                                    src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/referral/footer/asf.png?v=20250528">
                            </picture>
                            <div class="line" bis_skin_checked="1"></div>
                        </div>
                        <div class="standard-button-group" bis_skin_checked="1">
                            <input type="submit" class="standard-secondary-button" id="submit_button" value="Kirim"
                                disabled="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Default range
            let start = moment().startOf('month');
            let end = moment().endOf('month');

            function updateInputs(start, end) {
                $('#date_range_picker').val(start.format('DD-MMM-YYYY') + ' — ' + end.format('DD-MMM-YYYY'));
                $('#starting_date').val(start.format('DD-MMM-YYYY'));
                $('#ending_date').val(end.format('DD-MMM-YYYY'));
            }

            // Init daterangepicker
            $('#date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: 'DD-MMM-YYYY'
                },
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, updateInputs);

            // Set default value on load
            updateInputs(start, end);
        });
    </script>
@endpush
