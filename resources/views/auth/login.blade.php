@extends('admin.layouts.app')
@section('title','Login')
@section('user-not-login')
<div class="account-page">
        <div class="main-wrapper">
            <div class="account-content" style="padding: 0px;margin-top:8%">
                <div class="container">
                    <div class="account-logo">
                        <a href="{{ route('login') }}"
                            ><img
                                src="{{ asset ('frontend/images/logo5.png')}}"
                                alt="logo"
                        /></a>
                    </div>

                    <div class="account-box">
                        <div class="account-wrapper">
                            <h3 class="account-title">Login</h3>
                            <p class="account-subtitle">
                                Access to our dashboard
                            </p>

                            <form method="POST" action="{{ route('login') }}">
                        @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input
                                        class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        type="text"
                                        id="email"
                                    />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>{{ __('Password') }}</label>
                                        </div>
                                        <div class="col-auto">
                                        @if (Route::has('password.request'))
                                    {{-- <a class="btn btn-link" href="{{ route('forget.password.show') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a> --}}
                                @endif
                                        </div>
                                    </div>
                                    <div class="position-relative">
                                        <input
                                        id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                        />
                                        <span
                                            class="fa fa-eye-slash"
                                            id="toggle-password"
                                        ></span>
                                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button
                                        class="btn btn-primary account-btn"
                                        type="submit"
                                    >
                                        Login
                                    </button>
                                </div>
                                {{-- <div class="account-footer">
                                    <p>
                                        Don't have an account yet?
                                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                                    </p>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
