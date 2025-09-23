@extends('secret.template.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">⚙️ Pengaturan Keuangan</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('secret.finance.update') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="min_deposit" class="form-label">Minimum Deposit</label>
                        <input type="number" step="0.01" name="min_deposit" id="min_deposit"
                            value="{{ old('min_deposit', $setting->min_deposit ?? 0) }}"
                            class="form-control @error('min_deposit') is-invalid @enderror">
                        @error('min_deposit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="max_deposit" class="form-label">Maximum Deposit (0 = no limit)</label>
                        <input type="number" step="0.01" name="max_deposit" id="max_deposit"
                            value="{{ old('max_deposit', $setting->max_deposit ?? 0) }}"
                            class="form-control @error('max_deposit') is-invalid @enderror">
                        @error('max_deposit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="min_withdraw" class="form-label">Minimum Withdraw</label>
                        <input type="number" step="0.01" name="min_withdraw" id="min_withdraw"
                            value="{{ old('min_withdraw', $setting->min_withdraw ?? 0) }}"
                            class="form-control @error('min_withdraw') is-invalid @enderror">
                        @error('min_withdraw')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="max_withdraw" class="form-label">Maximum Withdraw (0 = no limit)</label>
                        <input type="number" step="0.01" name="max_withdraw" id="max_withdraw"
                            value="{{ old('max_withdraw', $setting->max_withdraw ?? 0) }}"
                            class="form-control @error('max_withdraw') is-invalid @enderror">
                        @error('max_withdraw')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">💾 Simpan</button>
            </form>
        </div>
    </div>
@endsection
