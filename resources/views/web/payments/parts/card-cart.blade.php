@php
    $product = \App\Models\Product::findOrFail($cart->product_id);
@endphp
<div id = 'card{{$cart->product_id}}'>
<hr class="my-4">

<div class="row mb-4 d-flex justify-content-between align-items-center ">
    <a href='{{ route('web.product.show', $cart->product_id) }}' class="col-md-2 col-lg-2 col-xl-2">
        @if($product->thumbnail)
        <img src="storage/product/{{$product->thumbnail}}"
            class="img-fluid rounded-3" alt="Cotton T-shirt">
        @else
        <img src="img/without.jpg"
            class="img-fluid rounded-3" alt="Cotton T-shirt">
        @endif
    </a>
    <div class="col-md-3 col-lg-3 col-xl-3">
        <h6 class="text-muted">Shirt</h6>
        <h6 class="text-black mb-0">{{$product->title}}</h6>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-2 d-flex text-center">
        <a class="btn-link px-2 remove-from-cart" data-id="{{$cart->product_id}}" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey"
                class="bi bi-dash-square-fill" viewBox="0 0 16 16">
                <path
                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm2.5 7.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1z" />
            </svg>
        </a>

        <p id="quantity{{$cart->product_id}}" >{{$cart->quantity}}</p>

        <a class="btn-link px-2 add-to-cart" href="#" data-id="{{$cart->product_id}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey"
                class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path
                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
            </svg>
        </a>
    </div>
    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
        <h6 class="mb-0" >€ <span id="price{{$cart->product_id}}">{{$cart->price}}</span></h6>
    </div>
    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
        @auth('web')
        @if ($favorite)
            <a href="#" class=" example link-underline link-underline-opacity-0 text-muted favorite_change "
            id ='favorite_change{{$cart->product_id}}' data-id="{{$cart->product_id}}">
                <svg xmlns="http://www.w3.org/2000/svg" id="heart{{$cart->product_id}}" width="16" height="16" fill="red"
                    class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                </svg>
            </a>
        @else
            <a href="#" class=" example link-underline link-underline-opacity-0 text-muted favorite_change add-to-favorite"
            id ='favorite_change{{$cart->product_id}}' data-id="{{$cart->product_id}}">
                <svg xmlns="http://www.w3.org/2000/svg" id="heart{{$cart->product_id}}" width="16" height="16" fill="grey"
                    class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                </svg>
            </a>
        @endif
        @endauth

        <a href="#" class="text-muted delete-from-cart" data-id="{{$cart->id}}" data-id_product="{{$cart->product_id}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="grey" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
            </svg>
        </a>
    </div>
</div>
</div>
