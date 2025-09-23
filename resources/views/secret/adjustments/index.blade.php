@extends('secret.template.app')

@push('styles')
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
@endpush

@section('content')
    <div class="row">
        <!-- Form Adjustment -->
        <div class="col-md-4">
            <div class="card radius-10">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bx bx-wallet"></i> Adjustment Saldo</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="adjustment-form" action="{{ route('secret.adjustments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Member</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Pilih Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ old('user_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->user->full_name }} ({{ $member->user->username }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="trx_type" class="form-label">Tipe</label>
                            <select name="trx_type" id="trx_type" class="form-select" required>
                                <option value="credit" {{ old('trx_type') == 'credit' ? 'selected' : '' }}>Credit (+)
                                </option>
                                <option value="debit" {{ old('trx_type') == 'debit' ? 'selected' : '' }}>Debit (-)
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                                value="{{ old('amount') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Alasan</label>
                            <textarea name="reason" id="reason" class="form-control" rows="3">{{ old('reason') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100"><i class="bx bx-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Table List Adjustment -->
        <div class="col-md-8">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative me-2">
                            <input type="text" id="search" class="form-control ps-5 radius-30"
                                placeholder="Cari Member / Alasan">
                            <span class="position-absolute top-50 product-show translate-middle-y"><i
                                    class="bx bx-search"></i></span>
                        </div>
                        <div class="me-2">
                            <select id="trxFilter" class="form-select radius-30">
                                <option value="">Semua Tipe</option>
                                <option value="credit">Credit (+)</option>
                                <option value="debit">Debit (-)</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Member</th>
                                    <th>Tipe</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody id="trx-table-body">
                                <tr>
                                    <td colspan="7" class="text-center">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="trx-pagination" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#user_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });

            const tbody = document.getElementById("trx-table-body");
            const paginationContainer = document.getElementById("trx-pagination");
            const searchInput = document.getElementById("search");
            const trxFilter = document.getElementById("trxFilter");

            let currentPage = 1;
            let currentSearch = "";
            let currentTrxType = "";

            function renderTrx(data) {
                tbody.innerHTML = "";
                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data</td></tr>`;
                    return;
                }
                data.forEach(t => {
                    tbody.innerHTML += `
                    <tr>
                        <td>#${t.id}</td>
                        <td>${t.user?.full_name ?? '-'}</td>
                        <td><span class="badge ${t.trx_type==='credit'?'bg-success':'bg-danger'}">${t.trx_type==='credit'?'Credit (+)':'Debit (-)'}</span></td>
                        <td>Rp ${Number(t.amount).toLocaleString('id-ID')}</td>
                        <td>${t.reason ?? '-'}</td>
                        <td><span class="badge ${t.status==='approved'?'bg-primary':(t.status==='pending'?'bg-warning':'bg-danger')}">${t.status}</span></td>
                        <td>${new Date(t.created_at).toLocaleString('id-ID')}</td>
                    </tr>`;
                });
            }

            function renderPagination(meta) {
                paginationContainer.innerHTML = "";
                if (meta.last_page <= 1) return;
                let html = `<nav><ul class="pagination pagination-sm justify-content-center">`;
                html +=
                    `<li class="page-item ${meta.current_page===1?'disabled':''}"><a class="page-link" data-page="${meta.current_page-1}">Previous</a></li>`;
                let start = Math.max(1, meta.current_page - 1);
                let end = Math.min(meta.last_page, meta.current_page + 1);
                if (start > 1) {
                    html += `<li class="page-item"><a class="page-link" data-page="1">1</a></li>`;
                    if (start > 2) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                for (let i = start; i <= end; i++) {
                    html +=
                        `<li class="page-item ${i===meta.current_page?'active':''}"><a class="page-link" data-page="${i}">${i}</a></li>`;
                }
                if (end < meta.last_page) {
                    if (end < meta.last_page - 1) html +=
                        `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    html +=
                        `<li class="page-item"><a class="page-link" data-page="${meta.last_page}">${meta.last_page}</a></li>`;
                }
                html +=
                    `<li class="page-item ${meta.current_page===meta.last_page?'disabled':''}"><a class="page-link" data-page="${meta.current_page+1}">Next</a></li>`;
                html += `</ul></nav>`;
                paginationContainer.innerHTML = html;
            }

            function loadTrx(page = 1) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/adjustments/list`, {
                    params: {
                        page,
                        search: currentSearch,
                        trx_type: currentTrxType
                    }
                }).then(res => {
                    renderTrx(res.data.data);
                    renderPagination(res.data);
                }).catch(() => {
                    tbody.innerHTML =
                        `<tr><td colspan="7" class="text-danger text-center">Gagal memuat data</td></tr>`;
                });
            }

            paginationContainer.addEventListener("click", function(e) {
                if (e.target.tagName === 'A' && e.target.dataset.page) {
                    currentPage = parseInt(e.target.dataset.page);
                    loadTrx(currentPage);
                }
            });

            searchInput.addEventListener("keyup", function(e) {
                currentSearch = e.target.value;
                currentPage = 1;
                loadTrx(currentPage);
            });

            trxFilter.addEventListener("change", function() {
                currentTrxType = this.value;
                currentPage = 1;
                loadTrx(currentPage);
            });

            loadTrx();
        });
    </script>
@endpush
