@extends('layouts.dash')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="row justify-content-center">
    {{-- data-toggle="modal" data-target="#data" --}}

     <div class="col-sm-3" style="color:black" id="ttal">
        <div class="card" align="center"> <h7>Taguig Total Confirmed Cases</h7><h1 id="aa"></h1></div>
    </div>
     <div class="col-sm-2" style="color:darkred" data="Active">
        <div class="card" align="center"> <h7>Taguig Total Active Cases <i class="fa fa-table" aria-hidden="true"></i></h7><h1 id="b"></h1></div>
    </div>
    
    <div class="col-sm-2" style="color:darkgreen" data="Recovered">
        <div class="card" align="center"> <h7>Taguig Total Recovered <i class="fa fa-table" aria-hidden="true"></i></h7><h1 id="c"></h1></div>
    </div>
    <div class="col-sm-2" style="color:black;" data="Deceased">
        <div class="card" align="center"> <h7>Taguig Total Deceased </h7><h1 id="d"></h1></div>
    </div>
   

    <div class="col-sm-3" style="color:darkred">
        <div class="card" align="center"> <h7>Taguig Case Fatality Rate ( % )</h7><h1 id="bb"></h1></div>
    </div>

    
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ana1" role="tab" aria-controls="home" aria-selected="true" style="color:black">Taguig Covid-19 Timeline</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ana2" role="tab" aria-controls="profile" aria-selected="false" style="color:black">Baragay Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#ana3" role="tab" aria-controls="profile" aria-selected="false" style="color:black">Case Age Range</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#ana4" role="tab" aria-controls="profile" aria-selected="false" style="color:black">Facilities</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#ana5" role="tab" aria-controls="profile" aria-selected="false" style="color:black">Gender Case</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#repo" role="tab" aria-controls="profile" aria-selected="false" style="color:black">Report</a>
              </li>

            </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="home-tab" id="ana1">
            <div class="row justify-content-center">
                <div class="col-lg-12" id="tlm"><canvas id="timeline"></canvas></div>
            </div>
          </div>
          <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab" id="ana2">
              <div class="row justify-content-center">
                <div class="col-lg-6" id="brgy"><canvas id="brgy_canva"></canvas></div>
                <div class="col-lg-6" id="d_bar"><canvas id="donut_brgy"></canvas></div>
                
            </div>
          </div>
          <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab1" id="ana3">
              <div class="row justify-content-center">
                <div class="col-lg-12" id="range_bar"><canvas id="age_range_barchart"></canvas></div>
            </div>
          </div>
          <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab1" id="ana4">
              <div class="row justify-content-center">
                <div class="col-lg-12" id="facilities"><canvas id="canvas"></canvas></div>
            </div>
          </div>
          <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab1" id="ana5">
              <div class="row justify-content-center">
                <div class="col-lg-12" id="total"><canvas id="canvas1"></canvas></div>
            </div>
          </div>
          <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab1" id="repo">
              <div class="row justify-content-center">
               
                <div class="col-lg-4" data="1" align="center"><button class="btn btn-primary">Daily</button> </div>
                <div class="col-lg-4" data="7" align="center"><button class="btn btn-primary">Weekly</button> </div>
                <div class="col-lg-4" data="m" align="center"><button class="btn btn-primary">Monthly</button> </div>
                <div class="col-lg-12" >
                    <table class="table table-striped table-bordered responsive" id="table_pagination_repo">
                            <thead>
                                <tr align="center">
                                    <th width="10%">Case</th>
                                    <th width="25%">Full name</th>
                                    <th width="5%">gender</th>
                                    <th width="5%">Age</th>
                                    <th width="25%">Barangay</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Confirmed case date</th>
                                    <th width="10%">updated_at</th>
                                </tr>
                            </thead>
                            <tbody id="covid_repo" align="center">
                                

                            </tbody>
                    </table>
 <caption>Data Retrieved : {{date('F. j, Y')}}</caption>

                </div>

            </div>
          </div>
          {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> --}}
                </div>
            </div>
        </div>
    </div>
    
{{--     <div class="col-lg-12">
            <div class="card">
                <div class="card-header" align="center">Taguig Covid Case Timeline</div>
                <div class="card-body" id="tlm">
                   
             </div>
            </div>
    </div> --}}
{{--     <div class="col-lg-12">
        <div class="card">
            <div class="card-header" align="center">Barangay's Bar chart Data</div>
            <div class="card-body" id="brgy">
                
         </div>
        </div>
     </div> --}}

    {{-- 2nd line --}}
{{--         <div class="col-lg-6">
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
     </div> --}}
{{--       <div class="col-lg-6">
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
     </div> --}}

    
{{--       <div class="col-lg-9">
            <div class="card">
            <canvas id="canvas3" height="280" width="600"></canvas>
         </div>
     </div>
      <div class="col-sm-3">
        
     </div>  --}}

</div>

<div id="data" data-backdrop="static" data-keyboard="false" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Total </h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered responsive" id="table_pagination">
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
                            <tbody id="covid_data" align="center">
                                

                            </tbody>
                    </table>
 <caption>Data Retrieved : {{date('F. j, Y')}}</caption>

                </div>

            </div>
        </div>
    </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- jQuery -->
   <script type="module" src="https://www.gstatic.com/firebasejs/7.15.0/firebase.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-request@3.0.0/dist/umd/request.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-geocoding@3.0.0/dist/umd/geocoding.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-auth@3.0.0/dist/umd/auth.umd.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
   <script src="{{ url('asset/jquery/jquery.min.js') }}" ></script>
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
   <script src="{{ url('js/stats.js') }}" ></script>
@endsection