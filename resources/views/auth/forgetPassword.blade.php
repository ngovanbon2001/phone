@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - Change password</title>
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
                            <label for="login-username"><i class="icon-user"></i> <b>Email</b></label>
                            <input class="form-control" id="login-username" name="email" type="text" placeholder="">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right"> Send Password Reset Link</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection