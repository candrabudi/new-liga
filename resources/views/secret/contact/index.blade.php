@extends('secret.template.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h4 class="mb-2 mb-lg-0">Manajemen Kontak</h4>
        <button id="btn-reset" class="btn btn-sm btn-outline-secondary">Reset Form</button>
    </div>

    <div class="row g-3">
        <!-- Table -->
        <div class="col-12 col-lg-8 order-2 order-lg-1">
            <div class="card radius-10 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Daftar Kontak</h5>
                        </div>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;" id="btn-reset">Reset Form</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th>Platform</th>
                                    <th>Nama</th>
                                    <th>Link</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="contactTable">
                                @forelse($contacts as $c)
                                    <tr id="row-{{ $c->id }}" data-id="{{ $c->id }}"
                                        data-platform="{{ e($c->platform) }}"
                                        data-name="{{ e($c->name) }}"
                                        data-link="{{ e($c->link) }}"
                                        data-icon="{{ e($c->icon) }}"
                                        data-is_active="{{ $c->is_active }}">
                                        <td class="fw-semibold">{{ ucfirst($c->platform) }}</td>
                                        <td>{{ $c->name ?? '-' }}</td>
                                        <td>
                                            @if ($c->link)
                                                <a href="{{ $c->link }}" target="_blank" class="text-decoration-none">{{ $c->link }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($c->icon)
                                                <img src="{{ $c->icon }}" style="width:28px;height:28px;object-fit:contain;">
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="badge rounded-pill bg-light-{{ $c->is_active ? 'success text-success' : 'secondary text-muted' }} w-100">
                                                {{ $c->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex order-actions justify-content-end">
                                                <a href="javascript:;" class="btn-edit" data-id="{{ $c->id }}">
                                                    <i class="bx bx-cog"></i>
                                                </a>
                                                <a href="javascript:;" class="ms-3 text-danger btn-delete" data-id="{{ $c->id }}">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="6" class="text-center text-muted">Belum ada kontak.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="col-12 col-lg-4 order-1 order-lg-2">
            <div class="card h-100">
                <div class="card-body">
                    <h6 id="formTitle" class="mb-3">Tambah Kontak</h6>
                    <form id="contactForm">
                        @csrf
                        <input type="hidden" id="contact_id" name="contact_id">

                        <div class="mb-3">
                            <label class="form-label">Platform</label>
                            <select class="form-select form-select-sm" id="platform" name="platform">
                                <option value="">-- Pilih Platform --</option>
                                <option value="telegram">Telegram</option>
                                <option value="whatsapp">WhatsApp</option>
                                <option value="line">LINE</option>
                                <option value="messenger">Messenger</option>
                                <option value="instagram">Instagram</option>
                                <option value="twitter">Twitter</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="other">Other</option>
                            </select>
                            <small class="text-danger" id="error_platform"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name">
                            <small class="text-danger" id="error_name"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control form-control-sm" id="link" name="link">
                            <small class="text-danger" id="error_link"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Icon (URL / Path)</label>
                            <input type="text" class="form-control form-control-sm" id="icon" name="icon">
                            <small class="text-danger" id="error_icon"></small>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label">Aktif</label>
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    (() => {
        const form = document.getElementById('contactForm');
        const table = document.getElementById('contactTable');
        const formTitle = document.getElementById('formTitle');
        const contactId = document.getElementById('contact_id');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const cancelBtn = document.getElementById('cancelBtn');
        const resetBtn = document.getElementById('btn-reset');

        const errorFields = {
            platform: document.getElementById('error_platform'),
            name: document.getElementById('error_name'),
            link: document.getElementById('error_link'),
            icon: document.getElementById('error_icon'),
        };

        function resetForm() {
            form.reset();
            contactId.value = '';
            formTitle.textContent = 'Tambah Kontak';
            Object.values(errorFields).forEach(e => e.textContent = '');
        }

        resetBtn.addEventListener('click', resetForm);
        cancelBtn.addEventListener('click', resetForm);

        table.addEventListener('click', e => {
            if (e.target.closest('.btn-edit')) {
                const id = e.target.closest('.btn-edit').dataset.id;
                const row = document.getElementById(`row-${id}`);
                contactId.value = row.dataset.id;
                formTitle.textContent = 'Edit Kontak';
                form.platform.value = row.dataset.platform;
                form.name.value = row.dataset.name;
                form.link.value = row.dataset.link;
                form.icon.value = row.dataset.icon;
                form.is_active.checked = row.dataset.is_active === "1";
            }

            if (e.target.closest('.btn-delete')) {
                const id = e.target.closest('.btn-delete').dataset.id;
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data kontak akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        axios.delete(`/secret/contacts/delete/${id}`).then(res => {
                            document.getElementById(`row-${id}`).remove();

                            if (table.querySelectorAll('tr').length === 0) {
                                table.innerHTML = `
                                    <tr class="empty-row">
                                        <td colspan="6" class="text-center text-muted">Belum ada kontak.</td>
                                    </tr>
                                `;
                            }

                            Swal.fire('Berhasil!', res.data.message, 'success');
                        }).catch(() => {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
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

            let id = contactId.value;
            let url = id ? `/secret/contacts/update/${id}` : `/secret/contacts/store`;
            let data = new FormData(form);

            axios.post(url, data).then(res => {
                let c = res.data.data;
                let row = document.getElementById(`row-${c.id}`);

                if (!row) {
                    let emptyRow = table.querySelector('.empty-row');
                    if (emptyRow) emptyRow.remove();

                    let newRow = `
                        <tr id="row-${c.id}" 
                            data-id="${c.id}" 
                            data-platform="${c.platform}" 
                            data-name="${c.name ?? ''}" 
                            data-link="${c.link ?? ''}" 
                            data-icon="${c.icon ?? ''}" 
                            data-is_active="${c.is_active ? 1 : 0}">
                            <td class="fw-semibold">${c.platform.charAt(0).toUpperCase() + c.platform.slice(1)}</td>
                            <td>${c.name ?? '-'}</td>
                            <td>${c.link ? `<a href="${c.link}" target="_blank">${c.link}</a>` : '-'}</td>
                            <td>${c.icon ? `<img src="${c.icon}" style="width:28px;height:28px;object-fit:contain;">` : '<span class="text-muted small">-</span>'}</td>
                            <td>
                                <div class="badge rounded-pill bg-light-${c.is_active ? 'success text-success' : 'secondary text-muted'} w-100">
                                    ${c.is_active ? 'Aktif' : 'Nonaktif'}
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex order-actions justify-content-end">
                                    <a href="javascript:;" class="btn-edit" data-id="${c.id}"><i class="bx bx-cog"></i></a>
                                    <a href="javascript:;" class="ms-3 text-danger btn-delete" data-id="${c.id}"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
                        </tr>`;
                    table.insertAdjacentHTML('afterbegin', newRow);
                } else {
                    row.dataset.platform = c.platform;
                    row.dataset.name = c.name ?? '';
                    row.dataset.link = c.link ?? '';
                    row.dataset.icon = c.icon ?? '';
                    row.dataset.is_active = c.is_active ? 1 : 0;

                    row.querySelector('td:nth-child(1)').textContent = c.platform.charAt(0).toUpperCase() + c.platform.slice(1);
                    row.querySelector('td:nth-child(2)').textContent = c.name ?? '-';
                    row.querySelector('td:nth-child(3)').innerHTML = c.link ? `<a href="${c.link}" target="_blank">${c.link}</a>` : '-';
                    row.querySelector('td:nth-child(4)').innerHTML = c.icon ? `<img src="${c.icon}" style="width:28px;height:28px;object-fit:contain;">` : '<span class="text-muted small">-</span>';
                    row.querySelector('td:nth-child(5)').innerHTML =
                        `<div class="badge rounded-pill bg-light-${c.is_active ? 'success text-success' : 'secondary text-muted'} w-100">${c.is_active ? 'Aktif' : 'Nonaktif'}</div>`;
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
