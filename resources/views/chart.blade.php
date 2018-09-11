<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bridge Cubes</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/handsontable-pro@5.0.1/dist/handsontable.full.min.css" rel="stylesheet" media="screen">-->

    <!--<link href="https://cdn.jsdelivr.net/npm/handsontable@5.0.1/dist/handsontable.full.min.css" rel="stylesheet" media="screen">-->
    
    <link rel="stylesheet" type="text/css" href="https://handsontable.com/static/css/main.css">

    <link type="text/css" rel="stylesheet" href="https://docs.handsontable.com/pro/1.11.0/bower_components/handsontable-pro/dist/handsontable.full.min.css"> 

    <!-- Style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            padding: 0;
            margin: 0;
            background: #fff;
            font: 0.8em sans-serif;
            color: #333;
        }

        .chartJSContainer {
            margin-bottom: 1em;
        }

    </style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Bridge_Cubes') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<br>
<br>

<div class="container">
    <div id="app">
        <div class="align-center content">
            <h3>This is header</h3>
            
            <p>
                This is sample <strong>Bridge Cubes</strong> Handsontable <strong>Sheet</strong>
            </p>
            
<div id="bridgecubes"></div>
<canvas class="chartJSContainer" width='400' height='150'></canvas>
            <!--<div id="hot"></div>-->
            <!--<canvas class="chartJSContainer" width='400' height='150'></canvas>-->
        </div>
    </div>
</div>

<!-- hands on table cdn links -->
<script src="https://cdn.jsdelivr.net/npm/handsontable-pro@5.0.1/dist/handsontable.full.min.js"></script>
<script src="https://docs.handsontable.com/pro/bower_components/handsontable-pro/dist/handsontable.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {

  var
    example = document.getElementById('bridgecubes'),
    hot;

  var headers = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "Pink", 'Brown'];
  var myData = [
    [5, 10, 3, 5, 2, 3, 5, 1],
    [9, 9, 3, 10, 8, 7, 7, 2],
    [5, 1, 10, 6, 7, 9, 4, 8]
  ];
  var colheaders = ['nameone', 'nametwo', 'namethree']

  hot = new Handsontable(example, {
    data: myData,
    rowHeaders: colheaders,
    colHeaders: headers,
    colWidths: 88,
    maxCols: 10,
    fillHandle: {
      autoInsertRow: false,
    }
  });

  hot.updateSettings({
    afterChange: function(changes, src) {
      myChart.update()
    }
  })


  var options = {
    type: 'bar',
    data: {
      labels: headers,
      datasets: [{
        label: colheaders[0],
        data: myData[0],
        borderWidth: 1,
        backgroundColor: 'rgb(255, 236, 217)'
      }, {
        label: colheaders[1],
        data: myData[1],
        borderWidth: 1,
        backgroundColor: 'rgb(235, 224, 255)'
      }, {
        label: colheaders[2],
        data: myData[2],
        borderWidth: 1,
        backgroundColor: 'rgb(219, 242, 242)'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            reverse: false
          }
        }]
      }
    }
  }

  var ctx = document.querySelector('.chartJSContainer').getContext('2d');
  var myChart = new Chart(ctx, options);
});


</script>
</body>
</html>
