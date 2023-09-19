@extends('layouts.app')

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
                    <form role="form" role="form" method="POST" action="{{ route('reset.password.post') }}">
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
                            <label><i class="icon-user"></i> <b>Password</b></label>
                            <input class="form-control" id="login-username" name="password" type="password" placeholder="">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><i class="icon-user"></i> <b>Password confirmation</b></label>
                            <input class="form-control" id="login-username" name="password_confirmation" type="password" placeholder="">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right"> Reset Password</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-7 social-login">
                <p>Welcome to Nhat Mai store!</p>
                <div class="clearfix"></div>
                <div class="not-member">
                    <p>Not a member? <a href="{{ route('register') }}">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection