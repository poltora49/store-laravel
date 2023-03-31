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
                    <div class="text-right"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                </div>
                <p class="card-text">{{ $product->description }}</p>
            </div>
        </div>

      </div>
</section>
@endsection
