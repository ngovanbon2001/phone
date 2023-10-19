@extends('layouts.app')
@section('title')
<title>NhatMai SHOP - @lang('languages.order')</title>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="error-page-wrapper">
                <h1>@lang('languages.successful')!</h1>
                <p>@lang('languages.order_successful')! @if(isset(auth()->user()->id)) <a href="{{ route('order.show', auth()->user()->id) }}">@lang('languages.click_here')</a> @endif</p>
            </div>
        </div>
    </div>
</div>
@endsection