@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
<div class="container-xl px-4 mt-4">

        <div class="row">
            <form enctype="multipart/form-data" method="POST" action="{{route('profile_edit')}}">
                @method('PATCH')
                @csrf
                <div class="col my-4">
                    <!-- Profile picture card-->
                    <div class="card mb-xl-0">
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            @if (auth()->user()->thumbnail)
                            <div class="rounded-circle mb-2 mx-auto" style="width: 150px;height: 150px;display: block;overflow: hidden">
                                <img class="img-account-profile " style="height: 150px;"
                                alt="Avatar"
                                src="/storage/{{ auth()->user()->thumbnail }}" alt="">
                            </div>
                            @else
                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('img/profile-icon.png') }}" alt="">
                            @endif
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 10mb</div>
                            <!-- Profile picture upload button-->
                            <input type="file" class="form-control" name="thumbnail" id="inputGroupFile01">

                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="card-body">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter your username"
                                    value="{{auth()->user()->name}}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Email address</label>
                                    <input class="form-control" name="email" type="email" placeholder="Enter your email address"
                                    value="{{auth()->user()->email}}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Row-->
                                <div class="mb-3">
                                    <label class="small mb-1">Password</label>
                                    <input class="form-control" name="password" type="text" placeholder="Enter your password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form enctype="multipart/form-data" method="POST" action="{{route('change_password')}}">
                @method('PATCH')
                @csrf
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">Change password</div>
                        <div class="card-body">
                                    <!-- Form Group (Current password)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Current password</label>
                                    <input class="form-control" name="password" type="text" placeholder="Enter your password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (New password)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1">New password</label>
                                        <input class="form-control" name="new_password" type="text" placeholder="Enter your new password">
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Form Group (Confirm new password)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1">Confirm new password</label>
                                        <input class="form-control" name="new_password_confirmation" type="text"placeholder="Enter your new password">
                                        @error('new_password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Change</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
