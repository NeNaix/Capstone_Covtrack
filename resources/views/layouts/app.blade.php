<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title id="customt">{{ config('app.name', 'Covtrakc:Taguig Covid-19 Mapping') }}</title>
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{url('asset/fontawesome/css/all.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/css/adminlte.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{url('asset/css/style.css')}}">
    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_6LdSJz8eAAAAAB_qVqfkbSRrt0v2l8csgYvJx2LD"></script>
    
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<style type="text/css">
   #timeline{height:600px !important}
   .card-body #addbut{
  position: absolute;
  left: 20px;
  width: 150px;

    }
   .time-frame {
    background-color: #000000;
    color: #ffffff;
    width: 350px;
    font-family: Arial;
   }

   .time-frame > div {
       width: 100%;
       text-align: center;
   }

   #date-part {
       font-size: 1.2em;
   }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="content">
      <nav class="navbar navbar-expand-lg" style="background-color: maroon;">
         <ul class="navbar-nav">
            <li class="nav-item" style="padding-left: 10px;">
               <a  href="{{url('/')}}" style="color: white;"><h3>Covtrack</h3></a>
            </li>
            <li class="nav-item" style="padding-left: 10px;">
            @auth
               @if(Auth::user()->type == "hospital")
                  <a  href="{{route('barangay_user')}}" style="color: black;"><h3>Home</h3></a>
               @elseif(auth()->user()->type == "brgy")
                  <a  href="{{route('hospital_user')}}" style="color: black;"><h3>Home</h3></a>
               @else

               @endif
            @else
                       
            @endauth
            </li>
            
         </ul>
         <ul class="navbar-nav ml-auto" style="padding-right:20px;">
            <li class="nav-item">

               @if (Route::has('login'))
                
                    @auth
    
                     @if(auth()->user()->type == "admin")
                        <a href="{{ route('logout') }}" style="color:white;">{{ __('Logout') }}</a>
                       @elseif(auth()->user()->type == "brgy")
                       <div class="dropdown">
                                <a id="navbarDropdown" style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >
                                    <a class="dropdown-item" href="{{route('setting_b',Auth::user()->id)}}" align="center">
                                       <i class="fa fa-cog" style="color:black;"></i>     {{ __('Setting') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}" align="center" >
                                      <i class="fa fa-share" aria-hidden="true" style="color:black;"></i>     {{ __('Logout') }}
                                    </a>
                                 </div>

                            </div>        
                             
                            
                       @elseif(auth()->user()->type == "hospital")
                       <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('setting_h',Auth::user()->id)}}">
                                       <i class="fa fa-cog" style="color:black;" ></i>  {{ __('Setting') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                      <i class="fa fa-share" style="color:black;" aria-hidden="true"></i>  {{ __('Logout') }}
                                    </a>

                                    
                                </div>
                            </li>
                       @endif
                    @else
                       
                    @endauth
                
            @endif

            </li>
         </ul>
      </nav>
      <div class="content" style="padding-top:1px;">
            @auth
                  <div class="container-fluid">
  
         
      </div>
   </div>

            @else
                       
            @endauth
         <section class="content" style="padding-top: 5px;" align="center">
               <div class="container-fluid" align="center">

                @yield('content')
               </div>
         </section>
      </div>
   </div>
   <!-- jQuery -->

 <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }
       var interval = setInterval(function() {
        var momentNow = moment();

        $('#date-part').html(momentNow.format('dddd')
                              +' ' + momentNow.format('DD MMMM YYYY') +'  - '+momentNow.format('hh:mm:ss A'));
    }, 100);
  </script>
  
</body>

</html>
