@extends('layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Order Successful</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="error-page-wrapper">
                        <p>Order Successful! @if(isset(auth()->user()->id)) <a href="{{ route('order.show', auth()->user()->id) }}">Click here</a> @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
