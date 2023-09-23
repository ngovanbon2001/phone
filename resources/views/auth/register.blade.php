@extends('layouts.app')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active">Login & Register</li>
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
                            <div class="col-md-6">
                                <label>Name</label>
                                <input class="form-control" type="text" name="username" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" placeholder="E-mail">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="phone" placeholder="Mobile No">
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Retype Password</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <button class="btn">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <h3>Welcome to Nhat Mai store!</h3>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection