<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title id="customt">{{ config('app.name', 'Covtrakc:Taguig Covid-19 Mapping') }}</title>
   <!-- Font Awesome -->
   <!-- Styles -->
   <link rel="stylesheet" href="{{url('asset/fontawesome/css/all.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/css/adminlte.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
   
   <link rel="stylesheet" href="{{url('css/map.css')}}">
   <link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
   <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
   <!-- Load the `mapbox-gl-geocoder` plugin. -->
   <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
   <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
   <script src="https://www.google.com/recaptcha/api.js"></script>
{{-- datepicker --}}


   <style type="text/css">
   .time-frame {
    background-color: #000000;
    color: #ffffff;
    width: 350px;
    font-family: Arial;
   }

   .mapboxgl-popup {
   max-width: 350px !important;
   }

   .time-frame > div {
       width: 100%;
       text-align: center;
   }

   #date-part {
       font-size: 1.2em;
   }
   #timeline{height:600px !important;}
   #brgy_canva{height:600px !important;}

   #canvas{height:600px !important;}
   #canvas1{height:600px !important;}
   #age_range_barchart{height:600px !important;}

   #d_bar{height:600px !important;}
   #donut_brgy{height:600px !important;}
   .legend { list-style: none; }
   .legend li { float: left; padding-left: 15px; }
   .legend span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
   /* your colors */
   .legend .green { background-color: green; }
   .legend .yellow { background-color: yellow; }
   .legend .orange { background-color: orange; }
   .legend .red { background-color: red; }
   .legend .maroon { background-color: maroon; }
   .legend .purple { background-color: #800080; }
   .legend .black { background-color: black; }


   input {  border: 1px solid black; }
   input:focus { border: 1px solid black; }
   input.error { border: 1px solid red; } 
   .error {
      color: maroon;
      align-items: center;
   }
   .filter-group {
      font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
      font-weight: 600;
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1;
      border-radius: 3px;
      width: 120px;
      color: #fff;
   }

   #filter-group input{
      background-color: maroon;
   }
   a{
         color: white;

   }

   td a.btn{
         font-size: 0.7rem;
      }

   td p{
         padding-left: 0.5rem !important;
      }

   th{
         padding: 1rem !important;
      }

   table tr td {
         padding: 0.3rem !important;
         font-size: 13px;
      }
      table tr td p{
         margin-top: -0.2rem !important;
         margin-bottom: -0.2rem !important;
         font-size: 0.9rem;
      }
      td a.btn{
         font-size: 0.7rem;
      }  
   #map {
         top:0;
         bottom:0;
         width:100%;
         transition: all 0.3s; 
      }
   #basemaps-wrapper {

        background: rgba(255, 255, 255, 0);
      }
   #basemaps {
        font-size: 16px;
        padding: 4px 8px;
      }

   </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-light elevation-1" style="background-color: maroon;">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="#" role="button"class="g-recaptcha" 
        data-sitekey="reCAPTCHA_site_key" 
        data-callback='onSubmit' 
        data-action='submit'>
                  <img src="{{url('asset/img/avatar.png')}}" class="img-circle " alt="User Image" width="30">
               </a>
            </li>
            <li class="nav-item">
                     @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('setting_admin',Auth::user()->id)}}">
                                       <i class="fa fa-cog"></i>  {{ __('Setting') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                      <i class="fa fa-share" aria-hidden="true"></i>  {{ __('Logout') }}
                                    </a>

                                    
                                </div>
                            </li>
                        @endguest
            </li>
         </ul>
      </nav>

      <aside class="main-sidebar sidebar-light-primary elevation-2 " >
         <!-- Brand Logo -->
         <a href="{{url('/home')}}" class="brand-link animated swing">
            <h2 align="center"><img src="{{url('asset/img/covid.png')}}" alt="DSMS Logo" width="65">COVTRACK</h2>
            <h5 align="center" >Taguig Covid-19 Mapping</h5>
         </a>

         <div class="sidebar">
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-header" style="background-color: maroon;color:#fff">ANALYTICS</li>
                  <li class="nav-item">
                     <a href="{{url('/stats')}}" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt fa-2x"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{url('/home')}}" class="nav-link">
                        <i class="nav-icon fa fa-map fa-2x"></i>
                        <p>
                           Data Mapping
                        </p>
                     </a>
                  </li>

               <li class="nav-header" style="background-color: maroon;color:#fff">DATA</li>
                  <li class="nav-item">
                     <a href="{{url('/covid')}}" class="nav-link">
                        <i class="nav-icon fa fa-user fa-2x"></i>
                        <p>
                           Covid-19
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{url('/brgy')}}" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt fa-2x"></i>
                        <p>
                           Barangay
                        </p>
                     </a>
                  </li>

                  <li class="nav-header" style="background-color: maroon;color:#fff">FACILITIES</li>
                  <li class="nav-item">
                     <a href="{{route('hospital')}}" class="nav-link">
                        <i class="nav-icon fa fa-ambulance fa-2x"></i>
                        <p>
                           Hospitals
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('quarantine')}}" class="nav-link">
                        <i class="nav-icon fa fa-hospital fa-2x"></i>
                        <p>
                           Quarantine
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('testing')}}" class="nav-link">
                        <i class="nav-icon fa fa-hospital fa-2x"></i>
                        <p>
                           Testing Facility
                        </p>
                     </a>
                  </li>
                  
             {{--      <li class="nav-item">
                     <a href="bed-report.html" class="nav-link">
                        <i class="nav-icon fa fa-bed"></i>
                        <p>
                           Bed Utilization 
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="oxygen-tank-report.html" class="nav-link">
                        <i class="nav-icon fa fa-procedures"></i>
                        <p>
                           Oxygen Tank 
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="medicine-report.html" class="nav-link">
                        <i class="nav-icon fa fa-pills"></i>
                        <p>
                           Medicine Used 
                        </p>
                     </a>
                  </li> --}}
               </ul>
            </nav>
         </div>
      </aside>
         <div class="content-wrapper">
            <div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
             <div class='time-frame'><div id='date-part'></div></div>
         </div>
      </div>
   </div>
</div>
            <section class="content">
               <div class="container-fluid">
                 
                @yield('content')
 <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
   var interval = setInterval(function() {
        var momentNow = moment();

        $('#date-part').html(momentNow.format('dddd')
                              +' ' + momentNow.format('DD MMMM YYYY') +'  - '+momentNow.format('hh:mm:ss A'));
    }, 100);
 </script>

</body>
</html>