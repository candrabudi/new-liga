@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/profile.css') }}">
    <style>
        #alert_box {
            display: none;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-weight: bold;
        }
        #alert_box.success { background-color: #d4edda; color: #155724; }
        #alert_box.error { background-color: #f8d7da; color: #721c24; }
    </style>
@endpush

@section('content')
    @include('mobile.account.components.tab')
    <div class="standard-form-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="standard-form-title">UBAH KATA SANDI</div>
                    <div id="alert_box"></div>
                    <div class="standard-form-note">
                        <span>Catatan:</span>
                        <ol>
                            <li>Kata Sandi harus terdiri dari 8-20 karakter.</li>
                            <li>Kata Sandi harus mengandung huruf dan angka.</li>
                            <li>Kata Sandi tidak boleh mengandung username.</li>
                            <li>Kata Sandi tidak boleh mengandung simbol &amp;, &lt;, atau &gt;</li>
                        </ol>
                    </div>

                    <form id="password_form" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="OldPassword">Kata Sandi Saat Ini</label>
                            <input maxlength="20" class="form-control" id="OldPassword" name="OldPassword"
                                placeholder="Kata Sandi Saat Ini" type="password" required>
                        </div>
                        <div class="form-group standard-password-field">
                            <label for="NewPassword">Kata Sandi Baru</label>
                            <input maxlength="20" class="form-control" id="NewPassword" name="NewPassword"
                                placeholder="Kata Sandi Baru" type="password" required>
                        </div>
                        <div class="form-group standard-password-field">
                            <label for="ConfirmPassword">Ulangi Kata Sandi</label>
                            <input maxlength="20" class="form-control" id="ConfirmPassword" name="ConfirmPassword"
                                placeholder="Ulangi Kata Sandi" type="password" required>
                        </div>
                        <div class="standard-button-group">
                            <button type="submit" class="standard-secondary-button">UBAH KATA SANDI</button>
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
    const form = document.getElementById('password_form');
    const alertBox = document.getElementById('alert_box');
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const showAlert = (message, type = 'success') => {
        alertBox.textContent = message;
        alertBox.className = '';
        alertBox.classList.add(type);
        alertBox.style.display = 'block';
        setTimeout(() => { alertBox.style.display = 'none'; }, 5000);
    };

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const oldPassword = document.getElementById('OldPassword').value.trim();
        const newPassword = document.getElementById('NewPassword').value.trim();
        const confirmPassword = document.getElementById('ConfirmPassword').value.trim();
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^*()_+=\[\]{}|:;"',.?/~`\-]{8,20}$/;

        if (!oldPassword || !newPassword || !confirmPassword) {
            showAlert('Semua kolom harus diisi.', 'error');
            return;
        }
        if (newPassword !== confirmPassword) {
            showAlert('Kata sandi baru dan konfirmasi tidak cocok.', 'error');
            return;
        }
        if (!passwordRegex.test(newPassword)) {
            showAlert('Kata sandi tidak memenuhi kriteria (8-20 karakter, huruf dan angka, tanpa simbol & < >).', 'error');
            return;
        }

        axios.post('/Profile/Password', { OldPassword: oldPassword, NewPassword: newPassword, ConfirmPassword: confirmPassword })
            .then(res => {
                showAlert(res.data.message || 'Kata sandi berhasil diubah.', 'success');
                form.reset();
            })
            .catch(err => {
                showAlert(err.response?.data?.message || 'Terjadi kesalahan saat mengubah kata sandi.', 'error');
            });
    });
});
</script>
@endpush
