<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>{{ config('app.name', 'Covtrakc:Taguig Covid-19 Mapping') }}</title>
<!--

TemplateMo 548 Training Studio

https://templatemo.com/tm-548-training-studio

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">Covtrack<em> Taguig</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            {{-- <li class="scroll-to-section"><a href="#features"></a></li> --}}
                            @auth
    
                             @if(auth()->user()->type == "admin")
                             <li class="main-button"><a href="{{ route('stats') }}" style="color:white;">{{ __('Dashboard') }}</a></li>
                               @elseif(auth()->user()->type == "hospital")
                               <li class="main-button"><a href="{{ route('hospital_user') }}" style="color:white;">{{ __(' Hospital Dashboard') }}</a></li>
                               @elseif(auth()->user()->type == "brgy")
                               <li class="main-button"><a href="{{ route('barangay_user') }}" style="color:white;">{{ __('Barangay Dashboard') }}</a></li>
                               @endif
                            @else
                                <li class="main-button"><a href="{{route('login')}}">Login</a></li>
                            @endauth
                           
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <img src="assets/images/bg.jpg" style="width: 100%;" alt="Taguig people">

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>stay at alert, stay safe</h6>
                <h2>wear <em>Facemask</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="https://drive.google.com/file/d/1aVoq1Xmj6fRAPdkmYE8wGcEefMqAXjwf/view?usp=sharing">Download Android App</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Features Item Start ***** -->
    <section class="section" id="features">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h1 style="font-weight:50px;"><b>B.I.D.A</b></h1>
                        <h2><em>Protect yourself and others around you by knowing the facts and taking appropriate precautions</em></h2>
                        
                    </div>
                </div>

                <div class="col-lg-12" align="center">
                    
                    <img src="https://doh.gov.ph/sites/default/files/B-Bawal-walang-mask.jpg" height="650" width="425">&nbsp;&nbsp;
                    <img src="https://doh.gov.ph/sites/default/files/I-isanitize-ang-mga-kamay.jpg" height="650" width="425">&nbsp;&nbsp;
                    <img src="https://doh.gov.ph/sites/default/files/D-dumistansya-ng-isang-metro.jpg" height="650" width="425">&nbsp;&nbsp;
                    <img src="https://doh.gov.ph/sites/default/files/A-alamin-ang-totoong-importmasyon.jpg" height="650" width="425">
                   
                </div>
               
            </div>
        </div>
    </section>
    <!-- ***** Features Item End ***** -->

    <section class="section" id="schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading dark-bg">
                       <h2>Covtrack : <em>Taguig Covid-19 Mapping</em> </h2>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>