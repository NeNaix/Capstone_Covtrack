@extends('layouts.dash')

@section('content')

    <div class="row justify-content-center" style="padding-bottom: 10%;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" align="center">{{ __('New Quarantine') }}</div>
                <form id="addQuarantine" method="POST" class="Quarantine-remove-record-model">
                <div class="card-body" id="updateBody">
                    
                    <div class="form-group">
                            <label for="q_name" class="col-md-12 col-form-label">Quarantine Name</label>
                            <div class="col-md-12">
                            <input id="q_name" type="text" class="form-control" name="q_name" placeholder="Quarantine Name" required autofocus>
                            </div>
                    </div>

                    <div class="form-group">
                            <label for="q_contact" class="col-md-12 col-form-label">Contact No.</label>
                            <div class="col-md-12">
                            <input id="q_contact" type="text" class="form-control" name="q_contact" placeholder="Contact No." required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="q_email" class="col-md-12 col-form-label">Email</label>
                            <div class="col-md-12">
                            <input id="q_email" type="text" class="form-control" name="q_email" placeholder="Quarantine Email" required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="q_capacity" class="col-md-12 col-form-label">Capacity</label>
                            <div class="col-md-12">
                            <input id="q_capacity" type="number" class="form-control" name="q_capacity" placeholder="Quarantine capacity" required autofocus>
                            </div>
                    </div>

                    <div align="center">
                        <label for="lon" class="col-md-12 col-form-label">Click the location of the Facility to the map to Generate the Address and coordinates(lon & lat)</label>
                        <div id="map" style="max-width: 100%;border-style: solid;width: 1000px;height: 600px;"></div>

                </div>
                <div class="form-group">
                        <div align="center"><label style="size: 12px;font-weight:normal;">** If the given generated address is not accurate. please input the correct address **</label></div>
                            <label for="q_addr" class="col-md-12 col-form-label">Quarantine Address</label>
                            <div class="col-md-12">
                            <input id="q_addr" type="text" class="form-control" name="q_addr" placeholder="Quarantine Address" required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="lon" class="col-md-12 col-form-label">Longitude</label>
                            <div class="col-md-12">
                            <input id="lon" type="text" class="form-control" name="lon" placeholder="Longitue Coordinate" required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="lat" class="col-md-12 col-form-label">Latitude</label>
                            <div class="col-md-12">
                            <input id="lat" type="text" class="form-control" name="lat" placeholder="Latitude Coordinate" required autofocus>
                            </div>
                    </div>
                    <input type="hidden" id="latest_id" name="latest_id">
                    
                 </div>
                    <div class="modal-footer" style="padding-right: 3%;">
                        <a href="{{route('quarantine')}}"><button type="button" class="btn btn-primary  mb-2">Back</button></a>
                        <button type="button" id="submitQuarantine" class="btn btn-primary mb-2">Add</button>
                    </div>
                  </form>
                </div>
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
   <script src="https://unpkg.com/@esri/arcgis-rest-request@3.0.0/dist/umd/request.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-geocoding@3.0.0/dist/umd/geocoding.umd.js"></script>
   <script src="https://unpkg.com/@esri/arcgis-rest-auth@3.0.0/dist/umd/auth.umd.js"></script>
   <script src="{{ url('asset/jquery/jquery.min.js') }}" ></script>
   <script src="{{ url('asset/js/adminlte.js') }}" ></script>
   <script src="{{ url('asset/js/chart.js') }}" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
   <script src="{{ url('js/quarantine/new_quarantine.js') }}" ></script>
@endsection