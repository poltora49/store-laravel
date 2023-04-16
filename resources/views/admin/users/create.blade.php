@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Settings
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
            @include('admin.notification.notification')
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                            Account
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                            Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        onclick="event.preventDefault();if(confirm( 'Are you sure?')){
                            document.getElementById('block_user_{{ $user->id }}').submit();}">
                            @if($user->status)Block @else Unblock @endif
                        </a>

                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                        onclick="event.preventDefault();if(confirm( 'Are you sure?')){
                            document.getElementById('delete_user_{{ $user->id }}').submit();}">
                            Delete
                        </a>
                        <form id='block_user_{{ $user->id }}' action="{{ route('user.block', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id"  value="{{ $user->id }}">
                        </form>
                        <form id='delete_user_{{ $user->id }}' action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id"  value="{{ $user->id }}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Public info</h5>
                            </div>
                            <div class="card-body">
                                <form id='user-form' action="{{ route('user.update', $user->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3  error-placeholder">
                                                <label for="name">Username</label>
                                                <h4>{{$user->name}}</h4>
                                                <input type="text" class="form-control" name="name" placeholder="Name"
                                                value="{{$user->name}}">
                                                @error('name')
                                                <p class="text-warning"> {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                @if ($user->thumbnail)
                                                    <div class="">
                                                        <img class="rounded-circle img-responsive mt-2"
                                                        src="/storage/user{{$user->thumbnail}}" alt="Placeholder"
                                                        width="140" height="140">
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <img class="rounded-circle img-responsive mt-2"
                                                        src="../../../img/profile-icon.png" alt="Placeholder"
                                                        width="128" height="128">
                                                    </div>
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
                                                <small>JPG or PNG no larger than 9mb</small>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                        </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Public info</h5>
                                </div>
                                <div class="card-body">
                                    <form id='email-change-form' action="{{ route('user.change_email', $user->id) }}"
                                    method="POST">
                                    @csrf
                                        @method('PATCH')

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3 error-placeholder">
                                                    <label for="email">Email</label>
                                                    <h4>{{$user->email}}</h4>
                                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                                    @error('email')
                                                    <p class="text-warning"> {{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>

                                </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>
                                <h5 class="card-title">{{$user->password}}</h5>
                                <form id='user-form-password' action="{{ route('user.change_password', $user->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3  error-placeholder">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off">
                                        @error('password')
                                        <p class="text-warning"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3  error-placeholder">
                                        <label for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" name="new_password" autocomplete="off">
                                        @error('new_password')
                                            <p class="text-warning"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3  error-placeholder">
                                        <label for="inputPasswordNew2">Confirm password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation" autocomplete="off">
                                        @error('new_password_confirmation')
                                            <p class="text-warning"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        // Initialize validation
        $("#user-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "name": {
                    required: false,
                    minlength: 3,
                    maxlength: 50
                },
                "thumbnail": {
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
        $("#email-change-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
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
            $("#user-form-password").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "password": {
                    required: true,
                    minlength: 6,
                    maxlength: 30
                },
                "new_password": {
                    required: true,
                    minlength: 6,
                    maxlength: 30
                },
                "new_password_confirmation": {
                    required: true,
                    minlength: 6,
                    maxlength: 30,
                    equalTo: "input[name=\"new_password\"]"
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
