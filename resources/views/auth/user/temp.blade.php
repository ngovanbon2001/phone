@extends('layouts.app')

@section('content')
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Register</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="basic-login">
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input class="form-control" name="email" value="{{ $userTemp->email ?? null }}" type="hidden" placeholder="">

                        <div class="form-group">
                            <label for="register-username"><i class="icon-user"></i> <b>Code</b></label>
                            <input class="form-control" name="code" value="{{ old('code') }}" type="text" placeholder="">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right">Register</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-1 social-login">
                <p>Welcome to Nhat Mai store!</p>
            </div>
        </div>
    </div>
</div>
@endsection