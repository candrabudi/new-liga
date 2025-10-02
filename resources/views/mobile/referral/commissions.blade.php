@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <style>
        .reporting-scroll-container {
            overflow-x: auto;
        }

        table th,
        table td {
            font-size: 14px;
            padding: 8px 10px;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    @include('mobile.referral.components.tab')

    <div class="standard-form-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <form action="{{ route('referral.referralCommissions') }}">
                        @csrf
                        <div class="reporting-control-group">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" class="form-control" name="StartingDate"
                                    value="{{ $startDate ?? now()->startOfMonth()->format('Y-m-d') }}">

                                <label class="mt-2">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="EndingDate"
                                    value="{{ $endDate ?? now()->endOfMonth()->format('Y-m-d') }}">
                            </div>

                            <div class="standard-button-group mt-3">
                                <button type="submit" class="btn btn-primary standard-secondary-button">Cari</button>
                            </div>
                        </div>

                        <div class="reporting-scroll-container mt-4">
                            <table class="table grid_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pengguna</th>
                                        <th>Nomor Telepon</th>
                                        <th>Total Deposit</th>
                                        <th>Komisi</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($commissions as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['phone'] }}</td>
                                            <td>{{ number_format($item['total_deposit']) }}</td>
                                            <td>{{ number_format($item['commission_amount']) }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Belum ada komisi referral untuk periode ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
