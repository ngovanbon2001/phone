<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => __('languages.home').' - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@lang('languages.dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">@lang('languages.home')</a></li>
                    <li class="breadcrumb-item active">@lang('languages.dashboard')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('languages.sold') <span>| @lang('languages.this_month')</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total->total_products ?? 0 }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('languages.revenue') <span>| @lang('languages.this_month')</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format(($total->total_money ?? 0)) }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('languages.customers')</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $totalUser }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">@lang('languages.inventory')</h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>
                                    <script>
                                        $(document).ready(function() {
                                            // Lấy phần tử HTML chứa biểu đồ
                                            var chartContainer = $("#reportsChart");

                                            var data = JSON.parse('{!! $product !!}');
                                            
                                            var dataSeries = data.map(function(item) {
                                                return item.amount;
                                            });

                                            var dataLabels = data.map(function(item) {
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

                                </div>

                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">@lang('languages.best_sell')</h5>

                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                $(document).ready(function() {
                                    // Lấy phần tử HTML chứa biểu đồ
                                    var chartContainer = $("#trafficChart");
                                    var data = JSON.parse('{!! $order !!}');

                                    var dataSeries = data.map(function(item) {
                                        return item.total;
                                    });

                                    var dataLabels = data.map(function(item) {
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

                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">@lang('languages.top_order')</h5>

                            <div id="trafficChart1" style="min-height: 400px;" class="echart"></div>

                            <script>
                                $(document).ready(function() {
                                    // Lấy phần tử HTML chứa biểu đồ
                                    var chartContainer = $("#trafficChart1");

                                    var data = JSON.parse('{!! $orderData !!}');

                                    var dataSeries = data.map(function(item) {
                                        return item.total_money;
                                    });

                                    var dataLabels = data.map(function(item) {
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

                        </div>
                    </div><!-- End Website Traffic -->

                </div><!-- End Right side columns -->

            </div>
        </section>
    </main><!-- End #main -->

    @include ('admin.common.footer')
</body>

</html>