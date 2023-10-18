@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.login')</title>
@endsection

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item active">@lang('languages.login')</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
                @endif

                @if (Session::has('message-error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('message-error') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="login-form">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('languages.email')</label>
                                <input class="form-control" name="email" type="text" placeholder="E-mail">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>@lang('languages.password')</label>
                                <input class="form-control" name="password" type="password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <button class="btn">@lang('languages.login')</button>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="{{ route('forget.password.get') }}" class="forgot-password">@lang('languages.forgot_password')</a>
                            </div>
                            <div class="col-md-12" style="text-align: right;">
                                <p>@lang('languages.not_a_member') <a href="{{ route('register') }}">@lang('languages.register_here')</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6" style="text-align: center;">
                <a href="{{ route('google.login') }}" class="google-login">@lang('languages.login_with_google')</a>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection