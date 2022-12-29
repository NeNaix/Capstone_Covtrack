
@extends('layouts.dash')

@section('content')

    <div class="row justify-content-center" style="padding-bottom: 10%;">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" align="center">{{ __('New Hospital') }}</div>
                <form id="addHospital" method="POST" action="{{route('add_uh')}}">
                    @csrf
                    @method("POST")
                <div class="card-body" id="updateBody">
                    
                    <div class="form-group">
                            <label for="h_name" class="col-md-12 col-form-label">Hospital Name</label>
                            <div class="col-md-12">
                            <input id="h_name" type="text" class="form-control" name="h_name" placeholder="Hospital Name" required autofocus>
                            </div>
                    </div>
                     
                    <div class="form-group">
                            <label for="h_contact" class="col-md-12 col-form-label">Contact No.</label>
                            <div class="col-md-12">
                            <input id="h_contact" type="text" class="form-control" name="h_contact" placeholder="Contact No." required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="h_email" class="col-md-12 col-form-label">Email</label>
                            <div class="col-md-12">
                            <input id="h_email" type="text" class="form-control" name="h_email" placeholder="Hospital Email" required autofocus>
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="h_capacity" class="col-md-12 col-form-label">Bed Capacity</label>
                            <div class="col-md-12">
                            <input id="h_capacity" type="number" class="form-control" name="h_capacity" placeholder="Hospital capacity" required autofocus>
                            </div>
                    </div>
                    {{-- <div id="basemaps-wrapper" align="center">
                          <select id="basemaps">
                            <option value="ArcGIS:DarkGray">Dark gray</option>
                            <option value="ArcGIS:Streets">Streets</option>
                            <option value="ArcGIS:Navigation">Navigation</option>
                            <option value="ArcGIS:Topographic">Topographic</option>
                            <option value="ArcGIS:LightGray">Light Gray</option>
                            <option value="ArcGIS:StreetsRelief">Streets Relief</option>
                            <option value="ArcGIS:Imagery:Standard">Imagery</option>
                            <option value="ArcGIS:ChartedTerritory">ChartedTerritory</option>
                            <option value="ArcGIS:ColoredPencil">ColoredPencil</option>
                            <option value="ArcGIS:Nova">Nova</option>
                            <option value="ArcGIS:Midcentury">Midcentury</option>
                            <option value="OSM:Standard">OSM</option>
                            <option value="OSM:Streets">OSM:Streets</option>
                          </select>

                        </div> --}}
                    <div align="center">
                        <label for="lon" class="col-md-12 col-form-label">Click the location of the Facility to the map to Generate the Address and coordinates(lon & lat)</label>
                         
                        <div id="map" style="max-width: 100%;border-style: solid;width: 1000px;height: 600px;"></div>

                </div>
                <div class="form-group">
                            <div align="center" ><label class="col-md-12 col-form-label" style="font-weight:normal;">** If the given generated address is not accurate. please input the correct address **</label></div>
                            <label for="h_addr" class="col-md-12 col-form-label">Hospital Address</label>
                            <div class="col-md-12">
                            <input id="h_addr" type="text" class="form-control" name="h_addr" placeholder="Hospital Address" required autofocus>
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
                        <a href="{{route('hospital')}}"><button type="button" class="btn btn-primary  mb-2">Back</button></a>
                        <button type="submit" action="{{route('add_uh')}}" id="submitHospital" class="btn btn-primary mb-2">Add</button>
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

   <script src="{{ url('js/new_hospital.js') }}" ></script>
@endsection