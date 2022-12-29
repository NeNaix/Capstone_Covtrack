 toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "showDuration": "300",
    "hideDuration": "2000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
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
var lastIndex = 0;
  
   firebase.database().ref('hospitals/').on('value', function (snapshot) {
        var value = snapshot.val();
         
       
        var htmls = [];
        $.each(value, function (index, value) {
        if (value) {
            var percentage = parseInt(value.h_occupied_bed) / parseInt(value.h_capacity) * 100 ;
            var color = '';
            if (percentage < 50 ) {
                color='success';
            }else if(percentage >= 50 && percentage < 75 ){
                color='warning';
            }else{
                color='danger';
            }
                htmls.push('<tr>\
                <td>' + value.h_name + '</td>\
                <td>' + value.h_addr + '</td>\
                <td>' + value.h_email +"<br/>  "+ value.h_contact + '</td>\
                <td align="center">' + value.h_capacity + '</td>\
                <td ><div class="progress"> <div class="progress-bar bg-'+color+'" role="progressbar" style="width: '+percentage+'%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="'+value.h_capacity+'">'+value.h_occupied_bed+'</div></div></td>\
                <td> Lon:' + value.h_lon+"<br/> Lat:"+ value.h_lat + '</td>\
                <td align="center"><a href="/update/hospital?id=' + index + '&update=hospital"><button class="btn btn-info" data-id="' + index + '">Update</button></a>\
                <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
            </tr>');
            }
            lastIndex = index;
        });
        $('.sample').html("refresh "+ lastIndex );
        $('#table_pagination').DataTable();
        $('#table_pagination').DataTable().destroy();
        $('#hopital_data').empty();
        $('#hopital_data').html(htmls);
    
        $('#table_pagination').DataTable();
        $('#submitUser').removeClass('desabled');
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
        $( "#alerts" ).remove();
        toastr.error('Data Removed', 'DELETE');
        $("#remove-modal").modal('hide');
       
    });

    $('.remove-data-from-delete-form').click(function (e) {
        e.preventDefault();
        $('body').find('.hospital-remove-record-model').find("input").remove();
    });
