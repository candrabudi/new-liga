@extends('secret.template.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <input type="text" id="search" class="form-control ps-5 radius-30" placeholder="Cari Deposit">
                    <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Channel</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Bukti</th>
                            <th>Date</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="deposit-table-body">
                        <tr>
                            <td colspan="8" class="text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="mt-3"></div>
        </div>
    </div>

    <!-- Modal Konfirmasi Setujui -->
    <div class="modal fade" id="modalApprove" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin <b>menyetujui</b> deposit ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="btnConfirmApprove">Setujui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div class="modal fade" id="modalReject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Tolak Deposit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="rejectReason" class="form-label">Alasan Penolakan</label>
                    <textarea id="rejectReason" class="form-control" rows="3" placeholder="Tuliskan alasan..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmReject">Tolak</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tbody = document.getElementById("deposit-table-body");
            const paginationContainer = document.getElementById("pagination-container");
            const searchInput = document.getElementById("search");

            let currentPage = 1;
            let currentSearch = "";
            let selectedId = null;

            // Render data deposit
            function renderDeposits(deposits) {
                tbody.innerHTML = "";

                if (deposits.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="8" class="text-center">Tidak ada deposit pending</td></tr>`;
                    return;
                }

                deposits.forEach(trx => {
                    tbody.innerHTML += `
                <tr>
                    <td>#${trx.id}</td>
                    <td>${trx.user?.full_name ?? '-'}</td>
                    <td>${trx.payment_channel?.name ?? '-'}</td>
                    <td>
                        <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                            <i class="bx bxs-circle me-1"></i>${trx.status}
                        </div>
                    </td>
                    <td>Rp ${Number(trx.amount).toLocaleString()}</td>
                    <td>
                        ${trx.proof 
                            ? `<a href="/storage/${trx.proof}" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>` 
                            : '-'}
                    </td>
                    <td>${new Date(trx.created_at).toLocaleDateString()}</td>
                    <td>
                        <div class="d-flex order-actions">
                            <button class="btn btn-sm btn-success me-2 btn-approve" data-id="${trx.id}">
                                <i class="bx bx-check"></i> Setujui
                            </button>
                            <button class="btn btn-sm btn-danger btn-reject" data-id="${trx.id}">
                                <i class="bx bx-x"></i> Tolak
                            </button>
                        </div>
                    </td>
                </tr>
            `;
                });
            }

            // Render pagination pendek
            function renderPagination(meta) {
                paginationContainer.innerHTML = "";
                if (meta.last_page <= 1) return;

                let html = `<nav><ul class="pagination pagination-sm justify-content-center">`;

                // Previous
                html += `<li class="page-item ${meta.current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:;" data-page="${meta.current_page - 1}">Previous</a>
                 </li>`;

                // Pages
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

                // Next
                html += `<li class="page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:;" data-page="${meta.current_page + 1}">Next</a>
                 </li>`;

                html += `</ul></nav>`;
                paginationContainer.innerHTML = html;
            }

            // Load data dari API
            function loadDeposits(page = 1, search = "") {
                tbody.innerHTML = `<tr><td colspan="8" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/deposits/pending/list?page=${page}&search=${search}`)
                    .then(res => {
                        renderDeposits(res.data.data);
                        renderPagination(res.data);
                    })
                    .catch(err => {
                        tbody.innerHTML =
                            `<tr><td colspan="8" class="text-danger text-center">Gagal memuat data</td></tr>`;
                    });
            }

            // Pagination click
            paginationContainer.addEventListener("click", function(e) {
                if (e.target.tagName === "A" && e.target.dataset.page) {
                    currentPage = parseInt(e.target.dataset.page);
                    loadDeposits(currentPage, currentSearch);
                }
            });

            // Search
            searchInput.addEventListener("keyup", function(e) {
                currentSearch = e.target.value;
                currentPage = 1;
                loadDeposits(currentPage, currentSearch);
            });

            // Event approve
            document.addEventListener("click", function(e) {
                if (e.target.closest(".btn-approve")) {
                    selectedId = e.target.closest(".btn-approve").getAttribute("data-id");
                    new bootstrap.Modal(document.getElementById("modalApprove")).show();
                }
            });

            // Event reject
            document.addEventListener("click", function(e) {
                if (e.target.closest(".btn-reject")) {
                    selectedId = e.target.closest(".btn-reject").getAttribute("data-id");
                    document.getElementById("rejectReason").value = "";
                    new bootstrap.Modal(document.getElementById("modalReject")).show();
                }
            });

            // Konfirmasi approve
            document.getElementById("btnConfirmApprove").addEventListener("click", function() {
                axios.post(`/secret/deposits/${selectedId}/approve`)
                    .then(res => {
                        bootstrap.Modal.getInstance(document.getElementById("modalApprove")).hide();
                        loadDeposits(currentPage, currentSearch);
                    })
                    .catch(err => {
                        alert("Gagal menyetujui deposit!");
                    });
            });

            // Konfirmasi reject
            document.getElementById("btnConfirmReject").addEventListener("click", function() {
                const reason = document.getElementById("rejectReason").value.trim();
                if (!reason) {
                    alert("Alasan penolakan wajib diisi!");
                    return;
                }

                axios.post(`/secret/deposits/${selectedId}/reject`, {
                        reason
                    })
                    .then(res => {
                        bootstrap.Modal.getInstance(document.getElementById("modalReject")).hide();
                        loadDeposits(currentPage, currentSearch);
                    })
                    .catch(err => {
                        alert("Gagal menolak deposit!");
                    });
            });

            // Load pertama kali
            loadDeposits();
        });
    </script>
@endpush
