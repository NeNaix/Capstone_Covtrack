
@extends('layouts.dash')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="row justify-content-center">
     
     <div class="col-sm-12" >
        <div class="card">
        <div class="card-body">
            <div class="card-header" align="center">
                                 <h4><i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i>Barangay Covid Cases</h4>
                              </div>
          <table class="table table-striped table-bordered responsive" id="table_pagination">
                            <thead>
                            <tr align="center">
                            <th style="color:black" width="25%">Barangay</th>
                            <th >Active Cases</th>
                            <th>Recovered</th>
                            <th>Deceased</th>
                            <th>mortality rate</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total Confirmed Cases</th>
                            </tr>
                            </thead>
                            <tbody id="count_brgy" align="center">
                                
                            </tbody>
                      
                    </table>
                </div>
    </div></div>

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
                                </tr>
                            </thead>
                            <tbody id="covid_data" align="center">
                                

                            </tbody>
                    </table>
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
   <script src="https://www.gstatic.com/firebasejs/7.15.0/firebase.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

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
   <script src="{{ url('js/brgy.js') }}" ></script>

@endsection