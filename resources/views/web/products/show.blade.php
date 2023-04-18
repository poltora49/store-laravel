@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
@include('notification.notification')

<section class="py-3 mb-5">

    <div class="card mb-3 mx-auto"style=" max-width:800px">
        @if ($product->thumbnail)
            <img class="img-fluid rounded-start" src="/storage/product/{{ $product->thumbnail }}" alt="product">
        @else
            <img class="img-fluid rounded-start" src="../img/without.jpg" alt="product">
        @endif
        <div class="col-md-8 w-100">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $product->title }}</h5>
                <h5 class="card-price text-center">${{$product->price}}</h5>
                <div class="card-buttons d-flex col justify-content-end p-4 pt-0 border-top-0 bg-transparent">
                    @auth('web')
                    @if ($favorite)
                        <a href="#" class=" example link-underline link-underline-opacity-0 text-muted favorite_change "
                        id ='favorite_change{{$product->id}}' data-id="{{$product->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" id="heart{{$product->id}}" width="16" height="16" fill="red"
                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </a>
                    @else
                            <a href="#"
                            class="example link-underline link-underline-opacity-0 text-muted favorite_change add-to-favorite"
                                id ='favorite_change{{$product->id}}' data-id="{{$product->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" id="heart{{$product->id}}" width="16" height="16" fill="grey"
                                    class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                </svg>
                            </a>
                    @endif

                    @endauth
                    <a class="btn btn-outline-dark mt-auto add-to-cart mx-2" data-id='{{$product->id}}'
                        href="#">Add to cart</a>

                </div>
                <p class="card-text ">{{ $product->description }}</p>
                </div>
            </div>
        </div>

      </div>
</section>
@endsection
