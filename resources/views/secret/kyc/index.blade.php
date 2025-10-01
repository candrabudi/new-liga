@extends('secret.template.app')

@section('content')
    <div class="card radius-10">
        <div class="card-body">
            <h5 class="mb-3">Daftar KYC Request</h5>

            {{-- Search & Filter --}}
            <div class="d-flex mb-3">
                <input type="text" id="search" class="form-control me-2" placeholder="Cari nama / no hp">
                <select id="statusFilter" class="form-select" style="width:200px">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Referral</th>
                            <th>Bukti Upload</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kyc-table-body">
                        <tr>
                            <td colspan="7" class="text-center">Loading...</td>
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
            const tbody = document.getElementById("kyc-table-body");
            const pagination = document.getElementById("pagination-container");
            const searchInput = document.getElementById("search");
            const statusFilter = document.getElementById("statusFilter");

            let currentPage = 1;
            let currentSearch = "";
            let currentStatus = "";

            function renderTable(data) {
                tbody.innerHTML = "";
                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data</td></tr>`;
                    return;
                }

                data.forEach(k => {
                    let filePreview = "";
                    if (k.file_path.endsWith(".pdf")) {
                        filePreview =
                            `<a href="/storage/${k.file_path}" target="_blank" class="btn btn-sm btn-info">Lihat PDF</a>`;
                    } else {
                        filePreview =
                            `<a href="/storage/${k.file_path}" target="_blank"><img src="/storage/${k.file_path}" height="60"></a>`;
                    }

                    tbody.innerHTML += `
                <tr>
                    <td>#${k.id}</td>
                    <td>${k.profile?.full_name ?? '-'}</td>
                    <td>${k.profile?.contact_no ?? '-'}</td>
                    <td>${k.referral_code ?? '-'}</td>
                    <td>${filePreview}</td>
                    <td>
                        <span class="badge ${k.status === 'approved' ? 'bg-success' : (k.status === 'rejected' ? 'bg-danger' : 'bg-warning')}">
                            ${k.status}
                        </span>
                    </td>
                    <td>
                        ${k.status === 'pending' ? `
                            <button class="btn btn-sm btn-success" onclick="reviewKyc(${k.id}, 'approved')">Approve</button>
                            <button class="btn btn-sm btn-danger" onclick="reviewKyc(${k.id}, 'rejected')">Reject</button>
                            ` : '-'}
                    </td>
                </tr>
            `;
                });
            }

            function renderPagination(meta) {
                pagination.innerHTML = "";
                if (meta.last_page <= 1) return;

                let html = `<nav><ul class="pagination justify-content-center">`;
                for (let i = 1; i <= meta.last_page; i++) {
                    html += `<li class="page-item ${i === meta.current_page ? 'active' : ''}">
                        <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
                     </li>`;
                }
                html += `</ul></nav>`;
                pagination.innerHTML = html;

                pagination.querySelectorAll("a").forEach(el => {
                    el.addEventListener("click", function() {
                        currentPage = parseInt(this.dataset.page);
                        loadKyc();
                    });
                });
            }

            function loadKyc() {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/kyc/list`, {
                    params: {
                        page: currentPage,
                        search: currentSearch,
                        status: currentStatus
                    }
                }).then(res => {
                    renderTable(res.data.data);
                    renderPagination(res.data);
                }).catch(() => {
                    tbody.innerHTML =
                        `<tr><td colspan="7" class="text-danger text-center">Gagal memuat data</td></tr>`;
                });
            }

            window.reviewKyc = function(id, status) {
                let reason = null;
                if (status === 'rejected') {
                    reason = prompt("Masukkan alasan penolakan:");
                    if (!reason) return;
                }

                axios.post(`/secret/kyc/review/${id}`, {
                    status: status,
                    rejection_reason: reason
                }).then(res => {
                    alert("Berhasil update KYC!");
                    loadKyc();
                }).catch(err => {
                    alert("Gagal update KYC");
                });
            }

            searchInput.addEventListener("keyup", function() {
                currentSearch = this.value;
                currentPage = 1;
                loadKyc();
            });

            statusFilter.addEventListener("change", function() {
                currentStatus = this.value;
                currentPage = 1;
                loadKyc();
            });

            loadKyc();
        });
    </script>
@endpush
