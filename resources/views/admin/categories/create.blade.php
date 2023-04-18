@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                @if (isset($category))Edit {{$category->title}}@else Create @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Category</a></li>
                    @if (isset($category))
                    <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
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
                        <h5 class="card-title mb-0">Category</h5>
                    </div>
                    <div class="card-body">
                        @include('admin.notification.notification')
                        <form id="product-form"
                        action="
                        @if(isset($category)){{ route('category.update', $category->id) }}
                        @else{{ route('category.store') }}@endif"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @else
                            @method("POST")
                        @endif
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title"
                                value="{{ $category->title ?? '' }}">
                                @error('title')
                                    <p class="text-warning"> {{ $message }}</p>
                                @enderror
                            </div>
                            @if (isset($category))
                                @if ($category->thumbnail)
                                    <div class="">
                                        <img class="rounded me-2 mb-2" src="/storage/category/{{$category->thumbnail}}" alt="Placeholder" width="140" height="140">
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
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        @if (isset($category))

                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id"  value="{{ $category->id }}">
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
                "thumbnail": {
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
