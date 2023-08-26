<!DOCTYPE html>
<html lang="en">
@include ('admin.common.head', ['pageTitle' => 'Report - Phone Admin'])

<body>
    @include ('admin.common.index')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeAdmin')}}">Home</a></li>
                    <li class="breadcrumb-item">Report</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Inventory</h5>

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
                                                    name: "Series 1",
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

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Website Traffic -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Best sell</h5>

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
                                            name: "Series 1",
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
                            <h5 class="card-title">Top order</h5>

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
                                            name: "Series 1",
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