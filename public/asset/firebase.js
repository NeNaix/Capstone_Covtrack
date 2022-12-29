var  firebaseConfig = {
              apiKey: "AIzaSyCmW6-mhuYpZ71In_A-z-fwDUGINL7VupY",
              authDomain: "covtract.firebaseapp.com",
              databaseURL: "https://covtract-default-rtdb.asia-southeast1.firebasedatabase.app/",
              projectId: "covtract",
              storageBucket: "covtract.appspot.com",
              messagingSenderId: "432111250138",
              appId: "1:432111250138:web:88e7e5aacfd69bdeccd3e3",
              measurementId: "G-X1LL38CW54"
        };
firebase.initializeApp(firebaseConfig);
mapboxgl.accessToken = 'pk.eyJ1Ijoic2V0aDE1MyIsImEiOiJja3R4NTgzd3cwZGYyMm5xaGUxc3VxYW95In0.shbWxVbmet5A96TlNVzBOQ';
const apiKey = "AAPK1da567acb2764009a071005d3f493cd1QAkJyWU_loGOkkvaVJm_MPiqMX-9mbKqWie8bKfI4qgLOZe8wT10sEaeDS5NLv8N";
const basemapEnum = "ArcGIS:DarkGray";
const marker = new mapboxgl.Marker();
const map = new mapboxgl.Map({
        container: 'map', // container id
        style: `https://basemaps-api.arcgis.com/arcgis/rest/services/styles/${basemapEnum}?type=style&token=${apiKey}`,
        center: [121.05354831199543, 14.495977031084877], // starting position
        zoom: 12 // starting zoom
    });
// for switch map
const baseUrl = "https://basemaps-api.arcgis.com/arcgis/rest/services/styles";
const url = (name) => `${baseUrl}/${name}?type=style&token=${apiKey}`;
const setBasemap = (name) => {
        map.setStyle(url(name));
    };setBasemap("ArcGIS:DarkGray");
    
// const basemapsSelectElement = document.querySelector("#basemaps");
// basemapsSelectElement.addEventListener("change", (e) => {
//      setBasemap(e.target.value);
//    });

   map.on('load', function(e) {
          map.resize();
          
    });

    map.on('click', (e) => {
          document.getElementById('lon').value = JSON.stringify(e.lngLat['lng']);
          document.getElementById('lat').value =  JSON.stringify(e.lngLat['lat']);


          const coords = e.lngLat.toArray();

         const authentication = new arcgisRest.ApiKey({
                 key: apiKey
               });

               arcgisRest.reverseGeocode(coords, {
                   authentication
                 })
                 .then((result) => {
                  const lngLat = [result.location.x, result.location.y];
                  document.getElementById('h_addr').value = result.address.LongLabel;
                  const label = `${result.address.LongLabel}<br>${JSON.stringify(e.lngLat['lat'])}, ${JSON.stringify(e.lngLat['lng'])}`;
                  new mapboxgl
                     .Popup()
                     .setLngLat(lngLat)
                     .setHTML(label)
                     .addTo(map);

                }).catch((error) => {
                alert("There was a problem using the reverse geocode service. See the console for details.");
                console.error(error);
        });
          
    });

    var database = firebase.database();

    var lastIndex = 0;
