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
        style: `mapbox://styles/seth153/ckz3ixk7i000014p9ca0knycp`,
        center: [121.05354831199543, 14.495977031084877], // starting position
        zoom: 12, // starting zoom
         maxBounds:[

                [120.942726, 14.431765], // Southwest coordinates 14.431765, 120.942726
                [121.174021, 14.610363] // Northeast coordinates 14.610363, 121.174021
            ]
    });
    
// const basemapsSelectElement = document.querySelector("#basemaps");
// basemapsSelectElement.addEventListener("change", (e) => {
//      setBasemap(e.target.value);
//    });

   map.on('load', function(e) {
          map.resize();
          
    });
   map.addControl(
    new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
         
        // Limit seach results to Australia.
        countries: 'ph',
         
        // Use a bounding box to further limit results
        // to the geographic bounds representing the
        // region of New South Wales.
        bbox: [120.942726, 14.431765, 121.174021, 14.610363],
         
        // Apply a client-side filter to further limit results
        // to those strictly within the New South Wales region.
        filter: function (item) {
        // returns true if item contains New South Wales region
        return item.context.some((i) => {
        // ID is in the form {index}.{id} per https://github.com/mapbox/carmen/blob/master/carmen-geojson.md
        // This example searches for the `region`
        // named `New South Wales`.
        return (
        i.id.split('.').shift() === 'region' &&
        i.text === 'Taguig'
        );
        });
        },
        mapboxgl: mapboxgl
    })
    );

    map.on('click','taguig-city', (e) => {
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

    var updateID = 0;
    var database = firebase.database();
    
    $('.updateCustomer').on('click', function (e) {
        e.preventDefault();
        var values = $(".users-update-record-model").serializeArray();

        firebase.database().ref('/hospitals/'+updateID).update({
            h_name: values[0].value,
            h_addr: values[1].value,
            h_contact: values[2].value,
            h_email: values[3].value,
            h_capacity: values[4].value,
            h_lon: parseFloat(values[5].value),
            h_lat: parseFloat(values[6].value),
        });
        
        window.location.href = '/hospital?stat=update';
    });

var validationhospitalup = $('#uphospi').validate({
                 rules: {
                    h_name: { required:true, minlength:3 },
                    h_addr: { required:true},
                    h_contact: { required:true, minlength:11 , maxlength:11},
                    h_email: { required:true, email:true},
                    h_capacity: { required:true},
                    h_lon: { required:true},
                    h_lat: { required:true},
                }
            });
validationhospitalup.form();
let searchParams = new URLSearchParams(window.location.search)
    if (searchParams.has('update') && searchParams.get('update') == "hospital" ) {

        var id_up_hos = searchParams.get('id');
        updateID = id_up_hos;
        firebase.database().ref('hospitals/' + id_up_hos).on('value', function (snapshot) {
            
            const values = snapshot.val();
            console.log(values);
            const marker1 = new mapboxgl.Marker({ color: 'red' });
            
            var updateData = '\
            <div class="form-group">\
                <label for="h_name" class="col-md-12 col-form-label">Hospital Name</label>\
                <div class="col-md-12">\
                    <input id="h_name" type="text" class="form-control" name="h_name" value="' + values.h_name + '" required autofocus>\
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

            
            marker1.setLngLat([values.h_lon, values.h_lat]).addTo(map);
            map.flyTo({
                center: [
                values.h_lon,
                values.h_lat
                ],zoom: 15 ,essential: true
            });
             $('#updateBody').append(updateData);
        });

         
    

    }