@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.account')</title>
@endsection
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">@lang('languages.home')</a></li>
            <li class="breadcrumb-item">@lang('languages.account')</li>
            <li class="breadcrumb-item active">@lang('languages.update')</li>
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
                    <form role="form" method="POST" action="{{ route('web.user.update', $user['id'] ?? 0) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>@lang('languages.username') <span style="color: red;">*</span></label>
                                <input class="form-control" type="text" name="username" value="{!! $user['username'] ?? old('username') !!}" placeholder="{{ __('languages.username') }}">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>@lang('languages.phone_number') <span style="color: red;">*</span></label>
                                <input class="form-control" type="text" name="phone" value="{!! $user['phone'] ?? old('phone') !!}" placeholder="{{ __('languages.phone_number') }}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            &emsp;
                            <div class="col-md-12" style="display: flex; justify-content: space-between;">
                                <button type="submit" class="btn">@lang('languages.change')</button>
                                <a href="{{ route('web.home') }}" class="btn">@lang('languages.cancel')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection