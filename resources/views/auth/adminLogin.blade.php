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
                                <form method="POST" action="{{ route('admin.auth.loginAdmin') }}">
                                    @csrf
                                    <div class="mb-3">

                                        <label>Email</label>
                                        <input class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        type="email" name="email" placeholder="Enter your email" />

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="mb-3">

                                        <label>Password</label>
                                        <input class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        type="password" name="password" placeholder="Enter your password" />

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        @endif

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
