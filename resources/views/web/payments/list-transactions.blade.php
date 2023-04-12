@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
    <section class="wrapper rounded  py-5">
        <div class="d-flex justify-content-center mt-3">
            <h5 class="text">Transaction</h5>
        </div>
        <div class="table-responsive mt-3">
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
