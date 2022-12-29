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
var set_barangay= $('#brgy').val();
$('#customt').html("Covtrack : "+set_barangay+" Covid Cases");
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
firebase.database().ref('covids').orderByChild('barangay').equalTo(set_barangay).on('value', function (snapshot) {
        var value = snapshot.val();
        
       
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                if (value.status == "Deceased") {
 htmls.push('<tr>\
                <td> C-' + zeroPad(index, 7) + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>Deceased</td>\
            </tr>');
                }else{
                    htmls.push('<tr>\
                <td> C-' + zeroPad(index, 7) + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td><button data-toggle="modal" class="btn btn-info updateData" data-id="' + index + '" data-target="#update-modal" >Update</button></a>\
                <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
            </tr>'); 
                }
           
                
            }
            lastIndex = index;
        });
        $('.sample').html("refresh"+ lastIndex );
        $('#table_pagination').DataTable();
        $('#table_pagination').DataTable().destroy();
        $('#covid_data').empty();
        $('#covid_data').html(htmls);
    
        $('#table_pagination').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1,2,3,4,5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,5]
                }
            }
            ]
        });
        $('#submitUser').removeClass('desabled');
    });

    // Remove Data
    $("body").on('click', '.removeData', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('body').find('.covid-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function (e) {
        e.preventDefault();
        var values = $(".covid-remove-record-model").serializeArray();
        var id = values[0].value;
        toastr.error('DELETE','C-'+ zeroPad(id, 7) +" Deleted");
        firebase.database().ref('/covids/' + id).remove();

        $('body').find('.covid-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
       
    });

    $('.remove-data-from-delete-form').click(function (e) {
        e.preventDefault();
        $('body').find('.covid-remove-record-model').find("input").remove();
    });

    
    firebase.database().ref('covids/').orderByKey().limitToLast(1).on('value', function (snapshot) {
        var value = snapshot.val();
        $.each(value, function (index, value) {
                if (index == NaN) {
                    lastIndex = 1;
                }
                else{
                    lastIndex = parseInt(index) + 1;
                } 
        });
    });

    $('.addcovid').on('click', function (e) {
        e.preventDefault();
        var values = $(".covid-add-record-model").serializeArray();

        
        console.log(values);
        // firebase.database().ref('hospitals/' + id).remove();
        // $('body').find('.hospital-remove-record-model').find("input").remove();
        // $("#remove-modal").modal('hide');
        var name = values[0].value;
        var age = values[1].value;
        var gender = values[2].value;
        var barangay = values[3].value;
        var status = values[4].value;


       

        firebase.database().ref('covids/'+lastIndex).set({
            name: name,
            age: age,
            gender: gender,
            barangay: barangay,
            status: status,
            
        });
            toastr.success('CREATE','New Case Added');
        $("#add input").val("");
       
    });

    $("body").on('click', '.updateData', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        console.log(id);
        firebase.database().ref('covids/'+ id).on('value', function (snapshot) {
        var value = snapshot.val();
        var gen_select = "";
        var stat_select = "";
        if (value['gender'] == "male") {
            gen_select = `<option value="male" selected>Male</option><option value="female">Female</option>`
        }else{
            gen_select = `<option value="male">Male</option><option value="female" selected>Female</option>`
        }
        if (value['status'] == "Active") {
            stat_select = `<option value="Active" selected>Active</option>
            <option value="Recovered">Recovered</option>
            <option value="Deceased">Deceased</option>`
        }else if (value['status'] == "Recovered"){
            stat_select = `<option value="Active">Active</option>
            <option value="Recovered" selected>Recovered</option>
            <option value="Deceased">Deceased</option>`
        }else{
            stat_select = `<option value="Active">Active</option>
            <option value="Recovered">Recovered</option>
            <option value="Deceased" selected>Deceased</option>`
        }
        console.log();
        $('body').find('#update_content').html(`
            <input name="id" type="hidden" value="`+id+`">
               <div class="col-md-8">
                            <div class="form-group">
                                       <label>Full name</label>
                                       <input id="name" name="name" type="text" class="form-control elevation-2" value="`+value['name']+`">
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Age</label>
                                       <input id="age" name="age" type="number" min="1" max="120"class="form-control elevation-2" value=`+value['age']+`>
                                    </div>
                                 </div>
                                <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Gender</label>
                                       <select id="gender" name="gender" class="form-control elevation-2">
                                          `+gen_select+`
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="float-left">Barangay</label>
                                    <select id="barangay" name="barangay" class="form-control elevation-2">
                                        <option value="`+value['barangay']+`" selected>`+value['barangay']+`</option>
                                    </select>
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-4">
                                     <div class="form-group">
                                       <label class="float-left">Status</label>
                                       <select id="status" name="status" class="form-control elevation-2">
                                          `+stat_select+`
                                       </select>
                                    </div>
                                 </div>
            `);
     });
        
    });


    $('.updatecovid').on('click', function (e) {
        e.preventDefault();
        var values = $(".covid-update-record-model").serializeArray();
        var id = values[0].value;
        console.log(values);
        var postData = {
            name : values[1].value,
            age : values[2].value,
            gender : values[3].value,
            barangay : values[4].value,
            status : values[5].value,
        };
        

        var updates = {};
        updates['/covids/' + id] = postData;
        toastr.success('UPDATE','New Case Updated');
        firebase.database().ref().update(updates);
        
        
       
    });



function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}


