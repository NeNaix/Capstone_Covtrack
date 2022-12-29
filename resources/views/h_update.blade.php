@extends('layouts.dash')

@section('content')

    <div class="row justify-content-center" style="padding-bottom: 10%;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" align="center">{{ __('Update Hospital') }}</div>
                <form method="POST" id="uphospi" class="users-update-record-model">
                <div class="card-body" id="updateBody">
              {{--       <div id="basemaps-wrapper" align="center">
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
                    <div align="center"><div id="map" style="max-width: 100%; border-style: solid;width: 1000px;height: 600px;"></div></div>
                       
                 </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><a href="{{route('hospital')}}">Back</a></button>
                        <button type="button" class="btn btn-primary updateCustomer">Update</button>
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
   <script src="{{ url('js/update_hospital.js') }}" ></script>

@endsection