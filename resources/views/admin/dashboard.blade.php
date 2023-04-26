@extends('admin.layouts.master', ['title' => 'Dashboard'])

@section('css')
  <style>
    /* apexcharts-line-series  */
    #category-group-analytics g.apexcharts-line-series{
      display: none;
      width: 0%;
      position: absolute;
    }
    /*#category-group-analytics g.apexcharts-graphical {
      width: 100%;
    } */
  </style>
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <input type="text" name="filter" class="form-control border" placeholder="Jan 1, 20 to Dec 31, 20"
                                    value="{{ Request('filter') ? Request('filter') : '' }}" id="dash-daterange">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button disabled id="db-filter-btn" type="submit" class="btn btn-blue btn-sm ml-2"><i
                                class="mdi mdi-filter-variant"></i> Filter</button>
                        @if(Request('filter'))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-blue btn-sm ml-1">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        @endif
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="fe-heart font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="mt-1"><span data-plugin="counterup">{{ number_format($orders->sum('order_total')) }}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Total Revenue</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $orders->count() }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Sales</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $products->count() }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Total Products</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="fe-eye font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $customers->count() }}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Customers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <!-- Chart-->
    <div class="row">

        <div class="col-lg-6">
            <div class="card-box pb-2">

                <h4 class="header-title mb-3">Orders Analytics</h4>

                <div dir="ltr">
                    <div id="order-analytics" class="mt-4"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-6">
            <div class="card-box pb-2">

                <h4 class="header-title mb-3">Sales Analytics</h4>

                <div dir="ltr">
                    <div id="sales-analytics" class="mt-4"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-3">
            <div class="card-box">

                <h4 class="header-title mb-0">Top Sale Category</h4>

                <div class="widget-chart text-center" dir="ltr">
                    <div id="top-category" class="morris-chart mt-3"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-3">
            <div class="card-box">

                <h4 class="header-title mb-0">Top Sale Brand</h4>

                <div class="widget-chart text-center" dir="ltr">
                    <div id="top-brand" class="morris-chart mt-3"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-3">
            <div class="card-box">

                <h4 class="header-title mb-0">Top Sale Product</h4>

                <div class="widget-chart text-center" dir="ltr">
                    <div id="top-product" class="morris-chart mt-3"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->

        <div class="col-lg-3">
            <div class="card-box">

                <h4 class="header-title mb-0">Top Customers</h4>

                <div class="widget-chart text-center" dir="ltr">
                    <div id="top-customer" class="morris-chart mt-3"></div>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>

    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <h4 class="page-title mt-3" style="text-align: center;">SayAid Admin Dashboard</h4>
        </div>

    </div>
    <div class="row">
        <div class="card-box col-12 pb-2">

            <h4 class="header-title mb-3">Category Groups Analytics</h4>

            <div dir="ltr">
                <div id="category-group-analytics" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>
