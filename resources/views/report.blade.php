<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ config('app.name', 'Covtrakc:Taguig Covid-19 Mapping') }}</title>
   <!-- Font Awesome -->
   <!-- Styles -->
   <link rel="stylesheet" href="{{url('asset/fontawesome/css/all.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/css/adminlte.min.css')}}">
<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body style="align-content: center;">
    
<div class="container-fluid">
  <div class="row justify-content-center">
     <div class="col-sm-6" style="color:black">
        <div class="card" align="center"> <h7>Taguig Total Confirmed Cases</h7><h1 id="aa"></h1></div>
    </div>
    <div class="col-sm-6" style="color:darkred">
        <div class="card" align="center"> <h7>Taguig Case Fatality Rate ( % )</h7><h1 id="bb"></h1></div>
    </div>

    <div class="col-sm-4" style="color:darkred">
        <div class="card" align="center"> <h7>Taguig Total Active Cases</h7><h1 id="b"></h1></div>
    </div>
    <div class="col-sm-4" style="color:darkgreen">
        <div class="card" align="center"> <h7>Taguig Total Recovered</h7><h1 id="c"></h1></div>
    </div>
    <div class="col-sm-4" style="color:maroon;">
        <div class="card" align="center"> <h7>Taguig Total Deceased</h7><h1 id="d"></h1></div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">Age Range Infection Table</div>
            <div class="card-body" id="brgy">
                <canvas id="brgy_canva"></canvas>
         </div>
        </div>
     </div>

    {{-- 2nd line --}}
        <div class="col-lg-6">
            <div class="card" id="facilities">
            <canvas id="canvas" height="307" width="600"></canvas>
         </div>
     </div>

     <div class="col-lg-6">
        <div class="justify-content-center">
            <div class="card" id="total">
                <canvas id="canvas1" height="200" width="400"></canvas>
             </div>
         </div> 
     </div>
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body" id="range_bar">
                <canvas id="age_range_barchart" height="100" width="400"></canvas>
         </div>
        </div>
     </div>
      <div class="col-lg-6">
        <div class="card">
            <div class="card-body" id="d_bar">
                <canvas id="donut_brgy" height="100" width="400"></canvas>
         </div>
        </div>
     </div>

    
{{--       <div class="col-lg-9">
            <div class="card">
            <canvas id="canvas3" height="280" width="600"></canvas>
         </div>
     </div>
      <div class="col-sm-3">
        
     </div>  --}}

</div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
   <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
   <script src="{{ url('asset/jquery/jquery.min.js') }}" ></script>
   <script src="{{ url('asset/js/adminlte.js') }}" ></script>
   <script src="{{ url('asset/js/chart.js') }}" ></script>
   <script src="{{ url('js/stats.js') }}" ></script>

   <div align="center"><button onclick="window.print()">PRINT</button></div>
</body>
</html>