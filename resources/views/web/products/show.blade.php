@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
<section class="container py-5">

    <div class="card mb-3 mx-auto"style=" max-width:800px">
        <img src="/storage/product/{{ $product->thumbnail }}" class="img-fluid rounded-start" alt="...">
        <div class="col-md-8 w-100">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $product->title }}</h5>
                <h5 class="card-text text-center">${{$product->price}}</h5>
                <div class="card-price p-4 pt-0 border-top-0 bg-transparent text-end">
                    @auth('web')
                    @if ($favorite)
                        <a href="#" class=" example link-underline link-underline-opacity-0 text-muted"
                        id="favorite_change" data-id="{{$product->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" id="heart" width="16" height="16" fill="red"
                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </a>
                    @else
                        <a href="#" class=" example link-underline link-underline-opacity-0 text-muted add-to-favorite"
                            id="favorite_change" data-id="{{$product->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" id="heart" width="16" height="16" fill="grey"
                                    class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                </svg>
                            </a>
                    @endif

                    @endauth
                    <div class="text-right"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
                <p class="card-text">{{ $product->description }}</p>
            </div>
        </div>

      </div>
</section>
@endsection