<script src="{{asset('assets/libs/morris.js06/morris.js06.min.js')}}"></script>
<script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
<script>
    // Datepicker
    $('#dash-daterange').flatpickr({
        altInput: true,
        mode: "range",
        altFormat: "M j, y",
        onChange: function(selectedDates, dateStr, instance){
            document.getElementById('db-filter-btn').removeAttribute('disabled');
        }
    });

    let orders = @json($orders_analytics_by_month);
    let completed_orders = [], canceled_orders = [], revenue = [], ordered_months = [];

    orders.forEach(data => {
        completed_orders = [...completed_orders, data.Completed]
        canceled_orders = [...canceled_orders, data.Canceled]
        revenue = [...revenue, data.total_revenue]
        ordered_months = [...ordered_months, data.month + ' ' + data.year]
    });
    //
    // Orders Analytics
    //
    var total_orders_options = {
        series: [{
        name: "Total Orders",
        data: completed_orders
    }],
        chart: {
        height: 350,
        type: 'line',
        zoom: {
        enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: 'Total orders by Month',
        align: 'left'
    },
    grid: {
        row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
        },
    },
    xaxis: {
        categories: ordered_months,
        tooltip: {
            enabled: false
        }
    },
    tooltip: {
        enabled: true,
        y: {
        formatter: function (val) {
            return val
        }
        }
    },
    };

    var chart = new ApexCharts(document.querySelector("#order-analytics"), total_orders_options);
    chart.render();
    //
    // Sales Analytics
    //
    var options = {
          colors: ['#00E396', '#ff4560', '#FEB019'],
          series: [{
          name: 'Completed',
          type: 'column',
          data: completed_orders
        }, {
          name: 'Canceled',
          type: 'column',
          data: canceled_orders
        }, {
          name: 'Revenue',
          type: 'line',
          data: revenue
        }],
          chart: {
          height: 350,
          type: 'line',
          stacked: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [1, 1, 4]
        },
        xaxis: {
          categories: ordered_months,
          tooltip: {
              enabled: false
            }
        },
        yaxis: [
          {
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#00E396'
            },
            labels: {
              style: {
                colors: '#00E396',
              }
            },
            title: {
              text: "Completed Orders",
              style: {
                color: '#00E396',
              }
            },
            tooltip: {
              enabled: false
            }
          },
          {
            seriesName: 'Completed',
            opposite: true,
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#ff4560'
            },
            labels: {
              style: {
                colors: '#ff4560',
              }
            },
            title: {
              text: "Canceled Orders",
              style: {
                color: '#ff4560',
              }
            },
          },
          {
            seriesName: 'Revenue',
            opposite: true,
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#FEB019'
            },
            labels: {
              style: {
                colors: '#FEB019',
              },
            },
            title: {
              text: "Revenue",
              style: {
                color: '#FEB019',
              }
            }
          },
        ],
        tooltip: {
          enabled: true,
          y: {
            formatter: function (val) {
              return val
            }
          }
        },
        legend: {
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#sales-analytics"), options);
        chart.render();


        // Category_groups Analytics
        //
        let category_groups = @json($category_groups_analytics_by_month);
        let total_sale_products = [], revenue_t = [], category_group_months = [],sold_category_groups =[];

        category_groups.forEach(data => {
            total_sale_products = [...total_sale_products, data.total_sale_products]
            revenue_t = [...revenue_t, data.total_revenue]
            category_group_months = [...category_group_months, data.month + ' ' + data.year]
            sold_category_groups = [...sold_category_groups,data.top_category_groups]
        });

        let traditionalMedicine =[], supplements = [],momsAndBaby = [],personalCare =[], healthcareDevices = [],features = [],medicine =[]

        for (let i = 0; i < sold_category_groups.length; i++) {

            for (let j = 0; j < sold_category_groups[i].length; j++) {
                let currentLabel = sold_category_groups[i][j].label;
                if (sold_category_groups[i][j].label === 'Traditional Medicine') {
                    traditionalMedicine[i] = sold_category_groups[i][j].value;
                }
                if (currentLabel === 'Supplements') {
                    supplements[i] = sold_category_groups[i][j].value;
                }
                if (currentLabel === 'Moms and Baby') {
                    momsAndBaby[i] = sold_category_groups[i][j].value;
                }
                if (currentLabel === 'Personal Care') {
                    personalCare[i] = sold_category_groups[i][j].value;
                }
                if (currentLabel === 'Healthcare Devices') {
                    healthcareDevices[i] = sold_category_groups[i][j].value;
                }
                if (currentLabel === 'Features') {
                    features[i] = sold_category_groups[i][j].value;
                }
                if(currentLabel === 'Medicine') {
                    medicine[i] = sold_category_groups[i][j].value;
                }
            };
            traditionalMedicine[i] = traditionalMedicine[i] ?? 0;
            supplements[i] = supplements[i] ?? 0;
            momsAndBaby[i] = momsAndBaby[i] ?? 0
            personalCare[i] = personalCare[i] ?? 0;
            healthcareDevices[i] = healthcareDevices[i] ?? 0;
            features[i] = features[i] ?? 0;
            medicine[i] = medicine[i] ?? 0;
        };

        var category_groups_options =
        {
          colors: ['#00E396','#7B2869','#0081C9','#FD8A8A','#98A8F8', '#ff4560','#FF7B54', '#FEB019'],
          series: [
        {
          name: 'Medicine ',
          type: 'line',
          data: medicine
        },
        {
          name: 'Traditional Medicine ',
          type: 'line',
          data: traditionalMedicine
        },
        {
          name: 'Healthcare Devices ',
          type: 'line',
          data: healthcareDevices
        },
        {
          name: 'Personal Care ',
          type: 'line',
          data: personalCare
        },
        {
          name: 'Supplement ',
          type: 'line',
          data: supplements
        },
        {
          name: 'Moms And Baby ',
          type: 'line',
          data: momsAndBaby
        },{
          name:"Features ",
          type:'line',
          data:features
        },{
          name: 'Total_Products ',
          type: 'column',
          data: total_sale_products
        }],
          chart: {
          height: 350,
          type: 'line',
          stacked: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [0,0,0,0,0,0,0,1]
        },
        xaxis: {
          categories: category_group_months,
          tooltip: {
              enabled: false
            }
        },
        yaxis: {
            opposite: true,
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#FEB019'
            },
            labels: {
              style: {
                colors: '#FEB019',
              },
            },
            title: {
              text: "Count",
              style: {
                color: '#FEB019',
              }
            }

        },
        tooltip: {
          enabled: true,
          y: {
            formatter: function (val) {
              return val
            }
          }
        },
        legend: {
          horizontalAlign: 'left',
          offsetX: 40
        }
        };


        var chart = new ApexCharts(document.querySelector("#category-group-analytics"), category_groups_options);
        chart.render();
        //
        // Top Category
        //
        var top_category_color = ['#4fc6e1','#6658dd', '#ebeff2'];
        var top_category_data = @json($top_categories);
        Morris.Donut({
            element: 'top-category',
            data: top_category_data,
            resize: true, //defaulted to true
            colors: top_category_color,
            backgroundColor: 'transparent'
        });

        var top_brand_color = ['#4fc6e1','#6658dd', '#ebeff2'];
        var top_brand_data = @json($top_brands);
        Morris.Donut({
            element: 'top-brand',
            data: top_brand_data,
            resize: true, //defaulted to true
            colors: top_brand_color,
            backgroundColor: 'transparent'
        });

        var top_product_color = ['#008ffb', '#00e396', '#feb019', '#ff4560'];
        var top_product_data = @json($top_products);
        Morris.Donut({
            element: 'top-product',
            data: top_product_data,
            resize: true, //defaulted to true
            colors: top_product_color,
            backgroundColor: 'transparent'
        });

        var top_customer_color = ['#008ffb', '#00e396', '#feb019', '#ff4560'];
        var top_customer_data = @json($top_customers);
        Morris.Donut({
            element: 'top-customer',
            data: top_customer_data,
            resize: true, //defaulted to true
            colors: top_customer_color,
            backgroundColor: 'transparent'
        });
</script>
@endsection
