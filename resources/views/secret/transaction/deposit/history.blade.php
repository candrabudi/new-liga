@extends('secret.template.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <!-- Search -->
                <div class="position-relative me-2">
                    <input type="text" id="search" class="form-control ps-5 radius-30" placeholder="Cari Deposit">
                    <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                </div>

                <!-- Filter tanggal dengan Date Range Picker -->
                <div class="me-2">
                    <input type="text" id="dateRange" class="form-control radius-30" placeholder="Pilih Rentang Tanggal">
                </div>

                <!-- Filter status -->
                <div class="me-2">
                    <select id="statusFilter" class="form-select radius-30">
                        <option value="">Semua Status</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                        <option value="expired">Expired</option>
                    </select>
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
                        </tr>
                    </thead>
                    <tbody id="deposit-table-body">
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

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tbody = document.getElementById("deposit-table-body");
            const paginationContainer = document.getElementById("pagination-container");
            const searchInput = document.getElementById("search");
            const statusFilter = document.getElementById("statusFilter");
            const dateRangeInput = document.getElementById("dateRange");

            let currentPage = 1;
            let currentSearch = "";
            let currentStart = "";
            let currentEnd = "";
            let currentStatus = "";

            // Inisialisasi Date Range Picker
            $(dateRangeInput).daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    applyLabel: 'Terapkan',
                    format: 'YYYY-MM-DD'
                }
            });

            $(dateRangeInput).on('apply.daterangepicker', function(ev, picker) {
                currentStart = picker.startDate.format('YYYY-MM-DD');
                currentEnd = picker.endDate.format('YYYY-MM-DD');
                $(this).val(currentStart + ' - ' + currentEnd);
                currentPage = 1;
                loadDeposits(currentPage);
            });

            $(dateRangeInput).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                currentStart = "";
                currentEnd = "";
                currentPage = 1;
                loadDeposits(currentPage);
            });

            // Render data deposit
            function renderDeposits(deposits) {
                tbody.innerHTML = "";

                if (deposits.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data</td></tr>`;
                    return;
                }

                deposits.forEach(trx => {
                    tbody.innerHTML += `
                        <tr>
                            <td>#${trx.id}</td>
                            <td>${trx.user?.full_name ?? '-'}</td>
                            <td>${trx.payment_channel?.name ?? '-'}</td>
                            <td>
                                <div class="badge rounded-pill ${trx.status === 'approved' ? 'bg-success text-white' 
                                    : trx.status === 'rejected' ? 'bg-danger text-white' 
                                    : 'bg-secondary text-white'} p-2 text-uppercase px-3">
                                    <i class="bx bxs-circle me-1"></i>${trx.status}
                                </div>
                            </td>
                            <td>Rp ${Number(trx.amount).toLocaleString('id-ID')}</td>
                            <td>
                                ${trx.proof 
                                    ? `<a href="${trx.proof}" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>` 
                                    : '-'}
                            </td>
                            <td>${new Date(trx.created_at).toLocaleDateString('id-ID')}</td>
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
            function loadDeposits(page = 1) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/deposits/history/list`, {
                        params: {
                            page,
                            search: currentSearch,
                            start_date: currentStart,
                            end_date: currentEnd,
                            status: currentStatus
                        }
                    })
                    .then(res => {
                        renderDeposits(res.data.data);
                        renderPagination(res.data);
                    })
                    .catch(err => {
                        tbody.innerHTML =
                            `<tr><td colspan="7" class="text-danger text-center">Gagal memuat data</td></tr>`;
                    });
            }

            // Pagination click
            paginationContainer.addEventListener("click", function(e) {
                if (e.target.tagName === "A" && e.target.dataset.page) {
                    currentPage = parseInt(e.target.dataset.page);
                    loadDeposits(currentPage);
                }
            });

            // Search
            searchInput.addEventListener("keyup", function(e) {
                currentSearch = e.target.value;
                currentPage = 1;
                loadDeposits(currentPage);
            });

            // Filter status
            statusFilter.addEventListener("change", function() {
                currentStatus = this.value;
                currentPage = 1;
                loadDeposits(currentPage);
            });

            // Load pertama kali
            loadDeposits();
        });
    </script>
@endpush
