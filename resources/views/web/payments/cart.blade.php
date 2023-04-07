@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
    <div class="container h-100 h-custom py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0 row g-0">

                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                </div>
                                <hr class="my-4">
                                @foreach ($carts as $cart)
                                    @include('web.payments.parts.card-cart', ['cart' => $cart])
                                @endforeach

                                <div class="pt-5">
                                    <h6 class="mb-0">
                                        <a href="{{ route('product.all') }}" class="text-body">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                              </svg>
                                            Back to shop
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Total price</h5>
                                    <h5>€ {{\App\Models\Cart::total()}}</h5>
                                </div>

                                <button type="button" class="btn btn-dark btn-block btn-lg"
                                    data-mdb-ripple-color="dark">Pay</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
