@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>

        <div class="card-body">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST"
                action="{{ route('login') }}"
                class="needs-validation"
                novalidate="">
                @csrf
                <div class="form-group @error('email') is-invalid  
                                                @enderror">
                    <label for="login">Username atau Email</label>
                    <input id="login"
                        type="login"
                        class="form-control"
                        name="login"
                        tabindex="1"
                        required
                        autofocus value="{{ old('login')}}">
                        @error('login')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                            class="control-label">Password</label>
                        <div class="float-right">
                            <a href="auth-forgot-password.html"
                                class="text-small">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <input id="password"
                        type="password"
                        class="form-control @error('password') is-invalid  
                                                @enderror"
                        name="password"
                        tabindex="2"
                        required  value="{{ old('password')}}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="remember"
                            class="custom-control-input"
                            tabindex="3"
                            id="remember-me">
                        <label class="custom-control-label"
                            for="remember-me">Remember Me</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush

