@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
    <section class="category col container py-5">
        <div class="row mt-2 g-4">
            <div class="d-flex justify-content-center mt-3">
                <h5 class="text">Categories</h5>
            </div>
            @foreach ($categories as $category)
                <a class=" link-underline link-underline-opacity-0 col-md-3 " style="min-width: 300px;"
                href="{{route("product.category", $category->id)}}">
                    <div class="card p-1">
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="flex-column lh-1 imagename"> <span>{{ $category->title }}</span></div>
                            <div> <img src="/storage/category/{{ $category->thumbnail }}" height="100" width="100" />
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="products-list container py-5">
        <div class="px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
                @foreach ($products as $product)
                    @include('web.products.parts.card', ['product' => $product])
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
