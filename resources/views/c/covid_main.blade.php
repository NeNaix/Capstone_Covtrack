@extends('layouts.dash')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.css">


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header" align="center">{{ __('Hostpital Beds Realtime Data') }}</div> --}}

                <div class="card-body">
                    <h5 align="center">Covid Data</h5>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addhere">Add Covid data</button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#show_rangr">Covid Cases Date Range <span class="fa fa-calendar"></span></button>
                        <br>
                        <br>
                         
           
                      
                        

                        <table class="table table-striped table-bordered responsive display" id="table_pagination">
                            <thead>
                                <tr align="center">
                                    <th width="15%">Case</th>
                                    <th width="25%">Full name</th>
                                    <th width="5%">gender</th>
                                    <th width="5%">Age</th>
                                    <th width="25%">Barangay</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">created_at</th>
                                    <th width="10%">updated_at</th>
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
    </div>

<div id="show_rangr" data-backdrop="static" data-keyboard="false" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog modal-xl" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Covid Cases Date Range </h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-daterange"> <input type="text" id="start" class="form-control text-left mr-2"> <label class="ml-3 form-control-placeholder" id="start-p" for="start">Start Date</label> <span class="fa fa-calendar" id="fa-1"></span> <input type="text" id="end" class="form-control text-left ml-2"> <label class="ml-3 form-control-placeholder" id="end-p" for="end">End Date</label> <span class="fa fa-calendar" id="fa-2"></span></div>
                    <br>
                    <table class="table table-striped table-bordered responsive" id="table_pagination3">
                            <thead>
                                <tr align="center">
                                    <th width="15%">Case</th>
                                    <th width="25%">Full name</th>
                                    <th width="5%">gender</th>
                                    <th width="5%">Age</th>
                                    <th width="25%">Barangay</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">created_at</th>
                                    <th width="10%">updated_at</th>
                                </tr>
                            </thead>
                            <tbody id="covid_data3" align="center">
                                

                            </tbody>
                    </table>
 <caption>Data Retrieved : {{date('F. j, Y')}}</caption>

                </div>

            </div>
        </div>
    </div>



<!-- Delete Model -->
<form action="" method="POST" class="covid-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
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
 <form id="addcovid_v" method="POST" class="covid-add-record-model">
      <div id="addhere" data-keyboard="false" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-body text-center">
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
                                       <input id="name" name="name" type="text" class="form-control elevation-2" placeholder="Full name" required/>
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Age</label>
                                       <input id="age" name="age" type="number" min="1" max="120"class="form-control elevation-2" placeholder="Age" required/>
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
                                        <option value="Bagumbayan">Bagumbayan</option>
                                        <option value="Bambang">Bambang</option>
                                        <option value="Calzada">Calzada</option>
                                        <option value="Central Bicutan">Central Bicutan</option>
                                        <option value="Central Signal Village">Central Signal Village</option>
                                        <option value="Fort Bonifacio">Fort Bonifacio</option>
                                        <option value="Hagonoy">Hagonoy</option>
                                        <option value="Ibayo-Tipas">Ibayo-Tipas</option>
                                        <option value="Katuparan">Katuparan</option>
                                        <option value="Ligid-Tipas">Ligid-Tipas</option>
                                        <option value="Lower Bicutan">Lower Bicutan</option>
                                        <option value="Maharlika Village">Maharlika Village</option>
                                        <option value="Napindan">Napindan</option>
                                        <option value="New Lower Bicutan">New Lower Bicutan</option>
                                        <option value="North Daang Hari">North Daang Hari</option>
                                        <option value="North Signal Village">North Signal Village</option>
                                        <option value="Palingon">Palingon</option>
                                        <option value="Pinagsama">Pinagsama</option>
                                        <option value="San Miguel">San Miguel</option>
                                        <option value="Santa Ana">Santa Ana</option>
                                        <option value="South Daang Hari">South Daang Hari</option>
                                        <option value="South Signal Village">South Signal Village</option>
                                        <option value="Tanyag">Tanyag</option>
                                        <option value="Tuktukan">Tuktukan</option>
                                        <option value="Upper Bicutan">Upper Bicutan</option>
                                        <option value="Ususan">Ususan</option>
                                        <option value="Wawa">Wawa</option>
                                        <option value="Western Bicutan">Western Bicutan</option>
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
               </div>
            </div>
         </div>
      </div>
</form>
      
{{-- update --}}
<form id="addcovid_u" method="POST" class="covid-update-record-model">
      <div id="update-modal" class="modal fade rubberBand update-modal" tabindex="-1" role="dialog">
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
</form>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- jQuery -->

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>

    <script src="{{ url('js/covid/covid_data.js') }}" ></script>
       


</body>
@endsection

