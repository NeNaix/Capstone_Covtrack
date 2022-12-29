@extends('layouts.dash')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div align="center" style="height: 100%;">
                        <div id="map" style="max-width: 100%;border-style: solid;width: 100%;height:800px;max-height: 1000px;">
                            
                            <nav id="filter-group" class="filter-group" style="width:150px;"></nav>

                        </div>


                </div>
                    
                 </div>
                    <div class="modal-footer" style="padding-right: 3%;">
                        
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
   <script src="{{ url('js/layer_data.js') }}" ></script>

@endsection
