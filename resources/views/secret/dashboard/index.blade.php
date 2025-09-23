@extends('secret.template.app')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">

        <!-- Total Deposit -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Deposit</p>
                            <h4 class="my-1">${{ $totalDeposit }}</h4>
                            <p class="mb-0 font-13 text-success"><i class="bx bxs-up-arrow align-middle"></i>From last week</p>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-burning"><i class="bx bxs-wallet"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Withdraw -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Withdraw</p>
                            <h4 class="my-1">${{ $totalWithdraw }}</h4>
                            <p class="mb-0 font-13 text-danger"><i class="bx bxs-down-arrow align-middle"></i>From last week</p>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-voilet"><i class="bx bxs-down-arrow-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Member -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Member</p>
                            <h4 class="my-1">{{ $totalMember }}</h4>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-branding"><i class="bx bxs-group"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo Agent -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Saldo Agent</p>
                            <h4 class="my-1">${{ $saldoAgent }}</h4>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-kyoto"><i class="bx bxs-wallet-alt"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Deposit Pending -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Deposit Pending</p>
                            <h4 class="my-1">${{ $totalDepositPending }}</h4>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-info"><i class="bx bxs-time"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Withdraw Pending -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Withdraw Pending</p>
                            <h4 class="my-1">${{ $totalWithdrawPending }}</h4>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-warning"><i class="bx bxs-time-five"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estimasi Keuntungan -->
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Estimasi Keuntungan</p>
                            <h4 class="my-1">${{ $estimasiKeuntungan }}</h4>
                        </div>
                        <div class="widgets-icons rounded-circle text-white ms-auto bg-gradient-success"><i class="bx bxs-chart"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
