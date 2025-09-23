@extends('secret.template.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card radius-10">
                <div class="card-body p-4">
                    <h5 class="card-title">Profile Saya</h5>
                    <hr>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('secret.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak ingin ganti" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Kosongkan jika tidak ingin ganti" readonly>
                        </div>

                        <button type="button" id="btn-edit" class="btn btn-warning mb-2">Edit</button>
                        <button type="submit" class="btn btn-primary mb-2" id="btn-save"
                            style="display:none;">Simpan</button>
                        <button type="button" class="btn btn-secondary mb-2" id="btn-cancel"
                            style="display:none;">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnEdit = document.getElementById('btn-edit');
            const btnSave = document.getElementById('btn-save');
            const btnCancel = document.getElementById('btn-cancel');
            const formInputs = document.querySelectorAll('form input');

            btnEdit.addEventListener('click', function() {
                formInputs.forEach(input => input.removeAttribute('readonly'));
                btnEdit.style.display = 'none';
                btnSave.style.display = 'inline-block';
                btnCancel.style.display = 'inline-block';
            });

            btnCancel.addEventListener('click', function() {
                formInputs.forEach(input => input.setAttribute('readonly', true));
                btnEdit.style.display = 'inline-block';
                btnSave.style.display = 'none';
                btnCancel.style.display = 'none';
            });
        });
    </script>
@endpush
