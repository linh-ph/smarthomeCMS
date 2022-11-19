@extends('layout')
@section('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-2">Nhiệt Độ</h4>

            <div class="mt-1">
                <div class="float-left" dir="ltr">
                    <input id="temp" data-plugin="knob" data-width="64" data-height="64" data-fgColor="#f05050 "
                        data-bgColor="#F9B9B9" value="{{ $value_temp ?? 30 }}"
                        data-skin="tron" data-angleOffset="180" data-readOnly=true
                        data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h2 id="temp_text" class="mt-3 pt-1 mb-1"> {{ $value_temp ?? 30 }}(°C) </h2>
                    <p class="text-muted mb-0">Xem lịch sử</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-3">Khí Gas</h4>

            <div class="mt-1">
                <div class="float-left" dir="ltr">
                    <input id="input-gas" data-plugin="knob" data-width="64" data-height="64" data-fgColor="#675db7"
                        data-bgColor="#e8e7f4" value="{{ $valueGas ?? 10}}"
                        data-skin="tron" data-angleOffset="180" data-readOnly=true
                        data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h2 id="gas_value" class="mt-3 pt-1 mb-1"> {{ $valueGas ?? 10}} </h2>
                    <p class="text-muted mb-0">Xem lịch sử</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-3">Âm thanh</h4>

            <div class="mt-1">
                <div class="float-left" dir="ltr">
                    <input id="input-sound" data-plugin="knob" data-width="64" data-height="64" data-fgColor="#23b397"
                        data-bgColor="#c8ece5" value="{{$valueSound/100 ?? 10}}"
                        data-skin="tron" data-angleOffset="180" data-readOnly=true
                        data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h2 id="sound_text" class="mt-3 pt-1 mb-1"> {{$valueSound ?? 10}}(dB)</h2>
                    <p class="text-muted mb-0">Xem lịch sử</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <div class="card-box">

            <h4 class="header-title mt-0 mb-3">Đèn</h4>

            <div class="mt-1">
                <div class="float-left" dir="ltr">
                    <div class="col-lg-6">
                        <div class="switchery-demo">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"/>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="mt-3 pt-1 mb-1"> {{$valueLight}} </h2>
                    <!-- <p class="text-muted mb-0">Revenue today</p> -->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end col -->

</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <!-- Portlet card -->
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                    <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                </div>
                <h4 class="header-title mb-0">Biểu đồ nhiệt độ</h4>

                <div id="cardCollpase1" class="collapse pt-3 show" dir="ltr">
                    <div id="apex-sales-analytics-2" class="apex-charts"></div>
                    <!-- <div class="text-center">
                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4><i class="fe-arrow-down text-danger mr-1"></i>$7.8k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success mr-1"></i>$1.4k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-down text-danger mr-1"></i>$9.8k</h4>
                            </div>
                        </div>
                        
                    </div> -->
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                    <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                </div>
                <h4 class="header-title mb-0">Biểu đồ Khí Gas</h4>

                <div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
                    <div id="apex-order-analytics-2" class="apex-charts"></div>
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row -->

<!-- <div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title">Earning Reports</h4>
            <p class="text-muted">1 Mar - 31 Mar Showing Data</p>
            <h2 class="mb-4"><i class="mdi mdi-currency-usd text-primary"></i>25,632.78</h2>

            <div class="row mb-4">
                <div class="col-6">
                    <p class="text-muted mb-1">This Month</p>
                    <h3 class="mt-0 font-20">$120,254 <small class="badge badge-light-success font-13">+15%</small></h3>
                </div>

                <div class="col-6">
                    <p class="text-muted mb-1">Last Month</p>
                    <h3 class="mt-0 font-20">$98,741 <small class="badge badge-light-danger font-13">-5%</small></h3>
                </div>
            </div>

            <h5 class="font-16"><i class="mdi mdi-chart-donut text-primary"></i> Weekly Earning Report</h5>

            <div class="mt-5">
                <span data-plugin="peity-bar" data-colors="#f7b84b,#ebeff2" data-width="100%" data-height="80">5,3,9,6,5,9,7,3,5,2,9,7,2,1,3,5,2,9,7,2,5,3,9,6,5,9,7</span>
            </div>

        </div>
    </div>
</div> -->
<input type="hidden" id="AIO_KEY" value="{{$AIO_KEY}}">
<!-- end row -->
@endsection

@section('js')
<!-- Third Party js-->
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/libs/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- third party js ends -->
<!-- Dashboard init -->
<script src="{{ asset('assets/js/pages/dashboard-2.init.js') }}"></script>
<script>
    var AIO_KEY = $('#AIO_KEY').val();
    // console.log(AIO_KEY);
    // do am
    var e = {
        series: [],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                    speed: 1000
                }
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#77B6EA'],
        dataLabels: {
            enabled: false,
        },

        stroke: {
            curve: 'smooth'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        noData: {
            text: 'Loading....'
        },
        xaxis: {
            // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            // title: {
            //     text: 'Ngày'
            // }
            type: 'category',
            tickPlacement: 'on'
        },
        // yaxis: {
        //     // title: {
        //     //     text: 'Nhiệt độ'
        //     // },
        //     // min: 5,
        //     // max: 100
        //     type: 'H:i:s'
        // },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };
    var chartNewTemp = new ApexCharts(document.querySelector("#apex-sales-analytics-2"), e); 
    chartNewTemp.render();

    var chartNewGas = new ApexCharts(document.querySelector("#apex-order-analytics-2"), e); 
    chartNewGas.render();
</script>

<script>
function getDataTemp() {
    var tempUrl = "https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc-slash-feeds-slash-bk-iot-temp-humid/data";
    $.ajaxSetup({
        headers: {
            'x-aio-key': AIO_KEY
        }
    });
    $.ajax({
        url: tempUrl,
        type: 'get',
        success: function(data) {
            // console.log('data temp', data[0]['value']);
            $('#temp').val(data[0]['value']);
            $('#temp_text').text(data[0]['value']);
            var data_new = [];
            for(var i = 15 ; i >= 0; i--) {
                // console.log('lap temp-'+i, data[i]['value'])
                const d = new Date(Date.parse(data[i]['expiration']));
                // console.log('time lap temp-'+i, d)
                data_new.push({y: data[i]['value'], x: d.toLocaleTimeString()});
            }
            chartNewTemp.updateSeries([{
                data: data_new.slice()
            }])
        } 
    });
}
// khi gas
function getDataGas() {
    var gasUrl = "https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc1-slash-feeds-slash-bk-iot-gas/data";
    $.ajaxSetup({
        headers: {
            'x-aio-key': AIO_KEY
        }
    });
    $.ajax({
        url: gasUrl,
        type: 'get',
        success: function(data) {
            // console.log(data[0]['value']);
            $('#input-gas').val(data[0]['value']);
            $('#gas_value').text(data[0]['value']);
            var data_new = [];
            for(var i = 15 ; i >= 0; i--) {
                // console.log('lap temp-'+i, data[i]['value'])
                const d = new Date(Date.parse(data[i]['expiration']));
                // console.log('time lap temp-'+i, d)
                data_new.push({y: data[i]['value'], x: d.toLocaleTimeString()});
            }
            chartNewGas.updateSeries([{
                data:data_new.slice()
            }])
        } 
    });
}
// tieng on
function getDataSound() {
    var soundUrl = "https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc1-slash-feeds-slash-bk-iot-sound/data";
    $.ajaxSetup({
        headers: {
            'x-aio-key': AIO_KEY
        }
    });
    $.ajax({
        url: soundUrl,
        type: 'get',
        success: function(data) {
            console.log(data[0]['value']);
            $('#input-sound').val(data[0]['value']);
            $('#sound_text').text(data[0]['value']);
        } 
    });
}

function getChartTemp() {
    var tempUrlChart = "https://io.adafruit.com/api/v2/tinhphamtrung/feeds/intput-device.cse-bbc-slash-feeds-slash-bk-iot-temp-humid/data/chart";
    $.ajaxSetup({
        headers: {
            'x-aio-key': AIO_KEY
        }
    });
    $.ajax({
        url: tempUrlChart,
        type: 'get',
        success: function(data) {
            console.log("chart", data['data']);
            // $('#temp').val(data['data']);
            // $('#temp_text').text(data['data']);
            chartTemp = data['data']
            console.log(chartTemp.length);
        } 
    });
}
</script>
<script>
$(document).ready(function () {
    // getChartTemp();
    // getDataTemp();

    window.setInterval(function () {
        getDataGas();
        getDataTemp();
        getDataSound();
        // getChartTemp();
    }, 5000)
});
</script>
<!-- chart realtime -->
<script>
    var lastDate = 0;
    // var baseval = new Date('11 Feb 2021 GMT').getTime();
    var data = []
    // var TICKINTERVAL = 5000
    var TICKINTERVAL = 86400000
    let XAXISRANGE = 777600000
    // let XAXISRANGE = TICKINTERVAL
    
    function getDayWiseTime(baseval, count, yrange) {
        var i = 0;
        while (i < count) {
            var x = baseval;
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
        
            data.push({
                x, y
            });
            lastDate = baseval
            baseval += TICKINTERVAL;
            i++;
        }
    }
    var initNum = 10
    getDayWiseTime(new Date().getTime(), 10, {
        min: 10,
        max: 90
    })
    
    function getNewSeries(baseval, yrange) {
    var newDate = baseval + TICKINTERVAL;
    lastDate = newDate
  
    for(var i = 0; i< data.length - 10; i++) {
      // IMPORTANT
      // we reset the x and y of the data which is out of drawing area
      // to prevent memory leaks
      data[i].x = newDate - XAXISRANGE - TICKINTERVAL
      data[i].y = 0
    }
  
    data.push({
      x: newDate,
      y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
    })
  }
    // var data = Math.floor(Math.random() * 2)
    var options = {
        series: [{
            data: data.slice()
        }],
        chart: {
            id: 'realtime',
            height: 350,
            type: 'line',
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                    speed: 1000
                }
            },
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 0
        },
        xaxis: {
            type: 'datetime',
            // range: XAXISRANGE,
        },
        yaxis: {
            max: 100
        },
        legend: {
            show: false
        },
    };
    // var chart = new ApexCharts(document.querySelector("#"), options);
    // chart.render();
    // window.setInterval(function () {
    //     getNewSeries(lastDate, {
    //         min: 10,
    //         max: 90
    //     })
    //     console.log('date',lastDate)
    //     console.log('data',data)
    //     chart.updateSeries([{
    //         data: data
    //     }])
    // }, 5000)
</script>
@endsection