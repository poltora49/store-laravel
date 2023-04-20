@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection
@section('content')
        <main class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-6 col-xxl-7">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Sales this year</h5>
                            </div>
                            <div class="card-body py-3">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-dashboard-line"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-xxl-5 d-flex">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Number of user profiles</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                                            <i class="ion ion-ios-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="display-5 mt-1 mb-3">{{count($users)}}</h1>
                                            {{-- <div class="mb-0">
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
                                                Less sales than usual
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Total Earnings</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="display-5 mt-1 mb-3">{{\App\Models\Transaction::total_earning()}}$</h1>
                                            {{-- <div class="mb-0">
                                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
                                                More earnings than usual
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title">Pending Orders today</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <div class="avatar-title rounded-circle bg-primary-dark">
                                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h1 class="display-5 mt-1 mb-3">{{\App\Models\Transaction::today_count()}}</h1>
                                            {{-- <div class="mb-0">
                                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
                                                Less orders than usual
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Last transactions</h5>
                            </div>
                            <table id="datatables-dashboard-projects" class="table table-striped my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Time</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->id}}</td>
                                        <td>{{$transaction->created_at}}</td>
                                        <td>{{App\Models\User::findOrFail($transaction->user_id)->name}}</td>
                                        <td>{{$transaction->status}}</td>
                                        <td>{{$transaction->total_price/100}}$</td>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </main>

@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "paid",
                        fill: true,
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        borderWidth: 2,
                        data: [
                                @foreach ($months_paids as $month)
                                    {{$month}},
                                @endforeach

                            ]
                    },
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 5
                        },
                        display: true,
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });
</script>

<script>
    $(function() {
        $('#datatables-dashboard-projects').DataTable({
            pageLength: 6,
            lengthChange: false,
            bFilter: false,
            order:[1,'desk']
        });
    });
</script>

@endpush
