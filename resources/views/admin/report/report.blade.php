<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.report').' - Phone Admin'])

<body>
@include ('admin.common.index')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>@lang('languages.dashboard')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                <li class="breadcrumb-item">@lang('languages.report')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body">
                            <form action="{{ route('indexReport') }}" method="get">
                                <input type="date" name="start-date-product">
                                <input type="date" name="end-date-product">
                                <button type="submit">Search</button>
                            </form>
                            <div class="table-responsive">
                                <div class="widget-content">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                            <th style="width:60%; text-align: center;">@lang('languages.name')</th>
                                            <th style="width:10%; text-align: left;">@lang('languages.amount')</th>
                                            <th style="width:25%; text-align: center;">@lang('languages.date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($listProduct as $key => $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: left;">{{ $item->name ?? '' }}</td>
                                                <td style="text-align: left;">{{ $item->amount ?? '' }}</td>
                                                <td style="text-align: left;">{{ $item->created_at ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Left side columns -->
                    <div class="col-lg-4">
                        <div class="row">

                            <!-- Reports -->
                            <div class="col-12">

                                <h5 class="card-title">@lang('languages.inventory')</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    $(document).ready(function () {
                                        // Lấy phần tử HTML chứa biểu đồ
                                        var chartContainer = $("#reportsChart");

                                        var data = JSON.parse('{!! $product !!}');

                                        var dataSeries = data.map(function (item) {
                                            return item.amount;
                                        });

                                        var dataLabels = data.map(function (item) {
                                            return item.name;
                                        });

                                        // Tạo biểu đồ bằng ApexCharts
                                        var chartOptions = {
                                            chart: {
                                                type: "bar",
                                                height: 350
                                            },
                                            series: [{
                                                name: "Quantity",
                                                data: dataSeries
                                            }],
                                            xaxis: {
                                                categories: dataLabels
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                        };

                                        var chart = new ApexCharts(chartContainer[0], chartOptions);
                                        chart.render();
                                    });
                                </script>

                                <!-- End Line Chart -->

                            </div><!-- End Reports -->

                        </div>
                    </div><!-- End Left side columns -->
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <div class="widget-content">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                        <th style="width:80%; text-align: center;">@lang('languages.name')</th>
                                        <th style="width:15%; text-align: left;">@lang('languages.amount')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listItem as $key => $item)
                                        <tr>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td style="text-align: left;">{{ $item->product_name ?? '' }}</td>
                                            <td style="text-align: left;">{{ $item->total ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- Right side columns -->
                    <div class="col-lg-4">

                        <!-- Website Traffic -->
                        <h5 class="card-title">@lang('languages.best_sell')</h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            $(document).ready(function () {
                                // Lấy phần tử HTML chứa biểu đồ
                                var chartContainer = $("#trafficChart");
                                var data = JSON.parse('{!! $order !!}');

                                var dataSeries = data.map(function (item) {
                                    return item.total;
                                });

                                var dataLabels = data.map(function (item) {
                                    return item.product_name;
                                });


                                // Tạo biểu đồ bằng ApexCharts
                                var chartOptions = {
                                    chart: {
                                        type: "bar",
                                        height: 350
                                    },
                                    series: [{
                                        name: "Quantity",
                                        data: dataSeries
                                    }],
                                    xaxis: {
                                        categories: dataLabels
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                };

                                var chart = new ApexCharts(chartContainer[0], chartOptions);
                                chart.render();
                            });
                        </script>

                    </div><!-- End Right side columns -->
                    <!-- Website Traffic -->
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{ route('indexReport') }}" method="get">
                            <div class="row">
                                <div class="control-group col-md-4">
                                    <label class="control-label">@lang('languages.price')</label>
                                    <div class="controls">
                                        <input class="form-control" name="start-date-order" type="date" value="{!! old('price') !!}" />
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                <div class="control-group col-md-4">
                                    <label class="control-label">@lang('languages.price')</label>
                                    <div class="controls">
                                        <input class="form-control" name="end-date-order" type="date" value="{!! old('price') !!}" />
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                <div class="control-group col-md-2">
                                    <label class="control-label">@lang('languages.price')</label>
                                    <div class="controls">
                                        <input class="form-control" name="end-date-order" type="date" value="{!! old('price') !!}" />
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                <div class="control-group col-md-2">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary"><i class="ri-search-2-line"></i></button>
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                            </div>
                        </form>
                        <div class="table-responsive">
                            <div class="widget-content">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width:5%; text-align: center;">@lang('languages.num')</th>
                                        <th style="width:50%; text-align: center;">@lang('languages.name')</th>
                                        <th style="width:10%; text-align: left;">@lang('languages.amount')</th>
                                        <th style="width:10%; text-align: left;">@lang('languages.total')</th>
                                        <th style="width:25%; text-align: center;">@lang('languages.date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listOrder as $key => $item)
                                        <tr>
                                            <td style="text-align: center;">{{ $key + 1 }}</td>
                                            <td style="text-align: left;">{{ $item->customer_name ?? '' }}</td>
                                            <td style="text-align: left;">{{ $item->total_products ?? '' }}</td>
                                            <td style="text-align: left;">{{ number_format(($item->total_money ?? 0), 2) }}</td>
                                            <td style="text-align: left;">{{ $item->created_at ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- Right side columns -->
                    <div class="col-lg-4">

                        <h5 class="card-title">@lang('languages.top_order')</h5>

                        <div id="trafficChart1" style="min-height: 400px;" class="echart"></div>

                        <script>
                            $(document).ready(function () {
                                // Lấy phần tử HTML chứa biểu đồ
                                var chartContainer = $("#trafficChart1");

                                var data = JSON.parse('{!! $orderData !!}');

                                var dataSeries = data.map(function (item) {
                                    return item.total_money;
                                });

                                var dataLabels = data.map(function (item) {
                                    return item.customer_name;
                                });

                                // Tạo biểu đồ bằng ApexCharts
                                var chartOptions = {
                                    chart: {
                                        type: "bar",
                                        height: 350
                                    },
                                    series: [{
                                        name: "Total",
                                        data: dataSeries
                                    }],
                                    xaxis: {
                                        name: 'name',
                                        categories: dataLabels
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                };

                                var chart = new ApexCharts(chartContainer[0], chartOptions);
                                chart.render();
                            });
                        </script>

                    </div><!-- End Right side columns -->
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@include ('admin.common.footer')
</body>

</html>
