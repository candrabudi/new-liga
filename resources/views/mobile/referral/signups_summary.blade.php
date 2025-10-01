@extends('mobile.template.app')

@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('Content/mobile/referral.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" 
        integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" 
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #alert_box {
            display: none;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-weight: bold;
        }
        #alert_box.success { background-color: #d4edda; color: #155724; }
        #alert_box.error { background-color: #f8d7da; color: #721c24; }
    </style>
@endpush

@section('content')
    @include('mobile.referral.components.tab')

    <div class="standard-form-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <form action="/mobile/referral/signups-summary" method="post">
                        @csrf
                        <div class="reporting-control-group">
                            <div class="form-group">
                                <label>Rentang Tanggal</label>
                                <input type="text" 
                                    class="form-control" 
                                    id="date_range_picker" 
                                    data-picker="date-range" 
                                    data-separator=" — ">

                                <input type="hidden" name="StartingDate" id="starting_date" value="{{ now()->startOfMonth()->format('d-M-Y') }}">
                                <input type="hidden" name="EndingDate" id="ending_date" value="{{ now()->endOfMonth()->format('d-M-Y') }}">
                            </div>
                            <div class="standard-button-group">
                                <button type="submit" class="standard-secondary-button">
                                    Cari
                                </button>
                            </div>
                        </div>

                        <div class="reporting-scroll-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Turnover</th>
                                        <th>Winloss</th>
                                        <th>Jumlah Taruhan</th>
                                        <th>Hitungan Deposit</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Join WIB</th>
                                        <th>Tanggal Login Terakhir WIB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- data dinamis disini --}}
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            // Default range
            let start = moment().startOf('month');
            let end = moment().endOf('month');

            function updateInputs(start, end) {
                $('#date_range_picker').val(start.format('DD-MMM-YYYY') + ' — ' + end.format('DD-MMM-YYYY'));
                $('#starting_date').val(start.format('DD-MMM-YYYY'));
                $('#ending_date').val(end.format('DD-MMM-YYYY'));
            }

            // Init daterangepicker
            $('#date_range_picker').daterangepicker({
                startDate: start,
                endDate: end,
                locale: { format: 'DD-MMM-YYYY' },
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, updateInputs);

            // Set default value on load
            updateInputs(start, end);
        });
    </script>
@endpush
