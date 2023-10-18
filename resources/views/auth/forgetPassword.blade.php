@extends('layouts.app')
@section('title')
<title>NhatMai SHOP -  @lang('languages.change_password')</title>
@endsection

@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
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
            <div class="col-sm-5">
                <div class="basic-login">
                    <form role="form" role="form" method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" id="login-username" name="email" type="text" placeholder="{{ __('languages.email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right"> @lang('languages.send_password_reset_link')</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection