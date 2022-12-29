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
        i.text === 'Taguig' || i.text === 'taguig'
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
                  document.getElementById('q_addr').value = result.address.LongLabel;
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
    
    var lastIndex = 1;
    firebase.database().ref('quarantines/').orderByKey().limitToLast(1).on('value', function (snapshot) {
        var value = snapshot.val();
        $.each(value, function (index, value) {
                if (index == NaN) {
                    lastIndex = 1;
                    console.log(index);
                }
                else{
                    lastIndex = parseInt(index) + 1;
                    $('#latest_id').val(index);
                } 
        });
        console.log(lastIndex);
    });

    $('#submitQuarantine').on('click', function (e) {
        e.preventDefault();
        var values = $("#addQuarantine").serializeArray();
  
        var q_name = values[0].value;
        var q_contact = values[1].value;
        var q_email = values[2].value;
        var q_capacity = values[3].value;
        var q_addr = values[4].value;
        var q_lon = values[5].value;
        var q_lat = values[6].value;

        firebase.database().ref('quarantines/' + lastIndex).set({
            q_name: q_name,
            q_addr: q_addr,
            q_contact: parseInt(q_contact),
            q_email: q_email,
            q_capacity: q_capacity,
            q_lon: parseFloat(q_lon),
            q_lat: parseFloat(q_lat),
        });

        $("#addQuarantine input").val("");
        window.location.href = '/quarantine?stat=create';

    });

    var validationquarantine = $('#addQuarantine').validate({
                 rules: {
                    q_name: { required:true, minlength:3 },
                    q_addr: { required:true},
                    q_contact: { required:true},
                    q_email: { required:true, email:true},
                    q_capacity: { required:true},
                    q_lon: { required:true},
                    q_lat: { required:true},
                }
            });
validationquarantine.form();