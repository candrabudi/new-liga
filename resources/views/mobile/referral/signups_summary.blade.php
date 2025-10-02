@extends('mobile.template.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <style>
        #alert_box {
            display: none;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-weight: bold;
        }

        #alert_box.success {
            background-color: #d4edda;
            color: #155724;
        }

        #alert_box.error {
            background-color: #f8d7da;
            color: #721c24;
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

                    <form action="{{ route('referral.signups.summary') }}">
                        @csrf
                        <div class="reporting-control-group">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" class="form-control" id="starting_date" name="StartingDate"
                                    value="{{ $startDate ?? now()->startOfMonth()->format('Y-m-d') }}">

                                <label class="mt-2">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="ending_date" name="EndingDate"
                                    value="{{ $endDate ?? now()->endOfMonth()->format('Y-m-d') }}">
                            </div>

                            <div class="standard-button-group mt-3">
                                <button type="submit" class="btn btn-primary standard-secondary-button">
                                    Cari
                                </button>
                            </div>
                        </div>

                        <div class="reporting-scroll-container mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Nomor Telepon</th>
                                        <th>Total Deposit</th>
                                        <th>Join</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $member)
                                        <tr>
                                            <td>{{ $member['name'] }}</td>
                                            <td>{{ $member['phone'] }}</td>
                                            <td>{{ $member['deposits'] ?? 0 }}</td>
                                            <td>{{ $member['joined_at'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                Belum ada referral yang join pada periode ini.
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