$(document).ready(function() {
   
   firebase.database().ref('hospitals/').on('value', function (snapshot) {
        var value = snapshot.val();

        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                <td>' + value.h_name + '</td>\
                <td>' + value.h_addr + '</td>\
                <td>' + value.h_email +"<br/>  "+ value.h_contact + '</td>\
                <td align="center">' + value.h_capacity + '</td>\
                <td> Lon:' + value.h_lon+"<br/> Lat:"+ value.h_lat + '</td>\
                <td align="center"><a href="/update/hospital?id=' + index + '&update=hospital"><button class="btn btn-info" data-id="' + index + '">Update</button></a>\
                <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
            </tr>');
            }
            lastIndex = index;
        });
        $('.sample').html("refresh "+ lastIndex );
        $('#hopital_data').html(htmls);
    
        $('#table_pagination').DataTable();

        $('#submitUser').removeClass('desabled');
    });

    
          
   
});
    // Get Data
    


    // Add Data
    $('#submitHospital').on('click', function (e) {
        e.preventDefault();
        var values = $("#addHospital").serializeArray();
        console.log(values);
        var h_name = values[0].value;
        var h_addr = values[1].value;
        var h_contact = values[2].value;
        var h_email = values[3].value;
        var h_capacity = values[4].value;
        var h_lon = values[5].value;
        var h_lat = values[6].value;
        var HospitalID = lastIndex + 1;

       

        firebase.database().ref('hospitals/' + HospitalID).set({
            h_name: h_name,
            h_addr: h_addr,
            h_contact: parseInt(h_contact),
            h_email: h_email,
            h_capacity: h_capacity,
            h_lon: parseFloat(h_lon),
            h_lat: parseFloat(h_lat),
        });

        // Reassign lastID value
        lastIndex = HospitalID;
        $("#addHospital input").val("");
        window.location.href = '/home';

    });


    // Update Data
    var updateID = 0;

    $('.updateCustomer').on('click', function (e) {
        e.preventDefault();
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            h_name: values[0].value,
            h_addr: values[1].value,
            h_contact: parseInt(values[2].value),
            h_email: values[3].value,
            h_capacity: values[4].value,
            h_lon: parseFloat(values[5].value),
            h_lat: parseFloat(values[6].value),
        };

        var updates = {};
        updates['/hospitals/' + updateID] = postData;

        firebase.database().ref().update(updates);
        
        window.location.href = '/home';
    });

    // Remove Data
    $("body").on('click', '.removeData', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('body').find('.hospital-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function (e) {
        e.preventDefault();
        var values = $(".hospital-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('hospitals/' + id).remove();
        $('body').find('.hospital-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
       
    });

    $('.remove-data-from-delete-form').click(function (e) {
        e.preventDefault();
        $('body').find('.hospital-remove-record-model').find("input").remove();
    });

    let searchParams = new URLSearchParams(window.location.search)
    if (searchParams.has('update') && searchParams.get('update') == "hospital" ) {
        var id_up_hos = searchParams.get('id');
        updateID = id_up_hos;
        firebase.database().ref('hospitals/' + id_up_hos).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '\
            <div class="form-group">\
                <label for="h_e_name" class="col-md-12 col-form-label">Hospital Name</label>\
                <div class="col-md-12">\
                    <input id="h_e_name" type="text" class="form-control" name="h_e_name" value="' + values.h_name + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="h_addr" class="col-md-12 col-form-label">Hospital Address</label>\
                <div class="col-md-12">\
                    <input id="h_addr" type="text" class="form-control" name="h_addr" value="' + values.h_addr + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="h_e_contact" class="col-md-12 col-form-label">Hospital Contact</label>\
                <div class="col-md-12">\
                    <input id="h_e_contact" type="text" class="form-control" name="h_e_contact" value="' + values.h_contact + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="h_e_email" class="col-md-12 col-form-label">Hospital Email</label>\
                <div class="col-md-12">\
                    <input id="h_e_email" type="email" class="form-control" name="h_e_email" value="' + values.h_email + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="h_e_cap" class="col-md-12 col-form-label">Hospital Bed Capacity</label>\
                <div class="col-md-12">\
                    <input id="h_e_cap" type="number" class="form-control" name="h_e_cap" value="' + values.h_capacity + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="lon" class="col-md-12 col-form-label">Longitude</label>\
                <div class="col-md-12">\
                    <input id="lon" type="text" class="form-control" name="lon" value="' + values.h_lon + '" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="lat" class="col-md-12 col-form-label">Latitude</label>\
                <div class="col-md-12">\
                    <input id="lat" type="text" class="form-control" name="lat" value="' + values.h_lat + '" required autofocus>\
                </div>\
            </div>\
            ';

            const marker1 = new mapboxgl.Marker({ color: 'red' })
            .setLngLat([values.h_lon, values.h_lat])
            .addTo(map);
             $('#updateBody').append(updateData);
        });

        

    }
