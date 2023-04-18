@extends('layouts.web')

@section('header')
    @include('layouts.parts.header-web')
@endsection

@section('content')
@include('notification.notification')

<div class=" p-4 ">
        <div class="row">
            <form enctype="multipart/form-data" method="POST" action="{{route('profile_edit')}}">
                @method('PUT')
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
                                src="/storage/user/{{ auth()->user()->thumbnail }}" alt="Avatar">
                            </div>
                            @else
                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('img/profile-icon.png') }}" alt="default avatar">
                            @endif
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 9mb</div>
                            <!-- Profile picture upload button-->
                            <input type="file" class="form-control" onchange="return fileValidation()" name="thumbnail" id="thumbnail">

                            @error('thumbnail')
                            <p class="text-danger">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="card-body">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Name</label>
                                    <input class="form-control" required name="name" type="text" minlength="3"

                                    placeholder="Enter your username"
                                    value='{{auth()->user()->name}}'>

                                    @error('name')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form enctype="multipart/form-data" method="POST" action="{{route('change_email')}}">
                @method('PUT')
                @csrf
                <div class="col my-4">
                    <!-- Profile picture card-->
                    <div class="card mb-xl-0">
                        <div class="card-header">Change email</div>
                        <div class="card-body">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Email address</label>
                                    <label class="small mb-1">{{auth()->user()->email}}</label>
                                    <input class="form-control" name="email" required type="email"
                                    placeholder="Enter your email address">
                                    @error('email')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <!-- Form Row-->
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form enctype="multipart/form-data" method="POST" action="{{route('change_password')}}">
                @method('PUT')
                @csrf
                <div class="col my-4">
                    <div class="card mb-4">
                        <div class="card-header">Change password</div>
                        <div class="card-body">
                                    <!-- Form Group (Current password)-->
                                <div class="mb-3">
                                    <label class="small mb-1">Current password</label>
                                    <input class="form-control" required name="password" minlength="6"
                                    type="password" placeholder="Enter your password" autocomplete="off">
                                    @error('password')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (New password)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1">New password</label>
                                        <input class="form-control" required name="new_password" minlength="6" type="password"
                                        placeholder="Enter your new password" autocomplete="off">
                                        @error('new_password')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                    <!-- Form Group (Confirm new password)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1">Confirm new password</label>
                                        <input class="form-control" name="new_password_confirmation" minlength="6"
                                        type="password" placeholder="Enter your new password" required autocomplete="off">
                                        @error('new_password_confirmation')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
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
@push('scripts')
<script>
    function fileValidation(){
    var fileInput = document.getElementById('thumbnail');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }
}
</script>
@endpush
