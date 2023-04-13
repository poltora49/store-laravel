@extends('layouts.admin')
@section('content')
<main class="main h-100 w-100">
   <div class="container mt-3 h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <div class="text-center">
                                    <h1 class="h2">Admin</h1>
                                </div>
                                <form method="POST" id="admin-email-form" action="{{ route('admin.auth.loginAdmin') }}">
                                    @csrf
                                    <div class="mb-3 error-placeholder">

                                        <label>Email</label>
                                        <input class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        type="email" name="email" placeholder="Enter your email" />
                                        @error('email')
                                            <p class="text-warning">
                                            {{ $message }}
                                            </p>
                                        @enderror

                                    </div>
                                    <div class="mb-3 error-placeholder">

                                        <label>Password</label>
                                        <input class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        type="password" name="password" placeholder="Enter your password" autocomplete="off"/>

                                        @error('password')
                                            <p class="text-warning">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </p>
                                        @enderror

                                    </span>
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me"
                                            {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-small" for="customControlInline">
                                                {{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit"  href="dashboard-default.html" class="btn btn-lg btn-primary">Sign in</button>
                                        {{-- <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> --> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
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
            $("#admin-email-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "password": {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                "email": {
                    required:true,
                    email: true
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
