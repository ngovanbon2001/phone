@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.register')</title>
@endsection
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item active">@lang('languages.register')</li>
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
                <div class="register-form">
                    <form role="form" method="POST" action="{{ route('save-user') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>@lang('languages.username')</label>
                                <input class="form-control" type="text" name="username" placeholder="{{ __('languages.username') }}">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('languages.email') <span style="color: red;">*</span></label>
                                <input class="form-control" type="text" name="email" placeholder="{{ __('languages.email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>@lang('languages.phone_number')</label>
                                <input class="form-control" type="text" name="phone" placeholder="{{ __('languages.phone_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('languages.password') <span style="color: red;">*</span></label>
                                <input class="form-control" type="password" name="password" placeholder="{{ __('languages.password') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>@lang('languages.re_enter_password')</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="{{ __('languages.re_enter_password') }}">
                            </div>
                            <div class="col-md-5">
                                <button type="submit" class="btn">@lang('languages.register')</button>
                            </div>
                            <div class="col-md-7" style="text-align: right;">
                                <p>@lang('languages.you_have_account') <a href="{{ route('login') }}">@lang('languages.sign_in')</a></p>
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