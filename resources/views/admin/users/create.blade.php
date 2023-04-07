@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Validation
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard-default.html">User</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit user</h5>
                    </div>
                    <div class="card-body">
                        <form id="validation-form">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Avatar</label>
                                <div>
                                    <input type="file" class="validation-file" name="thumbnail">
                                </div>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email">
                                <small class="form-text d-block text-muted">Example block-level help text here.</small>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <small class="form-text d-block text-muted">Example block-level help text here.</small>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Confirm password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Block</label>
                                <br>
                                <label class="form-check d-block">
                                    <input type="checkbox" class="form-check-input" name="block">
                                    <span class="form-check-label">Block</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
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
        // Trigger validation on tagsinput change
        $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
            $(this).valid();
        });
        // Initialize validation
        $("#validation-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "email": {
                    required: true,
                    email: true
                },
                "password": {
                    required: false,
                    minlength: 6,
                    maxlength: 30
                },
                "password_confirmation": {
                    required: false,
                    minlength: 6,
                    equalTo: "input[name=\"validation-password\"]"
                },
                "name": {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                "thumbnail": {
                    required: false
                },
                "block": {
                    required: false
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
