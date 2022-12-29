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
var database = firebase.database();
var lastIndex = 1; 
var set_h= $('#h_id').val();

firebase.database().ref('hospitals/'+set_h).on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        var percentage = parseInt(value.h_occupied_bed) / parseInt(value.h_capacity) * 100 ;
        var color = '';
        if (percentage <50 ) {
            color='success';
        }else if(percentage >= 50 && percentage < 75 ){
            color='warning';
        }else{
            color='danger';
        }
       console.log(value);
       $('#h_title').html(value.h_name);
        $('.profile_table').html(`
             <tbody>
                <tr>
                  <th><strong>Address</strong></th>
                  <td >`+value.h_addr+`</td>
                </tr>
                <tr>
                  <th><strong>Email</strong></th>
                  <td>`+value.h_email+`</td>
                </tr>
                <tr>
                  <th><strong>Contact</strong></th>
                  <td>`+value.h_contact+`</td>
                </tr>
                <tr>
                  <th><strong>Capacity</strong></th>
                  <td>`+value.h_capacity+`</td>
                </tr>
                <tr>
                  <th><strong>Occupied</strong></th>
                  <td><div class="progress">
  <div class="progress-bar bg-`+color+`" role="progressbar" style="width: `+percentage+`%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="`+value.h_capacity+`">`+value.h_occupied_bed+`</div>
                </div>
                </td>
                </tr>
              </tbody>
            `);
          $('body').find('#update_content').html(`
          <div class="form-group">
                <label for="h_e_cap" class="col-md-12 col-form-label">Hospital Bed Capacity</label>
                <div class="col-md-12">
                    <input id="h_e_beds" style="text-align:center;" type="number" class="form-control" name="h_e_beds" min=0 value="` + value.h_occupied_bed + `" max="` + value.h_capacity + `"required autofocus>\
                </div>
            </div>
          `);


    });

    $('.updatebeds').on('click', function (e) {
        e.preventDefault();
      
        firebase.database().ref('/hospitals/' + set_h).update({h_occupied_bed: parseInt($('#h_e_beds').val())});
    });

