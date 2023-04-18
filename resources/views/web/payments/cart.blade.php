@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')

    <div class="h-100 h-custom py-2">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0 row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                    @if (count($carts))
                                    <a href='{{ route('cart.clearCart') }}'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="grey" class="bi bi-trash3-fill text-end" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                                @foreach ($carts as $cart)
                                    @auth('web')
                                        @if (App\Models\Favorite::where(['user_id' => auth()->user()->id, 'product_id' => $cart->product_id])->first())
                                            @include('web.payments.parts.card-cart', ['cart' => $cart, 'favorite' => true])
                                        @else
                                            @include('web.payments.parts.card-cart', ['cart' => $cart, 'favorite' => false])
                                        @endif
                                    @endauth
                                    @guest
                                        @include('web.payments.parts.card-cart', ['cart' => $cart, 'favorite' => false])
                                    @endguest
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
                            <div class="p-5" id='summary'>
                                @if (count($carts))
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                <hr class="my-4">
                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Total price</h5>
                                    <h5>€ <span id="totalPrice">{{\App\Models\Cart::total()}}<span></h5>
                                </div>
                                <form method="POST" action="{{route('stripe')}}">
                                @csrf
                                @method('POST')
                                <button type="submit"  id="checkout-button" class="btn btn-dark btn-block btn-lg"
                                    data-mdb-ripple-color="dark">Pay</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
