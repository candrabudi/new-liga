@extends('secret.template.app')

@section('content')
    <div class="form-body mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Pengaturan Website</h5>
                        <hr>
                        <div class="border border-3 p-4 rounded">
                            <div id="message" class="alert d-none"></div>
                            <form id="websiteForm" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Nama Website</label>
                                    <input type="text" name="website_name" id="website_name" class="form-control"
                                        value="{{ $website->website_name ?? '' }}">
                                    <span class="text-danger" id="error_website_name"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Logo Website</label>
                                    <input type="file" name="website_logo" id="website_logo" class="form-control">
                                    @if (!empty($website->website_logo))
                                        <img src="{{ $website->website_logo }}" width="100" class="mt-2"
                                            id="logo_preview">
                                    @endif
                                    <span class="text-danger" id="error_website_logo"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Favicon Website</label>
                                    <input type="file" name="website_favicon" id="website_favicon" class="form-control">
                                    @if (!empty($website->website_favicon))
                                        <img src="{{ $website->website_favicon }}" width="32" class="mt-2"
                                            id="favicon_preview">
                                    @endif
                                    <span class="text-danger" id="error_website_favicon"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Website</label>
                                    <textarea name="website_description" id="website_description" class="form-control">{{ $website->website_description ?? '' }}</textarea>
                                    <span class="text-danger" id="error_website_description"></span>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="website_maintenance"
                                        id="website_maintenance" value="1"
                                        {{ !empty($website->website_maintenance) && $website->website_maintenance ? 'checked' : '' }}>
                                    <label class="form-check-label">Mode Maintenance</label>
                                    <span class="text-danger" id="error_website_maintenance"></span>
                                </div>

                                <!-- Input Live Chat -->
                                <div class="mb-3">
                                    <label class="form-label">Live Chat Script / URL</label>
                                    <textarea name="link_livechat" id="link_livechat" class="form-control">{{ $website->link_livechat ?? '' }}</textarea>
                                    <span class="text-danger" id="error_link_livechat"></span>
                                </div>

                                <!-- Input Telegram -->
                                <div class="mb-3">
                                    <label class="form-label">Link Telegram</label>
                                    <input type="text" name="link_telegram" id="link_telegram" class="form-control"
                                        value="{{ $website->link_telegram ?? '' }}">
                                    <span class="text-danger" id="error_link_telegram"></span>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Website</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('websiteForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let messageBox = document.getElementById('message');
            let submitBtn = document.getElementById('submitBtn');

            // Reset error
            messageBox.classList.add('d-none');
            messageBox.classList.remove('alert-success', 'alert-danger');
            ['website_name', 'website_logo', 'website_favicon', 'website_description', 'website_maintenance',
                'link_livechat', 'link_telegram'
            ]
            .forEach(field => {
                document.getElementById('error_' + field).innerText = '';
            });

            let originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Menyimpan...';
            submitBtn.disabled = true;

            axios.post("{{ route('secret.website.storeOrUpdate') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                .then(response => {
                    messageBox.classList.remove('d-none', 'alert-danger');
                    messageBox.classList.add('alert-success');
                    messageBox.innerText = 'Berhasil! ' + response.data.message;

                    // Update preview logo & favicon
                    if (response.data.logo_url) {
                        document.getElementById('logo_preview').src = response.data.logo_url;
                    }
                    if (response.data.favicon_url) {
                        document.getElementById('favicon_preview').src = response.data.favicon_url;
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        let errors = error.response.data.errors;
                        for (let key in errors) {
                            if (document.getElementById('error_' + key))
                                document.getElementById('error_' + key).innerText = errors[key][0];
                        }
                        messageBox.classList.remove('d-none', 'alert-success');
                        messageBox.classList.add('alert-danger');
                        messageBox.innerText = 'Terjadi kesalahan, silakan periksa input Anda.';
                    } else {
                        messageBox.classList.remove('d-none', 'alert-success');
                        messageBox.classList.add('alert-danger');
                        messageBox.innerText = 'Terjadi kesalahan server. Silakan coba lagi.';
                    }
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });
    </script>
@endpush
