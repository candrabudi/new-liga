@extends('secret.template.app')
@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <!-- Form Tambah/Edit (Kiri) -->
    <div class="col-lg-6">
        <div class="card radius-10">
            <div class="card-body p-4">
                <h5 class="card-title">{{ $promotion->id ?? '' ? 'Edit Promotion' : 'Tambah Promotion' }}</h5>
                <hr>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ $promotion->id ?? '' ? route('secret.promotions.update', $promotion->id) : route('secret.promotions.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($promotion->id ?? false)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="is_lifetime" id="is_lifetime_hidden"
                        value="{{ $promotion->is_lifetime ?? 0 }}">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $promotion->title ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div id="editor" style="height:150px;">{!! $promotion->description ?? '' !!}</div>
                        <textarea name="description" id="description-hidden" style="display:none;">{!! $promotion->description ?? '' !!}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="thumb" class="form-control">
                        @if ($promotion->thumb ?? false)
                            <img src="{{ asset('storage/' . $promotion->thumb) }}" class="mt-2" width="100">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ ($promotion->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ ($promotion->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3 lifetime-dates" style="{{ $promotion->is_lifetime ?? 0 ? 'display:none;' : '' }}">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control"
                            value="{{ $promotion->start_date ?? '' }}">
                    </div>

                    <div class="mb-3 lifetime-dates" style="{{ $promotion->is_lifetime ?? 0 ? 'display:none;' : '' }}">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control"
                            value="{{ $promotion->end_date ?? '' }}">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="is_lifetime"
                            {{ $promotion->is_lifetime ?? 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_lifetime">Lifetime</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Quill Editor
    var quill = new Quill('#editor', { theme: 'snow' });

    // Lifetime toggle
    const lifetimeCheckbox = document.getElementById('is_lifetime');
    const hiddenLifetime = document.getElementById('is_lifetime_hidden');
    const dateFields = document.querySelectorAll('.lifetime-dates');

    lifetimeCheckbox.addEventListener('change', function() {
        hiddenLifetime.value = this.checked ? 1 : 0;
        dateFields.forEach(el => el.style.display = this.checked ? 'none' : 'block');
    });

    // Submit form: sinkronisasi Quill ke textarea
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        document.getElementById('description-hidden').value = quill.root.innerHTML;
    });
</script>
@endpush
