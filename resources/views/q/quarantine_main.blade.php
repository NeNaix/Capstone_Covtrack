@extends('layouts.dash')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" align="center"><h2>{{ __('Quarantine Table') }}</h2></div>
                @if(session('success'))
                  <div class="alert alert-success" id="alerts">
                      <i class="fas fa-info-circle"></i> {{ session('success') }}
                      <?php
                      session()->forget('success');
                                        ?>
                  </div>
                @endif
                <div class="card-body">
                        <button type="button" class="btn btn-primary"><a href="{{route('new_quarantine')}}" style="color:white">New Quarantine</a></button>
                        <br><br>
                        

                        <table class="table table-striped table-bordered responsive" id="table_pagination_q">
                            <thead>
                                <tr>
                                    <th width="20%">Quarantine Name</th>
                                    <th width="30%">Address</th>
                                    <th>Email & Contact Number</th>
                                    <th>Capacity</th>
                                    <th>Coordinates</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="quarantine_data">
                            
                                

                            </tbody>
                    </table>
                    <caption>Data Retrieved : {{date('F. j, Y')}}</caption>
                </div>
            </div>
        </div>
    </div>

<div id="map" style="display:none;"></div>


<!-- Delete Model -->
<form action="" method="POST" class="quarantine-remove-record-model">
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
</div>
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ url('js/quarantine/data_quarantine.js') }}" ></script>  


</body>
@endsection

