@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="container-fluid">
    <div class="row justify-content-center">
         <!-- /.login-logo -->
       <div class="col-lg-12" style="color:black">
         <div class="card card-outline">
            <div class="card-header">
               <input type="hidden" id="brgy" name="brgy" value="{{Auth::user()->assigned}}">
               <div class="col-sm-1" >
             <div class='time-frame'><div id='date-part'></div></div>
         </div>
               <h2><img src="{{url('asset/img/covid.png')}}" alt="DSMS Logo" width="75">COVTRACT : Brgy. {{ Auth::user()->assigned }}</h2>
               
            </div>
            <div class="card-body">
            <ul class="nav nav-tabs">
             <li class="active"><a data-toggle="tab" href="#home">Dashboard</a></li>
             <li><a data-toggle="tab" href="#menu1">Covid-19 Brgy. {{ Auth::user()->assigned }}</a></li>

           </ul>
           <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="card-body" id="tlm">
                    <canvas id="timeline"></canvas>
             </div>
            </div>

             
           <div id="menu1" class="tab-pane fade">
            <br>
            <button type="button" id="addbut" class="btn btn-primary" data-toggle="modal" data-target="#add">Add Covid data</button>
                  <br><br>
                        

                        <table class="table table-striped table-bordered responsive" id="table_pagination">
                            <thead>
                                <tr align="center">
                                    <th width="15%">Case</th>
                                    <th width="25%">Full name</th>
                                    <th width="5%">gender</th>
                                    <th width="5%">Age</th>
                                    <th width="25%">Barangay</th>
                                    <th width="10%">Status</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="covid_data" align="center">
                                

                            </tbody>

                    </table>
                    <caption>Data Retrieved : {{date('F. j, Y')}}</caption>
               </div>
       
            </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>
         <!-- /.card -->
      </div>
</div>
<form action="" method="POST" class="covid-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- create --}}
<form action="" method="POST" class="covid-add-record-model">
      <div id="add" class="modal animated rubberBand delete-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <form>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card-header">
                                 <h2><span class="fa fa-user"></span>Covid Data Information</h2>
                              </div>
                              <div class="row">
                                 <div class="col-md-8">
                                    <div class="form-group">
                                       <label>Full name</label>
                                       <input id="name" name="name" type="text" class="form-control elevation-2" placeholder="Full name">
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Age</label>
                                       <input id="age" name="age" type="number" min="1" max="120"class="form-control elevation-2" placeholder="Age">
                                    </div>
                                 </div>
                                <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Gender</label>
                                       <select id="gender" name="gender" class="form-control elevation-2">
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="float-left">Barangay</label>
                                    <select id="barangay" name="barangay" class="form-control elevation-2">
                                       <option value="{{Auth::user()->assigned}}" selected>{{Auth::user()->assigned}}</option>
                                    </select>
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Status</label>
                                       <select id="status" name="status" class="form-control elevation-2">
                                          <option value="Active">Active</option>
                                          <option value="Recovered">Recovered</option>
                                          <option value="Deceased">Deceased</option>
                                       </select>
                                    </div>
                                 </div>
                           
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-primary addcovid">Save</button>
                        <a href="#" data-dismiss="modal" class="btn btn-danger">Close</a>
                        
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
</form>
{{-- update --}}
<form action="" method="POST" class="covid-update-record-model">
      <div id="update-modal" class="modal animated rubberBand update-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-body text-center">
                  
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card-header">
                                 <h2><span class="fa fa-user"></span>Covid Data Information</h2>
                              </div>
                              <div class="row" id="update_content">
                              
                           
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <button type="submit" data-dismiss="modal" class="btn btn-primary updatecovid">Save</button>
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
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script type="text/javascript">
      var validationCovid = $('#add').validate({
                 rules: {
                   name: { required:true, minlength:3 },
                   age: { required:true},
                }
            });
    validationCovid.form()
   </script>
   <script src="{{ url('js/barangay/user_barangay.js') }}" ></script>
@endsection
