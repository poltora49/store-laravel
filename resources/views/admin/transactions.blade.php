@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Transactions
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Transactions</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                        </ol>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Clients</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-clients" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Time</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Session id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}</td>
                                            <td>{{$transaction->created_at}}</td>
                                            <td>{{App\Models\User::findOrFail($transaction->user_id)->name}}</td>
                                            <td>{{$transaction->status}}</td>
                                            <td>{{$transaction->total_price/100}}</td>
                                            <td>{{$transaction->session_id}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables clients
            $("#datatables-clients").DataTable({
                responsive: true,
                order: [
                    [1, "asc"]
                ]
            });
        });
    </script>
@endpush
