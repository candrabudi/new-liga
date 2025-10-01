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
    @include('mobile.account.components.tab')

    
    <div class="standard-form-container profile-container">
        <div class="container">
            <div id="alert_box" style="padding: 10px;"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="standard-form-title">
                        PROFIL SAYA
                    </div>
                    <div class="standard-form-content">
                        <form id="form0" method="post" novalidate="novalidate">
                            @csrf
                            <div class="standard-sub-section">
                                <div class="standard-form-title">Informasi Pribadi</div>
                                <div class="standard-form-content form_subcategory">
                                    <div class="form-group">
                                        <label for="FullName">Nama Lengkap</label>
                                        <input class="form-control" id="FullName" name="FullName" type="text"
                                            value="{{ old('FullName', $profile->full_name ?? $user->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender">Jenis Kelamin</label>
                                        <select class="form-control" id="Gender" name="Gender">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="M"
                                                {{ old('Gender', $profile->gender ?? '') == 'M' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="F"
                                                {{ old('Gender', $profile->gender ?? '') == 'F' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Address">Alamat</label>
                                        <textarea class="form-control" id="Address" name="Address" rows="5">{{ old('Address', $profile->address ?? '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="PostCode">Kode Pos</label>
                                        <input class="form-control" id="Postcode" name="Postcode" type="text"
                                            value="{{ old('Postcode', $profile->postcode ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="State">Propinsi</label>
                                        <input class="form-control" id="State" name="State" type="text"
                                            value="{{ old('State', $profile->state ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="standard-sub-section">
                                <div class="standard-form-title">Informasi Kontak</div>
                                <div class="standard-form-content form_subcategory">
                                    <div class="form-group">
                                        <label for="ContactNo">Nomor Kontak</label>
                                        <input maxlength="16" class="form-control" id="ContactNo" name="ContactNo"
                                            type="text" value="{{ old('ContactNo', $profile->contact_no ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input class="form-control" id="Email" name="Email" type="text"
                                            value="{{ old('Email', $profile->email ?? $user->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Telegram">Telegram</label>
                                        <input class="form-control" id="Telegram" name="Telegram" type="text"
                                            maxlength="16" value="{{ old('Telegram', $profile->telegram ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="WhatsApp">WhatsApp</label>
                                        <input class="form-control" id="WhatsApp" name="WhatsApp" type="text"
                                            maxlength="16" value="{{ old('WhatsApp', $profile->whatsapp ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="WeChat">WeChat</label>
                                        <input class="form-control" id="WeChat" name="WeChat" type="text"
                                            value="{{ old('WeChat', $profile->wechat ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Line">Line</label>
                                        <input class="form-control" id="Line" name="Line" type="text"
                                            value="{{ old('Line', $profile->line ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="standard-button-group">
                                <button type="submit" class="standard-secondary-button">
                                    Simpan Data Profil Saya
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form0');
            const alertBox = document.getElementById('alert_box');

            axios.defaults.headers.common['X-CSRF-TOKEN'] =
                document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const showAlert = (message, type = 'success') => {
                alertBox.textContent = message;
                alertBox.className = '';
                alertBox.classList.add(type);
                alertBox.style.display = 'block';
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 5000);
            };

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);

                axios.post("{{ route('profile.save') }}", formData)
                    .then(res => {
                        showAlert(res.data.message || 'Profil berhasil disimpan.', 'success');
                    })
                    .catch(err => {
                        if (err.response?.data?.errors) {
                            let messages = Object.values(err.response.data.errors).flat().join(' ');
                            showAlert(messages, 'error');
                        } else {
                            showAlert(err.response?.data?.message ||
                                'Terjadi kesalahan saat menyimpan profil.', 'error');
                        }
                    });
            });
        });
    </script>
@endpush
