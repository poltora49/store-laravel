<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        @if ($product->thumbnail)
            <img class="card-img-top" src="/storage/product/{{ $product->thumbnail }}" alt="product">
        @else
            <img class="card-img-top" src="img/without.jpg" alt="product">
        @endif



        <!-- Product details-->
        <a class="card-body p-4 link-offset-3-hover"  href="{{ route("product.show", $product->id) }}">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{{ $product->title }}</h5>
                <!-- Product price-->
                ${{ $product->price }}
            </div>
        </a>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div>
    </div>
</div>
