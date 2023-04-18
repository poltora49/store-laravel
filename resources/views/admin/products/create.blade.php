@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                @if (isset($product))Edit {{$product->title}}@else Create @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    @if (isset($product))
                    <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                    @else
                    <li class="breadcrumb-item"><a href="#">Create</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.notification.notification')
                        <form id="product-form"
                        action="
                        @if(isset($product)){{ route('product.update', $product->id) }}
                        @else{{ route('product.store') }}@endif"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @else
                            @method("POST")
                        @endif
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title"
                                value="{{ $product->title ?? '' }}">
                                @error('title')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Price"
                                value="{{ $product->price ?? '' }}">
                                @error('price')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Category</label>
                                <select class="form-control" name="category_id">

                                    @if(isset($product))
                                        <option value='{{$product->category_id}}'>{{$categories->find($product->category_id)->title}}</option>
                                    @foreach ($categories as $category)

                                            @if($category->id != $product->category_id)
                                                <option value="{{$category->id}}">{{$category->title ?? ''}}</option>
                                            @endif
                                    @endforeach

                                    @else
                                        <option value>Select category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title ?? ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category_id')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Descriptiom</label>
                                <textarea class="form-control" name="description">{{ $product->description ?? '' }}</textarea>
                                @error('description')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            @if (isset($product))
                                @if ($product->thumbnail)
                                    <div class="">
                                        <img class="rounded me-2 mb-2" src="/storage/product/{{$product->thumbnail}}" alt="Placeholder" width="140" height="140">
                                    </div>
                                @else
                                <div class="">
                                    <img class="rounded me-2 mb-2" src="../img/whithout.jpg" alt="Placeholder" width="140" height="140">
                                </div>
                                @endif
                            @endif
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Image</label>
                                <div>
                                    <input type="file" class="validation-file" name="thumbnail">
                                </div>
                                @error('thumbnail')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Hide</label>
                                <br>
                                <label class="form-check d-block">
                                    <input type="checkbox" class="form-check-input" name="hidden"
                                    @if(isset($product))
                                    {{{$product->hidden ? 'checked' : ''}}}
                                    @endif>
                                    <span class="form-check-label">Hide</span>
                                </label>
                                @error('hidden')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        @if (isset($product))

                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id"  value="{{ $product->id }}">
                            <button type="submit" class="btn btn-danger mt-3">
                                Delete
                            </button>
                        </form>

                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('script')
<svg width="0" height="0" style="position:absolute">
    <defs>
        <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
            <path
                d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
            </path>
        </symbol>
    </defs>
</svg>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
				$(this).valid();
			});
        // Initialize validation
        $("#product-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "title": {
                    required: true,
                    minlength: 3,
                    maxlength: 150,
                },
                "price": {
                    required: true,
                },
                "category_id": {
                    required: true,
                },
                "description": {
                    required: true,
                    minlength: 20,
                    maxlength: 500,
                },
                "thumbnail": {
                    required: false,
                },
                "hidden": {
                    required: false,
                },
            },
            // Errors
            errorPlacement: function errorPlacement(error, element) {
                var $parent = $(element).parents(".error-placeholder");
                // Do not duplicate errors
                if ($parent.find(".jquery-validation-error").length) {
                    return;
                }
                $parent.append(
                    error.addClass("jquery-validation-error small form-text invalid-feedback")
                );
            },
            highlight: function(element) {
                var $el = $(element);
                var $parent = $el.parents(".error-placeholder");
                $el.addClass("is-invalid");
                // Select2 and Tagsinput
                if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                    $el.parent().addClass("is-invalid");
                }
            },
            unhighlight: function(element) {
                $(element).parents(".error-placeholder").find(".is-invalid").removeClass("is-invalid");
            }
        });
    });
</script>
@endpush
