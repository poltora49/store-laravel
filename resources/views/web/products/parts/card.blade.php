<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        @if ($product->thumbnail)
            <img class="card-img-top" src="/storage/product/{{ $product->thumbnail }}" alt="product">
        @else
            <img class="card-img-top" src="../img/without.jpg" alt="product">
        @endif



        <!-- Product details-->
        <a class="card-body p-4 link-offset-3-hover"  href="{{ route("web.product.show", $product->id) }}">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{{ $product->title }}</h5>
                <!-- Product price-->
                ${{ $product->price }}
            </div>
        </a>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
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
                <a href="#" class=" example link-underline link-underline-opacity-0 text-muted favorite_change add-to-favorite"
                id ='favorite_change{{$product->id}}' data-id="{{$product->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" id="heart{{$product->id}}" width="16" height="16" fill="grey"
                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                </a>
            @endif
            @endauth
            <div class="text-center"><a class="btn btn-outline-dark mt-auto add-to-cart" data-id='{{$product->id}}'
                href="#">Add to cart</a></div>

        </div>
    </div>
</div>
