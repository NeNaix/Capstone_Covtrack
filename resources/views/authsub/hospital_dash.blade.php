@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
         <!-- /.login-logo -->
       <div class="col-lg-12" style="color:black;padding-left:5%;padding-right:5%;">
         <div class="card card-outline" >
            <div class="card-body">
         <div class="panel panel-default">
          <div class="panel-heading">
          <input type="hidden" id="h_id" name="h_id" value="{{Auth::user()->assigned}}">
               <h2 id="h_title"></h2>
          </div>
          <div class="panel-body">
            <table class="table profile_table">
             
            </table>
            <div align="center"><button class="btn btn-primary" data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData">Update Occupied Beds</button></div>
          </div>
        </div>
               
            </div>
            <!-- /.card-body -->
         </div>
      </div>
         <!-- /.card -->
      </div>
</div>

<form action="" method="POST" class="covid-update-record-model">
      <div id="update-modal" class="modal animated rubberBand update-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
               <div class="modal-body text-center">
                     <div class="card-header">
                                 <h2><span class="fa fa-user"></span>Update Occupied Beds</h2>
                              </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12" align="center">
                             
                              <div id="update_content">
                              
                           
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-primary updatebeds">Save</button>
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Close</a>
                        
                     </div>
                  
               </div>
            </div>
         </div>
      </div>
</div>
</form>


   <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-request@3.0.0/dist/umd/request.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-geocoding@3.0.0/dist/umd/geocoding.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-auth@3.0.0/dist/umd/auth.umd.js"></script>

   <script src="{{ url('asset/jquery/jquery.min.js') }}" ></script>
   <script src="{{ url('asset/js/bootstrap.bundle.min.js') }}" ></script>
    
   <script src="{{ url('asset/js/adminlte.js') }}" ></script>
   <script src="{{ url('asset/js/chart.js') }}" ></script>
   <script src="{{ url('asset/tables/datatables/jquery.dataTables.min.js') }}" ></script>
   <script src="{{ url('asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" ></script>
   <script src="{{ url('js/hospital/user_hospital.js') }}" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
   <script type="text/javascript">
      var validationCovid = $('#add').validate({
                 rules: {
                   name: { required:true, minlength:3 },
                   age: { required:true},
                }
            });
    validationCovid.form()
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-full-width",
    "preventDuplicates": false,
    "showDuration": "300",
    "hideDuration": "2000",
    "timeOut": "180000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  
  var timer = window.setInterval(function(){
        toastr.info('The process has been saved.', 'Notification');
  // }, 30000);
  }, 600000);

});
   </script>
@endsection
