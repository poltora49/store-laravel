@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
    <section class="wrapper rounded  py-2">
        <div class="d-flex justify-content-center">
            <h5 class="text">Transaction</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                            <td>Stripe</td>
                            <td>{{$transaction->created_at}}</td>
                            <td> {{$transaction->total_price/100}}$ </td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
