@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="row justify-content-center">
     
<div class="col-sm-6">
    <form id="addHospital" method="POST" action="{{route('update_b',Auth::user()->id)}}">
                    @csrf
                    @method("POST")
    <div class="card">
        <div class="card-header" align="center">
            <h1><i class="fa fa-cog fa-spin fa-1x fa-fw"></i> Account Setting : {{Auth::user()->name}}</h1>
 
                @if(session('miss'))
                  <div class="alert alert-danger">
                      <i class="fas fa-info-circle"></i> {{ session('miss') }}
                  </div>
                @endif
                @if(session('success'))
                  <div class="alert alert-success">
                      <i class="fas fa-info-circle"></i> {{ session('success') }}
                  </div>
                @endif
        
        </div>
        <div class="card-body">
            @foreach($user as $a)

            <div class="form-group">
                            <label for="name" class="col-md-12 col-form-label">Name</label>
                            <div class="col-md-8">
                            <input id="name" type="text" value="{{$a->name}}" class="form-control" name="name" placeholder="Admin Name" required autofocus>
                            </div>
            </div>

            <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">Email Name</label>
                            <div class="col-md-8">
                            <input id="email" type="text" value="{{$a->email}}" class="form-control" name="email" placeholder="Admin Email">
                            </div>
            </div>
             <div class="form-group">
                            <label for="pass" class="col-md-12 col-form-label">New Password</label>
                            <div class="col-md-8">
                            <input id="pass" type="password" class="form-control" name="pass" placeholder="New Password"><input type="checkbox" onclick="myFunction()">Show Password
                            </div>
                            <label for="cpass" class="col-md-12 col-form-label">Confirm Password</label>
                            <div class="col-md-8">
                            <input id="cpass" type="password" class="form-control" name="cpass" placeholder="Confirm Password" ><input type="checkbox" onclick="myFunction1()">Show Password
                            </div>

                            
            </div>
                    
            @endforeach
                
        </div>
        <div class="card-footer" align="center">
            <a href="{{route('barangay_user')}}"><button type="button" class="btn btn-danger">cancel</button></a>
            <button type="submit" class="btn btn-primary">save</button>
        </div>
    </div>
        
         </form>
    </div>
   


      <!-- jQuery -->
   <script src="{{ url('asset/jquery/jquery.min.js') }}" ></script>
   <script src="{{ url('asset/js/bootstrap.bundle.min.js') }}" ></script>
    
   <script src="{{ url('asset/js/adminlte.js') }}" ></script>
   <script src="{{ url('asset/js/chart.js') }}" ></script>
   <script type="text/javascript">
       function myFunction() {
          var x = document.getElementById("pass");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        function myFunction1() {
          var x = document.getElementById("cpass");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
   </script>

@endsection