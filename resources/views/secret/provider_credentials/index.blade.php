@extends('secret.template.app')

@section('content')
    <div class="form-body mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title">Provider Credentials</h5>
                        <hr>
                        <div class="border border-3 p-4 rounded">
                            <div id="message" class="alert d-none"></div>
                            <form id="providerForm">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">URL</label>
                                    <input type="text" name="url" id="url" class="form-control"
                                        value="{{ $credential->url ?? '' }}">
                                    <span class="text-danger" id="error_url"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Agent Code</label>
                                    <input type="text" name="agent_code" id="agent_code" class="form-control"
                                        value="{{ $credential->agent_code ?? '' }}">
                                    <span class="text-danger" id="error_agent_code"></span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Agent Token</label>
                                    <input type="text" name="agent_token" id="agent_token" class="form-control"
                                        value="{{ $credential->agent_token ?? '' }}">
                                    <span class="text-danger" id="error_agent_token"></span>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Credential</button>
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
        document.getElementById('providerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let messageBox = document.getElementById('message');
            let submitBtn = document.getElementById('submitBtn');

            messageBox.classList.add('d-none');
            messageBox.classList.remove('alert-success', 'alert-danger');
            ['url', 'agent_code', 'agent_token'].forEach(field => {
                document.getElementById('error_' + field).innerText = '';
            });

            let originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Menyimpan...';
            submitBtn.disabled = true;

            axios.post("{{ route('secret.provider.storeOrUpdate') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                .then(response => {
                    messageBox.classList.remove('d-none', 'alert-danger');
                    messageBox.classList.add('alert-success');
                    messageBox.innerText = 'Berhasil! ' + response.data.message;
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
