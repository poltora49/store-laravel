@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
@include('notification.notification')
    @if(!isset($category))
    <section class="category text-center col py-2">
        <div class="d-flex justify-content-center">
            <h5 class="text">Categories</h5>
        </div>
        <div class="row g-4 px-4 px-sm-5 mt-5 ">
            @foreach ($categories as $categoryLoop)
                <a class=" link-underline link-underline-opacity-0 col-md-3 " style="min-width: 300px;"
                href="{{route("product.category", $categoryLoop->id)}}">
                    <div class="card p-1">
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="flex-column lh-1 imagename"> <span>{{ $categoryLoop->title }}</span></div>
                            @if ($categoryLoop->thumbnail)
                                <div>
                                    <img src="/storage/category/{{ $categoryLoop->thumbnail }}" height="100" width="100" alt="category"/>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <section class="products-list py-5">
        @if (isset($category))
        <div class="row">
            <div class="d-flex justify-content-center">
                <h5 class="text">{{$category->title}}</h5>
            </div>
        </div>
        @endif
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
                    @guest
                        @include('web.products.parts.card', ['product' => $product, 'favorite' => false])
                    @endguest
                @endforeach

            </div>
        </div>
        @if (!Route::is('home'))
            <div class="posts-paginator d-flex justify-content-center py-5">
                {{ $products->onEachSide(1)->withQueryString()->links() }}
            </div>
        @endif
    </section>
@endsection

