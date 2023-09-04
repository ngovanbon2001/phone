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
                    @if (session()->has('message-update-order'))
                    <div class="alert alert-danger">
                        {{ session('message-update-order') }}
                    </div>
                    @endif
                    @if (session()->has('message-update-order-success'))
                    <div class="alert alert-success">
                        {{ session('message-update-order-success') }}
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
                                                            <input id='searchInput' class="form-control" name="inputName" type='text' value="{{ request('inputName') }}" placeholder="Customer's name" />
                                                            @error ('inputName')
                                                            <label class="error">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="control-group col-md-4">
                                                        <label class="control-label">Phone</label>
                                                        <div class="controls">
                                                            <input class="form-control" name="inputPhone" type='text' value="{{ request('inputPhone') }}" placeholder='Phone' />
                                                            @error ('inputPhone')
                                                            <label class="error">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="control-group col-md-4">
                                                        <label class="control-label">Email</label>
                                                        <div class="controls">
                                                            <input class="form-control" name="inputEmail" type='text' value="{{ request('inputEmail') }}" placeholder='Email' />
                                                            @error ('inputEmail')
                                                            <label class="error">{{ $message }}</label>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="control-group col-md-6">
                                                        <button class="btn btn-secondary" name="btnSearch" value="btnSearch"><i class="ri-search-2-line"></i></button> &emsp;
                                                        <a href="{{ route('indexOrder') }}" class="btn btn-secondary"><i class="ri-arrow-go-back-line"></i></a>
                                                        <a href="{{ route('exportOrder') }}" class="btn btn-secondary"><i class="ri-file-excel-2-line"></i></a>
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
                                                <th style="width:10%; text-align: left;">Customer's name</th>
                                                <th style="width:10%; text-align: left;">Email</th>
                                                <th style="width:5%; text-align: center;">Phone</th>
                                                <th style="width:10%; text-align: center;">Total product</th>
                                                <th style="width:15%; text-align: center;">Items</th>
                                                <th style="width:5%; text-align: center;">Status</th>
                                                <th style="width:35%; text-align: center;">Action</th>
                                                <th style="width:5%; text-align: center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $orderList)
                                            <tr>
                                                <td style="text-align: center;"><a class="color-text" href="{{ route('showbyId', $orderList->id) }}">{{ $key+1 }} </a></td>
                                                <td style="text-align: left;"><a class="color-text" href="{{ route('showbyId', $orderList->id) }}">{{ $orderList['order']['customer_name'] ?? ''}}</a></td>
                                                <td style="text-align: left;"><a class="color-text" href="{{ route('showbyId', $orderList->id) }}">{{ $orderList->order->customer_email ?? '' }}</a></td>
                                                <td style="text-align: center;"><a class="color-text" href="{{ route('showbyId', $orderList->id) }}">{{ $orderList->order->customer_phone ?? '' }}</a></td>
                                                <td style="text-align: right;"><a class="color-text" href="{{ route('showbyId', $orderList->id) }}">{{ number_format($orderList->product_quantity ?? 0) }}</a></td>
                                                <td style="text-align: left;">
                                                    <a class="color-text" href="{{ route('showbyId', $orderList->id) }}">
                                                        {{ $orderList->product_name ?? '' }}
                                                    </a>
                                                </td>
                                                @foreach (App\Constants\Common::STATUS_ORDER as $key => $value)
                                                    @if(($orderList->status ?? 0) == $key)
                                                        <td>{{ $value }}</td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    @if ((($orderList->status ?? 0) != App\Constants\Common::CANCEL) && (($orderList->status ?? 0) != App\Constants\Common::PAID))
                                                    <form action="{{ route('updateOrder', $orderList->id) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit"><i class="bi bi-coin"></i></button>
                                                    </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ((($orderList->status ?? 0) != App\Constants\Common::CANCEL) && (($orderList->status ?? 0) != App\Constants\Common::PAID))
                                                    <form action="{{ route('cancel-order', $orderList->id) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit"><i class="bi bi-coin"></i></button>
                                                    </form>
                                                    @endif
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