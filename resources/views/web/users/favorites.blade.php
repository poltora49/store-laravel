@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
<section class="products-list container py-5">
    <div class="d-flex justify-content-center mt-3">
        <h5 class="text">Favorites</h5>
        @if (count($favorites))
            <a class='ms-3' href='{{ route('favorite.clear') }}'>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="grey" class="bi bi-trash3-fill text-end" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
            </a>
        @endif
    </div>
    <div class="px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
            @foreach ($favorites as $favorite)
                @php
                    $product = \App\Models\Product::findOrFail($favorite->product_id);
                @endphp
                @if (!$product->hidden)
                    @include('web.products.parts.card', ['product' => $product, 'favorite' => true])
                @endif
            @endforeach

        </div>
    </div>
    @if (!Route::is('home'))
        <div class="posts-paginator d-flex justify-content-center py-5">
            {{ $favorites->onEachSide(1)->withQueryString()->links() }}
        </div>
    @endif
</section>
@endsection
