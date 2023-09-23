@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="error-page-wrapper">
                <h1>Successful!</h1>
                <p>Order Successful! @if(isset(auth()->user()->id)) <a href="{{ route('order.show', auth()->user()->id) }}">Click here</a> @endif</p>
            </div>
        </div>
    </div>
</div>
@endsection