@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
    <section class="products-list container py-5">
        <div class="row mt-2 g-4">
            <div class="d-flex justify-content-center mt-3">
                <h5 class="text">{{$category->title}}</h5>
            </div>
        </div>
        <div class="px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
                @foreach ($products as $product)
                @auth('web')
                    @if (App\Models\Favorite::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first())
                        @include('web.products.parts.card', ['product' => $product, 'favorite' => true])
                    @else
                        @include('web.products.parts.card', ['product' => $product, 'favorite' => false])
                    @endif
                @endauth
                    @include('web.products.parts.card', ['product' => $product, 'favorite' => false])
                @endforeach

            </div>
        </div>
        @if ($products->count() > 6)
            <div class="posts-paginator d-flex justify-content-center py-5">
                {{ $products->onEachSide(1)->withQueryString()->links() }}
            </div>
        @endif
    </section>
@endsection
