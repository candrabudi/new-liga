@extends('secret.template.app')

@section('content')
    <div class="row">
        <!-- Table List -->
        <div class="col-md-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <input type="text" id="search" class="form-control w-50" placeholder="Cari Promotion">
                        <a href="{{ route('secret.promotions.create') }}" class="btn btn-primary">Tambah Promotion</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Thumb</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="promotion-table-body">
                                <tr>
                                    <td colspan="7" class="text-center">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="promotion-pagination" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tbody = document.getElementById("promotion-table-body");
            const paginationContainer = document.getElementById("promotion-pagination");
            const searchInput = document.getElementById("search");
            let currentPage = 1;
            let currentSearch = "";

            function renderPromotions(data) {
                tbody.innerHTML = "";
                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data</td></tr>`;
                    return;
                }
                data.forEach(p => {
                    tbody.innerHTML += `
            <tr>
                <td>#${p.id}</td>
                <td>
                    ${p.thumb ? `<img src="/storage/${p.thumb}" width="60" class="rounded">` : '-'}
                </td>
                <td>${p.title}</td>
                <td><span class="badge ${p.status==='active'?'bg-success':'bg-danger'}">${p.status}</span></td>
                <td>${p.start_date ?? '-'}</td>
                <td>${p.end_date ?? (p.is_lifetime ? 'Lifetime' : '-')}</td>
                <td>
                    <a href="/secret/promotions/${p.id}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/secret/promotions/${p.id}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus promotion ini?')">Hapus</button>
                    </form>
                </td>
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
                for (let i = start; i <= end; i++) {
                    html +=
                        `<li class="page-item ${i===meta.current_page?'active':''}"><a class="page-link" data-page="${i}">${i}</a></li>`;
                }
                html +=
                    `<li class="page-item ${meta.current_page===meta.last_page?'disabled':''}"><a class="page-link" data-page="${meta.current_page+1}">Next</a></li>`;
                html += `</ul></nav>`;
                paginationContainer.innerHTML = html;
            }

            function loadPromotions(page = 1) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center">Loading...</td></tr>`;
                axios.get(`/secret/promotions/list`, {
                        params: {
                            page,
                            search: currentSearch
                        }
                    })
                    .then(res => {
                        renderPromotions(res.data.data);
                        renderPagination(res.data);
                    })
                    .catch(() => {
                        tbody.innerHTML =
                            `<tr><td colspan="7" class="text-danger text-center">Gagal memuat data</td></tr>`;
                    });
            }

            paginationContainer.addEventListener("click", function(e) {
                if (e.target.tagName === "A" && e.target.dataset.page) {
                    currentPage = parseInt(e.target.dataset.page);
                    loadPromotions(currentPage);
                }
            });

            searchInput.addEventListener("keyup", function(e) {
                currentSearch = e.target.value;
                currentPage = 1;
                loadPromotions(currentPage);
            });

            loadPromotions();
        });
    </script>
@endpush
