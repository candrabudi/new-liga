@extends('secret.template.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Daftar Akun Owner</h5>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Channel</th>
                                    <th>Nama Akun</th>
                                    <th>No. Rekening</th>
                                    <th>QRIS</th>
                                    <th>Status</th>
                                    <th width="160">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($owners as $owner)
                                    <tr>
                                        <td>{{ $owner->channel->name ?? '-' }}</td>
                                        <td>{{ $owner->account_name }}</td>
                                        <td>{{ $owner->account_number }}</td>
                                        <td>
                                            @if ($owner->qris_image)
                                                <img src="{{ asset('storage/' . $owner->qris_image) }}" alt="QRIS"
                                                    width="50">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $owner->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $owner->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning"
                                                onclick="editOwner({{ $owner->id }}, '{{ $owner->payment_channel_id }}', '{{ $owner->account_name }}', '{{ $owner->account_number }}', {{ $owner->is_active ? 'true' : 'false' }}, '{{ $owner->qris_image ?? '' }}')">
                                                Edit
                                            </button>
                                            <form action="{{ route('secret.payment_owners.destroy', $owner->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus owner ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada akun owner</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3" id="form-title">Tambah Owner Baru</h5>
                    <form id="owner-form" action="{{ route('secret.payment_owners.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="form-method" name="_method" value="POST">

                        <div class="mb-3">
                            <label for="payment_channel_id" class="form-label">Channel</label>
                            <select name="payment_channel_id" id="payment_channel_id" class="form-select">
                                @foreach ($channels as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="account_name" class="form-label">Nama Akun</label>
                            <input type="text" name="account_name" id="account_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="account_number" class="form-label">No. Rekening</label>
                            <input type="text" name="account_number" id="account_number" class="form-control" required>
                        </div>

                        <!-- QRIS Upload untuk semua channel -->
                        <div class="mb-3">
                            <label for="qris_image" class="form-label">Upload QRIS</label>
                            <input type="file" name="qris_image" id="qris_image" class="form-control" accept="image/*">
                            <img id="qris-preview" src="" alt="Preview QRIS" class="mt-2"
                                style="max-width:100px; display:none;">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="form-submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editOwner(id, channelId, accountName, accountNumber, isActive, qrisImage) {
            document.getElementById('form-title').innerText = "Edit Owner";
            const form = document.getElementById('owner-form');
            form.action = `/secret/payment-owners/update/${id}`;
            document.getElementById('form-method').value = "PUT";
            document.getElementById('payment_channel_id').value = channelId;
            document.getElementById('account_name').value = accountName;
            document.getElementById('account_number').value = accountNumber;
            document.getElementById('is_active').checked = isActive;

            // tampilkan preview QRIS jika ada
            const qrisPreview = document.getElementById('qris-preview');
            if (qrisImage) {
                qrisPreview.src = `/storage/${qrisImage}`;
                qrisPreview.style.display = 'block';
            } else {
                qrisPreview.style.display = 'none';
            }

            document.getElementById('form-submit').innerText = "Update";
        }

        // preview QRIS sebelum submit
        document.getElementById('qris_image').addEventListener('change', function(e) {
            const preview = document.getElementById('qris-preview');
            const file = e.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
