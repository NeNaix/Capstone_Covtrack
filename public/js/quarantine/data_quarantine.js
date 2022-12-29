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
  };

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
  
   firebase.database().ref('quarantines/').on('value', function (snapshot) {
        var value = snapshot.val();
       
       
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                <td>' + value.q_name + '</td>\
                <td>' + value.q_addr + '</td>\
                <td>' + value.q_email +"<br/>  "+ value.q_contact + '</td>\
                <td align="center">' + value.q_capacity + '</td>\
                <td> Lon:' + value.q_lon+"<br/> Lat:"+ value.q_lat + '</td>\
                <td align="center"><a href="/update/quarantine?id=' + index + '&update=quarantine"><button class="btn btn-info" data-id="' + index + '">Update</button></a>\
                <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
            </tr>');
            }
            lastIndex = index;
        });
        $('.sample').html("refresh "+ lastIndex );
        $('#table_pagination_q').DataTable();
        $('#table_pagination_q').DataTable().destroy();
        $('#quarantine_data').empty();
        $('#quarantine_data').html(htmls);
    
        $('#table_pagination_q').DataTable();
        $('#submitUser').removeClass('desabled');
    });

    // Remove Data
    $("body").on('click', '.removeData', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('body').find('.quarantine-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function (e) {
        e.preventDefault();
        var values = $(".quarantine-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('quarantines/' + id).remove();
        $('body').find('.quarantine-remove-record-model').find("input").remove();
        $( "#alerts" ).remove();
        toastr.error('Data Removed', 'DELETE');
        $("#remove-modal").modal('hide');
       
    });

    $('.remove-data-from-delete-form').click(function (e) {
        e.preventDefault();
        $('body').find('.quarantine-remove-record-model').find("input").remove();
    });
