@extends('secret.template.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Manajemen Banner</h4>
            <button id="btn-reset" class="btn btn-sm btn-outline-secondary">Reset Form</button>
        </div>

        <div class="row">
            <!-- Table -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table align-middle mb-0" id="bannerTableWrapper">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul & Link</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bannerTable">
                                @forelse($banners as $banner)
                                    <tr id="row-{{ $banner->id }}" data-id="{{ $banner->id }}"
                                        data-title="{{ e($banner->title) }}"
                                        data-description="{{ e($banner->description) }}" data-link="{{ e($banner->link) }}"
                                        data-image-path="{{ $banner->image_path }}">
                                        <td>
                                            <div class="fw-semibold">{{ $banner->title }}</div>
                                            <div class="text-muted small">{{ $banner->link ?? '-' }}</div>
                                        </td>
                                        <td class="text-muted small">{{ Str::limit($banner->description, 80) }}</td>
                                        <td>
                                            <img src="{{ $banner->image_path }}" alt="thumb" class="rounded"
                                                style="width:80px; height:50px; object-fit:cover;">
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-primary btn-edit"
                                                data-id="{{ $banner->id }}">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger btn-delete"
                                                data-id="{{ $banner->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="4" class="text-center text-muted">Belum ada banner.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h6 id="formTitle" class="mb-3">Tambah Banner</h6>
                        <form id="bannerForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="banner_id" name="banner_id">

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" id="title" name="title">
                                <small class="text-danger" id="error_title"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                <small class="text-danger" id="error_description"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link</label>
                                <input type="text" class="form-control" id="link" name="link">
                                <small class="text-danger" id="error_link"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image_path" name="image_path"
                                    accept="image/*">
                                <small class="text-danger" id="error_image_path"></small>
                                <div class="mt-2">
                                    <img id="previewImage" src="" class="d-none rounded"
                                        style="width:100px; height:60px; object-fit:cover;">
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" id="submitBtn" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm d-none" id="btnSpinner"></span>
                                    <span id="btnText">Simpan</span>
                                </button>
                                <button type="button" id="cancelBtn" class="btn btn-outline-secondary">Batal</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (() => {
            const form = document.getElementById('bannerForm');
            const table = document.getElementById('bannerTable');
            const formTitle = document.getElementById('formTitle');
            const bannerId = document.getElementById('banner_id');
            const preview = document.getElementById('previewImage');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const cancelBtn = document.getElementById('cancelBtn');
            const resetBtn = document.getElementById('btn-reset');

            const errorFields = {
                title: document.getElementById('error_title'),
                description: document.getElementById('error_description'),
                link: document.getElementById('error_link'),
                image_path: document.getElementById('error_image_path'),
            };

            function resetForm() {
                form.reset();
                bannerId.value = '';
                formTitle.textContent = 'Tambah Banner';
                preview.classList.add('d-none');
                Object.values(errorFields).forEach(e => e.textContent = '');
            }

            resetBtn.addEventListener('click', resetForm);
            cancelBtn.addEventListener('click', resetForm);

            document.getElementById('image_path').addEventListener('change', e => {
                const file = e.target.files[0];
                if (!file) return preview.classList.add('d-none');
                const reader = new FileReader();
                reader.onload = ev => {
                    preview.src = ev.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            });

            table.addEventListener('click', e => {
                if (e.target.classList.contains('btn-edit')) {
                    const id = e.target.dataset.id;
                    const row = document.getElementById(`row-${id}`);
                    bannerId.value = row.dataset.id;
                    formTitle.textContent = 'Edit Banner';
                    form.title.value = row.dataset.title;
                    form.description.value = row.dataset.description;
                    form.link.value = row.dataset.link;
                    if (row.dataset.imagePath) {
                        preview.src = row.dataset.imagePath;
                        preview.classList.remove('d-none');
                    } else {
                        preview.classList.add('d-none');
                    }
                }

                if (e.target.classList.contains('btn-delete')) {
                    const id = e.target.dataset.id;
                    Swal.fire({
                        title: 'Yakin hapus?',
                        text: "Data banner akan dihapus permanen.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then(result => {
                        if (result.isConfirmed) {
                            axios.delete(`/secret/banners/delete/${id}`).then(res => {
                                document.getElementById(`row-${id}`).remove();

                                // kalau tabel kosong → tampilkan row "Belum ada banner."
                                if (table.querySelectorAll('tr').length === 0) {
                                    table.innerHTML = `
                                <tr class="empty-row">
                                    <td colspan="4" class="text-center text-muted">Belum ada banner.</td>
                                </tr>
                            `;
                                }

                                Swal.fire('Berhasil!', res.data.message, 'success');
                            }).catch(() => {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.',
                                    'error');
                            });
                        }
                    });
                }
            });

            form.addEventListener('submit', e => {
                e.preventDefault();
                Object.values(errorFields).forEach(e => e.textContent = '');
                submitBtn.disabled = true;
                btnText.textContent = 'Menyimpan...';
                btnSpinner.classList.remove('d-none');

                let id = bannerId.value;
                let url = id ? `/secret/banners/update/${id}` : `/secret/banners/store`;
                let data = new FormData(form);

                axios.post(url, data).then(res => {
                    let b = res.data.data;
                    let row = document.getElementById(`row-${b.id}`);

                    if (!row) {
                        // hapus row kosong
                        let emptyRow = table.querySelector('.empty-row');
                        if (emptyRow) emptyRow.remove();

                        let newRow = `
                <tr id="row-${b.id}" 
                    data-id="${b.id}" 
                    data-title="${b.title}" 
                    data-description="${b.description ?? ''}" 
                    data-link="${b.link ?? ''}" 
                    data-image-path="${b.image_path}">
                    <td>
                        <div class="fw-semibold">${b.title}</div>
                        <div class="text-muted small">${b.link ?? '-'}</div>
                    </td>
                    <td class="text-muted small">${b.description ?? ''}</td>
                    <td><img src="${b.image_path}" class="rounded" style="width:80px; height:50px; object-fit:cover;"></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-primary btn-edit" data-id="${b.id}">Edit</button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${b.id}">Hapus</button>
                    </td>
                </tr>`;
                        table.insertAdjacentHTML('afterbegin', newRow);
                    } else {
                        row.dataset.title = b.title;
                        row.dataset.description = b.description ?? '';
                        row.dataset.link = b.link ?? '';
                        row.dataset.imagePath = b.image_path;
                        row.querySelector('td:nth-child(1) .fw-semibold').textContent = b.title;
                        row.querySelector('td:nth-child(1) .text-muted').textContent = b.link ?? '-';
                        row.querySelector('td:nth-child(2)').textContent = b.description ?? '';
                        row.querySelector('td:nth-child(3) img').src = b.image_path;
                    }

                    resetForm();
                    Swal.fire('Berhasil!', res.data.message, 'success');
                }).catch(err => {
                    if (err.response?.status === 422) {
                        let errors = err.response.data.errors;
                        for (let key in errors) {
                            if (errorFields[key]) errorFields[key].textContent = errors[key][0];
                        }
                    } else {
                        Swal.fire('Gagal!', 'Terjadi kesalahan server.', 'error');
                    }
                }).finally(() => {
                    submitBtn.disabled = false;
                    btnText.textContent = 'Simpan';
                    btnSpinner.classList.add('d-none');
                });
            });
        })();
    </script>
@endpush
