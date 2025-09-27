@extends('secret.template.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative me-2">
                    <input type="text" id="search" class="form-control ps-5 radius-30" placeholder="Cari Member">
                    <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                </div>
                <div class="me-2">
                    <select id="statusFilter" class="form-select radius-30">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Non-Aktif</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Channel</th>
                            <th>No Rek / Akun</th>
                            <th>Saldo</th>
                            <th>Status</th>
                            <th>Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="member-table-body">
                        <tr>
                            <td colspan="11" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="mt-3"></div>
        </div>
    </div>

    <!-- Modal Edit Member -->
    <div class="modal fade" id="editMemberModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMemberForm">
                        <input type="hidden" id="editMemberId">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" id="editFullName" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" id="editUsername" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" id="editEmail" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" id="editPhone" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select id="editRole" class="form-select">
                                    <option value="player">Player</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select id="editStatus" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (kosongkan jika tidak ingin diubah)</label>
                            <input type="password" id="editPassword" class="form-control">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Account Name</label>
                                <input type="text" id="editAccountName" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" id="editAccountNumber" class="form-control">
                            </div>
                        </div>
                    </form>
                    <div id="editMemberAlert" class="alert d-none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="saveMemberBtn" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tbody = document.getElementById("member-table-body");
            const paginationContainer = document.getElementById("pagination-container");
            const searchInput = document.getElementById("search");
            const statusFilter = document.getElementById("statusFilter");
            const editModal = new bootstrap.Modal(document.getElementById('editMemberModal'));
            const alertBox = document.getElementById('editMemberAlert');

            let currentPage = 1;
            let currentSearch = "";
            let currentStatus = "";

            function renderMembers(members) {
                tbody.innerHTML = "";
                if (members.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="11" class="text-center">Tidak ada data</td></tr>`;
                    return;
                }
                members.forEach(m => {
                    tbody.innerHTML += `
            <tr>
                <td>#${m.id}</td>
                <td>${m.user?.full_name ?? '-'}</td>
                <td>${m.user?.username ?? '-'}</td>
                <td>${m.user?.email ?? '-'}</td>
                <td>${m.user?.phone_number ?? '-'}</td>
                <td>${m.payment_channel?.name ?? '-'}</td>
                <td>${m.account_number ?? '-'}</td>
                <td>Rp ${Number(m.balance).toLocaleString('id-ID')}</td>
                <td>
                    <span class="badge ${m.is_active ? 'bg-success' : 'bg-danger'}">
                        ${m.is_active ? 'Aktif' : 'Non-Aktif'}
                    </span>
                </td>
                <td>
                    <span class="badge ${m.is_verified ? 'bg-primary' : 'bg-secondary'}">
                        ${m.is_verified ? 'Terverifikasi' : 'Belum'}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning edit-member-btn" data-id="${m.id}">Edit</button>
                </td>
            </tr>`;
                });
            }

            function renderPagination(meta) {
                paginationContainer.innerHTML = "";
                if (meta.last_page <= 1) return;
                let html = `<nav><ul class="pagination pagination-sm justify-content-center">`;
                html += `<li class="page-item ${meta.current_page === 1 ? 'disabled' : ''}">
                <a class="page-link" href="javascript:;" data-page="${meta.current_page - 1}">Previous</a>
            </li>`;
                let start = Math.max(1, meta.current_page - 1);
                let end = Math.min(meta.last_page, meta.current_page + 1);
                if (start > 1) {
                    html +=
                        `<li class="page-item"><a class="page-link" href="javascript:;" data-page="1">1</a></li>`;
                    if (start > 2) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                for (let i = start; i <= end; i++) {
                    html += `<li class="page-item ${i === meta.current_page ? 'active' : ''}">
                    <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
                </li>`;
                }
                if (end < meta.last_page) {
                    if (end < meta.last_page - 1) html +=
                        `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    html +=
                        `<li class="page-item"><a class="page-link" href="javascript:;" data-page="${meta.last_page}">${meta.last_page}</a></li>`;
                }
                html += `<li class="page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}">
                <a class="page-link" href="javascript:;" data-page="${meta.current_page + 1}">Next</a>
            </li>`;
                html += `</ul></nav>`;
                paginationContainer.innerHTML = html;
            }

            function loadMembers(page = 1) {
                tbody.innerHTML = `<tr><td colspan="11" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/members/list`, {
                    params: {
                        page,
                        search: currentSearch,
                        status: currentStatus
                    }
                }).then(res => {
                    renderMembers(res.data.data);
                    renderPagination(res.data);
                }).catch(() => {
                    tbody.innerHTML =
                        `<tr><td colspan="11" class="text-danger text-center">Gagal memuat data</td></tr>`;
                });
            }

            paginationContainer.addEventListener("click", function(e) {
                if (e.target.tagName === "A" && e.target.dataset.page) {
                    currentPage = parseInt(e.target.dataset.page);
                    loadMembers(currentPage);
                }
            });

            searchInput.addEventListener("keyup", function(e) {
                currentSearch = e.target.value;
                currentPage = 1;
                loadMembers(currentPage);
            });

            statusFilter.addEventListener("change", function() {
                currentStatus = this.value;
                currentPage = 1;
                loadMembers(currentPage);
            });

            // Open modal & load data
            document.body.addEventListener("click", function(e) {
                if (e.target.classList.contains("edit-member-btn")) {
                    const memberId = e.target.dataset.id;
                    axios.get(`/secret/members/${memberId}`)
                        .then(res => {
                            const m = res.data;
                            document.getElementById('editMemberId').value = m.id;
                            document.getElementById('editFullName').value = m.user.full_name;
                            document.getElementById('editUsername').value = m.user.username;
                            document.getElementById('editEmail').value = m.user.email;
                            document.getElementById('editPhone').value = m.user.phone_number;
                            document.getElementById('editRole').value = m.user.role;
                            document.getElementById('editStatus').value = m.is_active ? 1 : 0;
                            document.getElementById('editAccountName').value = m.account_name || '';
                            document.getElementById('editAccountNumber').value = m.account_number || '';
                            document.getElementById('editPassword').value = '';
                            alertBox.classList.add('d-none');
                            editModal.show();
                        });
                }
            });

            document.getElementById('saveMemberBtn').addEventListener('click', function() {
                const memberId = document.getElementById('editMemberId').value;
                const payload = {
                    full_name: document.getElementById('editFullName').value,
                    username: document.getElementById('editUsername').value,
                    email: document.getElementById('editEmail').value,
                    phone_number: document.getElementById('editPhone').value,
                    role: document.getElementById('editRole').value,
                    is_active: document.getElementById('editStatus').value,
                    account_name: document.getElementById('editAccountName').value,
                    account_number: document.getElementById('editAccountNumber').value,
                    password: document.getElementById('editPassword').value,
                };

                axios.put(`/secret/members/${memberId}`, payload)
                    .then(res => {
                        alertBox.classList.remove('d-none', 'alert-danger');
                        alertBox.classList.add('alert-success');
                        alertBox.innerText = "Data berhasil diupdate";
                        loadMembers();
                        setTimeout(() => editModal.hide(), 1000);
                    })
                    .catch(err => {
                        alertBox.classList.remove('d-none', 'alert-success');
                        alertBox.classList.add('alert-danger');
                        alertBox.innerText = err.response?.data?.message || "Gagal menyimpan perubahan";
                    });
            });

            loadMembers();
        });
    </script>
@endpush
