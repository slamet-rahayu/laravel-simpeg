@php
    $data = DB::table('bagian')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->select('nama_bagian',DB::raw('count(*) as total'))
        ->groupBy('nama_bagian')
        ->orderBy('nama_bagian','ASC')
        ->get();
    $nabag = DB::table('bagian')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->select('nama_bagian')
        ->groupBy('nama_bagian')
        ->orderBy('nama_bagian','ASC')
        ->get();
    $jen = DB::table('bagian')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->select('nama_bagian','jen_kel',DB::raw('count(*) as total'))
        ->groupBy('nama_bagian','jen_kel')
        ->orderBy('nama_bagian','ASC')
        ->get();
        $smp = DB::table('pend_terakhir')
        ->where('pendidikan','=','SMP')
        ->count();

        $sma = DB::table('pend_terakhir')
        ->where('pendidikan','=','SMA/K')
        ->count();

        $dpl = DB::table('pend_terakhir')
        ->where('pendidikan','=','Diploma')
        ->count();

        $srj = DB::table('pend_terakhir')
        ->where('pendidikan','=','Sarjana')
        ->count();

        $mgr = DB::table('pend_terakhir')
        ->where('pendidikan','=','Magister')
        ->count();

        $dr = DB::table('pend_terakhir')
        ->where('pendidikan','=','Doktor')
        ->count();
    $str = '0123456789abcdef';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIMPEG Pesantren Tahfidz Preneur YBMPLN</title>
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('base/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
  <link rel="stylesheet" href="{{asset('sweetalert/dist/sweetalert.css')}}">
  <link rel="stylesheet" href="{{asset('css/sweetalert.min.css')}}">
  <link rel="stylesheet" href="{{asset('fullcalendar/packages/core/main.css')}}">
  <link href={{asset('fullcalendar/packages/daygrid/main.css')}} rel="stylesheet" />
  <link href={{asset('fullcalendar/packages/timegrid/main.css')}} rel="stylesheet" />
  <link href={{asset('fullcalendar/packages/list/main.css')}} rel="stylesheet" />
  
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('images/favicon.ico')}}" />
</head>
@if (Session::has('sukses'))
<body onload="sukses()">
@elseif (Session::has('edit'))
<body onload="edit()">
@elseif(Session::has('hapus'))
<body onload="hapus()">
@else
<body>
@endif

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('simpeg.partials.navbar')
    <div class="container-fluid page-body-wrapper">
      @include('simpeg.partials.sidebar')
      <div class="main-panel">
        <div class="jumbotron">
          @yield('main')
        </div>
        @include('simpeg.partials.footer')
      </div>
    </div>
  </div>
  
  <script src="{{asset('base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('js/script.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src={{asset('fullcalendar/packages/core/main.js')}}></script>
  <script src={{asset('fullcalendar/packages/core/locales-all.js')}}></script>
  <script src={{asset('fullcalendar/packages/interaction/main.js')}}></script>
  <script src={{asset('fullcalendar/packages/daygrid/main.js')}}></script>
  <script src={{asset('fullcalendar/packages/timegrid/main.js')}}></script>
  <script src={{asset('fullcalendar/packages/list/main.js')}}></script>
  <script src="{{asset('js/dashboard.js')}}"></script>
  <script src="{{asset('js/file-upload.js')}}"></script>
  <script src="{{asset('js/tabs.js')}}"></script>
  <script src="{{asset('js/tooltips.js')}}"></script>
  <script src="{{asset('js/jquery-ui.js')}}"></script>
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  {{-- <script src="{{asset('sweetalert/dist/sweetalert.js')}}"></script> --}}
  <script src="{{asset('js/sweetalert.min.js')}}"></script>
  <script src="{{asset('chart/Chart.min.js')}}"></script>
  <script src="{{asset('js/chart.js')}}"></script>
  <script src="{{asset('js/loader.js')}}"></script>
  <script>
    (function($) {
  'use strict';
  $(function() {
    if ($("#order-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [
          {
            data: [175, 200, 130, 210, 40, 60, 25],
            backgroundColor: [
              'rgba(255, 193, 2, .8)'
            ],
            borderColor: [
              'transparent'
            ],
            borderWidth:3,
            fill: 'origin',
            label: "services"
          },
          {
            data: [175, 145, 190, 130, 240, 160, 200],
            backgroundColor: [
              'rgba(245, 166, 35, 1)'
            ],
            borderColor: [
              'transparent'
            ],
            borderWidth:3,
            fill: 'origin',
            label: "purchases"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              min: 0,
              max: 260
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .45
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#order-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#sales-chart").length) {
      var SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");
      var SalesChart = new Chart(SalesChartCanvas, {
        type: 'bar',
        data: {
          labels: [
            @foreach($nabag as $n)
            "{{$n->nama_bagian}}",
            @endforeach
            ],
          datasets: [{
              label: 'Perempuan',
              data: [
                @foreach($nabag as $n)
                {{rand(0,10)}},
                @endforeach
                ],
              backgroundColor: '#{{substr(str_shuffle($str),0,6)}}'
            },
            {
              label: 'Laki-Laki',
              data: [
                @foreach($nabag as $n)
                {{rand(0,10)}},
                @endforeach
                ],
              backgroundColor: '#{{substr(str_shuffle($str),0,6)}}'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                display: true,
                // min: 0,
                // max: 20
              }
            }],
            xAxes: [{
              stacked: false,
              ticks: {
                beginAtZero: true,
                fontColor: "#9fa0a2"
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: true
              },
              barPercentage: 1
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        },
      });
      document.getElementById('sales-legend').innerHTML = SalesChart.generateLegend();
    }

    if ($("#north-america-chart").length) {
      var areaData = {
        labels: [
          @foreach ($data as $d)
          "{{$d->nama_bagian}}",
          @endforeach
        ],
        datasets: [{
            data: [
          @foreach ($data as $d)
          "{{$d->total}}",
          @endforeach
            ],
            backgroundColor: [
          @foreach($data as $k=>$v)
          "#{{substr(str_shuffle($str),0,6)}}",
          @endforeach
            ],
            borderColor: "rgba(0,0,0,0)"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 10,
        elements: {
          arc: {
              borderWidth: 0
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        legendCallback: function(chart) { 
          var text = [];
            text.push('<div class="report-chart">');
            @foreach($data as $k=>$d)
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[{{$k}}] + '"></div><p class="mb-0">{{$d->nama_bagian}}</p></div>');
            text.push('<p class="mb-0">{{$d->total}}</p>');
            text.push('</div>');
            @endforeach
            text.push('</div>');
          return text.join("");
        },
      }
      var northAmericaChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 3.125;
          ctx.font = "600 " + fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#000";
      
          var text = "",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
      var northAmericaChart = new Chart(northAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: northAmericaChartPlugins
      });
      document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
    }

  });
})(jQuery);

google.charts.load('current', {'packages':['bar','corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Total',],

          @foreach($data as $d)
          ['{{$d->nama_bagian}}',{{$d->total}},],
          @endforeach


          // ['2015', 1170, 460, 250],
          // ['2016', 660, 1120, 300],
          // ['2017', 1030, 540, 350],
          // ['2018', 680, 840, 300]
        ]);

        var options = {
          chart: {
            title: 'Data Bagian',
            // subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var data = google.visualization.arrayToDataTable([
          ['Pendidikan', 'Jumlah Keseluruhan'],
          ['SMP',     {{$smp}}],
          ['SMA/K',   {{$sma}}],
          ['Diploma', {{$dpl}}],
          ['Sarjana', {{$srj}}],
          ['Magister',{{$mgr}}],
          ['Doktor',   {{$dr}}]
        ]);

        var options = {

          pieHole: 0.4,
          legend:{position: 'bottom'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
        
      }

      // $('#name').on('change', function(){
      //   $('#email').val($(this).val());
      //   })

      //   $('#name').change();
  </script>
  <!-- End custom js for this page-->
</body>

</html>