var brgy1 = [
'Bagumbayan',
'Bambang',
'Calzada',
'Central Bicutan',
'Central Signal Village',
'Fort Bonifacio',
'Hagonoy',
'Ibayo-Tipas',
'Katuparan',
'Ligid-Tipas',
'Lower Bicutan',
'Maharlika Village',
'Napindan',
'New Lower Bicutan',
'North Daang Hari',
'North Signal Village',
'Palingon',
'Pinagsama',
'San Miguel',
'Santa Ana',
'South Daang Hari',
'South Signal Village',
'Tanyag',
'Tuktukan',
'Upper Bicutan',
'Ususan',
'Wawa',
'Western Bicutan',
];



firebase.database().ref('record').on('value', function (snapshot) {
    var value = snapshot.val(); 
    var date_taguig = [];
    var date_a = [];
    var date_r = [];
    var date_d = [];
    var records_data = []; 
    $("#tlm").empty();
    $("#tlm").append('<canvas id="timeline" height="307" width="600"></canvas>');            
    $.each(value, function (index, value) {
        console.log(index);
        firebase.database().ref('record/'+index+"/barangay")
            .orderByChild('barangay').equalTo($('#brgy').val())
                .on('value', function (snapshot) {
                    var value2 = snapshot.val();
                        if (value2) {
                        $.each(value2, function (index1, bb) {
                            if (bb) {
                            date_taguig.push(index);
                            date_a.push(bb.active);
                            date_r.push(bb.recover);
                            date_d.push(bb.deceased);
                            }
                            }); 
                        }
                        else{
                            date_taguig.push(index);
                            date_a.push(0);
                            date_r.push(0);
                            date_d.push(0);
                                
                        }

        });     
    });
    records_data.push(
                {
                        label: 'active',
                        borderColor: 'red',
                        data: date_a,
                        fill: false,
                        brderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                },
                {
                        label: 'recovered',
                        borderColor: 'green',
                        data: date_r,
                        fill: false,
                        brderColor: 'rgb(75, 192, 192)',
                        tension: 0.1

                },
                {
                        label: 'deceased',
                        borderColor: 'black',
                        data: date_d,
                        fill: false,
                        brderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                }
    );
    var myBar3 = new Chart(document.getElementById("timeline").getContext("2d"), {
            type: 'line',
            data: {
                labels: date_taguig,
                datasets: records_data
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        // Change here
                        barPercentage: 1
                    }]
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Timeline'
                }
            }
        });
});

firebase.database().ref('covids/').on('value', function (snapshot) {
    var value = snapshot.val();
    
    $.each(brgy1, function (index1, barangay) {
       var a=0,b=0,c=0;
       var male=0,female=0;
       var aa=0,bb=0,cc=0,dd=0,ee=0;
       var place='';
       var count;
        
      $.each(value, function (index, value) {
      
               if (value) {
                  if (value.barangay == barangay) {
                     
                     
                     count = index1 + 1;
                     place = barangay;
                    if (value['status'] == "Active") {
                        a = a + 1;
                    }else if(value['status'] == "Recovered"){
                        b = b + 1;
                    }else{
                        c = c + 1;
                    }

                    if (value['gender'] == "male") {
                        male = male + 1;

                    }else{
                        female = female + 1;
                    }

                    if (value['age'] >= 1 &&  value['age'] <= 20) {
                        aa = aa + 1;
                    }else if(value['age'] >= 21 &&  value['age'] <= 40){
                        bb = bb + 1;
                    }else if(value['age'] >= 41 &&  value['age'] <= 60){
                        cc = cc + 1;
                    }else if(value['age'] >= 61 &&  value['age'] <= 80){
                        dd = dd + 1;
                    }else{
                        ee = ee + 1;
                    }
               } 
            } 
         });
        
         
        d=a+b+c;
        
        var motality = (c/d)*100;

        firebase.database().ref('barangays/'+count).update({
            barangay: place,
            active: a,
            recover: b,
            deceased: c,
            total:d,
            mortality_barangay:motality.toFixed(2),
            m:male,
            f:female
            });
 
    });

    var a=0,b=0,c=0;
    var male=0,female=0;
    var aa=0,bb=0,cc=0,dd=0,ee=0;
    $.each(value, function (index, value) {
        if (value) {
            
                if (value['status'] == "Active") {
                    a = a + 1;
                }else if(value['status'] == "Recovered"){
                    b = b + 1;
                }else{
                    c = c + 1;
                }

                if (value['gender'] == "male") {
                    male = male + 1;

                }else{
                    female = female + 1;
                }

                if (value['age'] >= 1 &&  value['age'] <= 20) {
                    aa = aa + 1;
                }else if(value['age'] >= 21 &&  value['age'] <= 40){
                    bb = bb + 1;
                }else if(value['age'] >= 41 &&  value['age'] <= 60){
                    cc = cc + 1;
                }else if(value['age'] >= 61 &&  value['age'] <= 80){
                    dd = dd + 1;
                }else{
                    ee = ee + 1;
                }
    }    

    });
    firebase.database().ref('record/'+new Date(firebase.firestore.Timestamp.now().seconds*1000).toISOString().split('T')[0]).update({
                total_cases: Object.keys(value).length,
                fatality_rate: ((c/Object.keys(value).length)*100).toFixed(2),
                actives: a,
                recovers: b,
                deaths: c,
                m:male,
                f:female,
                });
    

    });

    firebase.database().ref().on('value', function (snapshot) {
    var value = snapshot.val(); 

    firebase.database().ref('record/'+new Date(firebase.firestore.Timestamp.now().seconds*1000).toISOString().split('T')[0]).update({
                barangay:value.barangays
                });

    });
