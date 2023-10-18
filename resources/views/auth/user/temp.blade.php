@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.confirm_register')</title>
@endsection
@section('content')
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>@lang('languages.register')</h1>
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
                            <input class="form-control" name="code" value="{{ old('code') }}" type="text" placeholder="{{ __('languages.code') }}">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right">@lang('languages.register')</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection