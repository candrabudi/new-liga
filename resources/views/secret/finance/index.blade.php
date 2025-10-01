@extends('secret.template.app')

@push('styles')
    {{-- Boxicons CDN --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')
    {{-- Card Pengaturan Keuangan --}}
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class='bx bx-cog me-1'></i> Pengaturan Keuangan</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success"><i class='bx bx-check-circle'></i> {{ session('success') }}</div>
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
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="max_deposit" class="form-label">Maximum Deposit (0 = no limit)</label>
                        <input type="number" step="0.01" name="max_deposit" id="max_deposit"
                            value="{{ old('max_deposit', $setting->max_deposit ?? 0) }}"
                            class="form-control @error('max_deposit') is-invalid @enderror">
                        @error('max_deposit')
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
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
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="max_withdraw" class="form-label">Maximum Withdraw (0 = no limit)</label>
                        <input type="number" step="0.01" name="max_withdraw" id="max_withdraw"
                            value="{{ old('max_withdraw', $setting->max_withdraw ?? 0) }}"
                            class="form-control @error('max_withdraw') is-invalid @enderror">
                        @error('max_withdraw')
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class='bx bx-save'></i> Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- Card Pengaturan Komisi Referral --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class='bx bx-gift me-1'></i> Pengaturan Komisi Referral</h5>
        </div>
        <div class="card-body">
            @if (session('success_referral'))
                <div class="alert alert-success"><i class='bx bx-check-circle'></i> {{ session('success_referral') }}</div>
            @endif

            <form action="{{ route('secret.finance.update.referral.setting') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="percentage" class="form-label">Persentase Komisi (%)</label>
                        <input type="number" step="0.01" name="percentage" id="percentage"
                            value="{{ old('percentage', $referralSetting->percentage ?? 0) }}"
                            class="form-control @error('percentage') is-invalid @enderror">
                        @error('percentage')
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="min_deposit" class="form-label">Minimal Deposit untuk Referral</label>
                        <input type="number" step="0.01" name="min_deposit" id="min_deposit"
                            value="{{ old('min_deposit', $referralSetting->min_deposit ?? 0) }}"
                            class="form-control @error('min_deposit') is-invalid @enderror">
                        @error('min_deposit')
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="max_commission" class="form-label">Maksimal Komisi (0 = no limit)</label>
                        <input type="number" step="0.01" name="max_commission" id="max_commission"
                            value="{{ old('max_commission', $referralSetting->max_commission ?? 0) }}"
                            class="form-control @error('max_commission') is-invalid @enderror">
                        @error('max_commission')
                            <small class="text-danger"><i class='bx bx-error-circle'></i> {{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                        {{ old('is_active', $referralSetting->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        <i class='bx bx-power-off'></i> Aktifkan Komisi Referral
                    </label>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class='bx bx-save'></i> Simpan Komisi
                </button>
            </form>
        </div>
    </div>
@endsection
