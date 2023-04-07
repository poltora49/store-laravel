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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
