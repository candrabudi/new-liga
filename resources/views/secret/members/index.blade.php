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
                        </tr>
                    </thead>
                    <tbody id="member-table-body">
                        <tr>
                            <td colspan="10" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="mt-3"></div>
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

            let currentPage = 1;
            let currentSearch = "";
            let currentStatus = "";

            function renderMembers(members) {
                tbody.innerHTML = "";
                if (members.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="10" class="text-center">Tidak ada data</td></tr>`;
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
                    </tr>
                `;
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
                tbody.innerHTML = `<tr><td colspan="10" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/members/list`, {
                    params: {
                        page,
                        search: currentSearch,
                        status: currentStatus,
                    }
                }).then(res => {
                    renderMembers(res.data.data);
                    renderPagination(res.data);
                }).catch(() => {
                    tbody.innerHTML =
                        `<tr><td colspan="10" class="text-danger text-center">Gagal memuat data</td></tr>`;
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

            loadMembers();
        });
    </script>
@endpush
