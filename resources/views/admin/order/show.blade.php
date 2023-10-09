<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Order - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('indexOrder') }}">Order</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <div id="message">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session()->has('message-error'))
                    <div class="alert alert-danger">
                        {{ session('message-error') }}
                    </div>
                    @endif
                </div>

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card-body">
                            <div class="table-responsive">

                                <div class="card-header">

                                    <form action="{{ route('indexOrder') }}" method="get">
                                        <div class="search"> &emsp;

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="control-group col-md-4">
                                                        <label class="control-label">Customer's name</label>
                                                        <div class="controls">
                                                            <input class="form-control" name="customer_name" type='text' value="{{ request('customer_name') ?? '' }}" placeholder="Customer's name" />
                                                            @error ('customer_name')
                                                            <label class="error">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="control-group col-md-4">
                                                        <label class="control-label">Phone number</label>
                                                        <div class="controls">
                                                            <input class="form-control" name="customer_phone" type='text' value="{{ request('customer_phone') ?? '' }}" placeholder="Phone number" />
                                                            @error ('customer_phone')
                                                            <label class="error">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="control-group col-md-4">
                                                        <label class="control-label"></label>
                                                        <div class="controls">
                                                            <button class="btn btn-secondary" type="submit"><i class="ri-search-2-line"></i></button> &emsp;
                                                            <a href="{{ route('indexOrder') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-line"></i></a> &emsp;
                                                            <a href="{{ route('exportOrder', ['page' => request('page') ?? 1,'customer_name' => request('customer_name') ?? '', 'customer_phone' => request('customer_phone') ?? '']) }}" class="btn btn-secondary"><i class="ri-file-excel-2-line"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="widget-content">
                                    <table style="width:100%; margin-top: 20px;" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:5%; text-align: center;">No</th>
                                                <th style="width:25%; text-align: left;">Customer's name</th>
                                                <th style="width:10%; text-align: left;">Email</th>
                                                <th style="width:5%; text-align: center;">Phone</th>
                                                <th style="width:10%; text-align: center;">Total product</th>
                                                <th style="width:15%; text-align: center;">Quantity</th>
                                                <th style="width:35%; text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $orderList)
                                            <tr>
                                                <td style="text-align: center;">{{ $key+1 }}</td>
                                                <td style="text-align: left;">{{ $orderList['customer_name'] ?? ''}}</td>
                                                <td style="text-align: left;">{{ $orderList->customer_email ?? '' }}</td>
                                                <td style="text-align: center;">{{ $orderList->customer_phone ?? '' }}</td>
                                                <td style="text-align: right;">{{ number_format($orderList->total_money ?? 0) }}</td>
                                                <td style="text-align: right;">{{ $orderList->total_products ?? 0 }}</td>

                                                <td>
                                                    <a href="{{ route('showbyId', $orderList->id) }}" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12" style="display: flex; justify-content: center;">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{  $orders->appends(request()->except('page'))->previousPageUrl() }}">
                                    << </a>
                            </li>
                            @foreach($orders->links()->getData()["elements"][0] as $key => $item)
                            <li class="page-item"><a class="page-link" href="{{$item}}">{{$key}}</a></li>
                            @endforeach
                            <li class="page-item"><a class="page-link" href="{{ $orders->appends(request()->except('page'))->nextPageUrl() }}">>></a></li>
                        </ul>
                    </nav><!-- End Basic Pagination -->
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>