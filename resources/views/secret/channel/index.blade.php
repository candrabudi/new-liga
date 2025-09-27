@extends('secret.template.app')

@section('content')
<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Payment Channels</h5>
            <button id="addChannelBtn" class="btn btn-primary btn-sm">Tambah Channel</button>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" id="search" class="form-control" placeholder="Cari Payment Channel">
            </div>
            <div class="col-md-3">
                <select id="statusFilter" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Type</th>
                        <th>Slug</th>
                        <th>Code</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="channel-table-body">
                    <tr><td colspan="8" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
        </div>

        <div id="pagination-container" class="mt-3 d-flex justify-content-center"></div>
    </div>
</div>

<!-- Modal Add/Edit -->
<div class="modal fade" id="channelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="channelForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah / Edit Channel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="channelId">
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="bank">Bank</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="pulsa">Pulsa</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        <img id="logoPreview" src="" class="mt-2" width="50" style="display:none;">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const tbody = document.getElementById("channel-table-body");
    const paginationContainer = document.getElementById("pagination-container");
    const searchInput = document.getElementById("search");
    const statusFilter = document.getElementById("statusFilter");
    const channelModal = new bootstrap.Modal(document.getElementById("channelModal"));
    const channelForm = document.getElementById("channelForm");
    const logoInput = document.getElementById("logo");
    const logoPreview = document.getElementById("logoPreview");

    let currentPage = 1, currentSearch = "", currentStatus = "", editId = null;

    function renderChannels(channels){
        tbody.innerHTML = "";
        if(!channels.length){
            tbody.innerHTML = `<tr><td colspan="8" class="text-center">Tidak ada data</td></tr>`;
            return;
        }
        channels.forEach(ch=>{
            tbody.innerHTML += `
            <tr>
                <td>#${ch.id}</td>
                <td>${ch.name}</td>
                <td>${ch.type}</td>
                <td>${ch.slug || '-'}</td>
                <td>${ch.code || '-'}</td>
                <td>${ch.logo ? `<img src="/storage/${ch.logo}" width="50">` : '-'}</td>
                <td><span class="badge ${ch.is_active ? 'bg-success':'bg-danger'}">${ch.is_active?'Aktif':'Non-Aktif'}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn" data-id="${ch.id}">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${ch.id}">Hapus</button>
                </td>
            </tr>`;
        });
    }

    function renderPagination(meta){
        paginationContainer.innerHTML = "";
        if(meta.last_page <= 1) return;
        let html = `<ul class="pagination pagination-sm">`;
        html += `<li class="page-item ${meta.current_page===1?'disabled':''}">
                    <a class="page-link" href="javascript:;" data-page="${meta.current_page-1}">Prev</a>
                 </li>`;
        for(let i=1;i<=meta.last_page;i++){
            html += `<li class="page-item ${i===meta.current_page?'active':''}">
                        <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
                     </li>`;
        }
        html += `<li class="page-item ${meta.current_page===meta.last_page?'disabled':''}">
                    <a class="page-link" href="javascript:;" data-page="${meta.current_page+1}">Next</a>
                 </li></ul>`;
        paginationContainer.innerHTML = html;
    }

    function loadChannels(page=1){
        tbody.innerHTML = `<tr><td colspan="8" class="text-center">Loading...</td></tr>`;
        axios.get(`/secret/channels/list`,{params:{page, search:currentSearch, status:currentStatus}})
        .then(res=>{
            renderChannels(res.data.data);
            renderPagination(res.data);
        }).catch(()=>{
            tbody.innerHTML = `<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>`;
        });
    }

    paginationContainer.addEventListener("click", function(e){
        if(e.target.tagName==="A" && e.target.dataset.page){
            currentPage = parseInt(e.target.dataset.page);
            loadChannels(currentPage);
        }
    });

    searchInput.addEventListener("keyup", function(e){ currentSearch=e.target.value; currentPage=1; loadChannels(currentPage); });
    statusFilter.addEventListener("change", function(){ currentStatus=this.value; currentPage=1; loadChannels(currentPage); });

    tbody.addEventListener("click", function(e){
        if(e.target.classList.contains("delete-btn")){
            const id = e.target.dataset.id;
            if(confirm("Hapus payment channel ini?")){
                axios.delete(`/secret/channels/${id}`).then(()=>loadChannels(currentPage));
            }
        }
        if(e.target.classList.contains("edit-btn")){
            const id = e.target.dataset.id;
            axios.get(`/secret/channels/${id}`).then(res=>{
                const ch = res.data;
                editId = ch.id;
                channelForm.name.value = ch.name;
                channelForm.type.value = ch.type;
                channelForm.slug.value = ch.slug || '';
                channelForm.code.value = ch.code || '';
                channelForm.is_active.value = ch.is_active ? 1 : 0;
                logoPreview.src = ch.logo ? `/storage/${ch.logo}` : '';
                logoPreview.style.display = ch.logo ? 'block' : 'none';
                channelModal.show();
            });
        }
    });

    document.getElementById("addChannelBtn").addEventListener("click", function(){
        editId=null;
        channelForm.reset();
        logoPreview.src=''; logoPreview.style.display='none';
        channelModal.show();
    });

    logoInput.addEventListener("change", function(){
        if(this.files && this.files[0]){
            const reader=new FileReader();
            reader.onload=e=>{ logoPreview.src=e.target.result; logoPreview.style.display='block'; }
            reader.readAsDataURL(this.files[0]);
        }
    });

    channelForm.addEventListener("submit", function(e){
        e.preventDefault();
        const formData=new FormData(channelForm);
        let req;
        if(editId){
            formData.append('_method','PUT');
            req = axios.post(`/secret/channels/${editId}`,formData);
        } else {
            req = axios.post(`/secret/channels`,formData);
        }
        req.then(()=>{ channelModal.hide(); loadChannels(currentPage); });
    });

    loadChannels();
});
</script>
@endpush
