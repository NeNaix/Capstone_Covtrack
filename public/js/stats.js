$(document).ready(function() {
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


firebase.database().ref().on('value', function (snapshot) {
    var value = snapshot.val();
    var IR=0,DR=0;
    var a=0,b=0,c=0;
    var male=0,female=0;
    var aa=0,bb=0,cc=0,dd=0,ee=0;
    var labels_b = [];
    var data_a = [];
    var data_d = [];
    var data_r = [];
    var data_m = [];
    var data_f = [];
    var data_total = [];
    
    $("#tlm").empty();
    $("#tlm").append('<canvas id="timeline" height="307" width="600"></canvas>');

    $("#facilities").empty();
    $("#facilities").append('<canvas id="canvas" height="307" width="600"></canvas>');
    $("#total").empty();
    $("#total").append('<canvas id="canvas1" height="307" width="600"></canvas>');

    $("#range_bar").empty();
    $("#range_bar").append('<canvas id="age_range_barchart" height="307" width="600"></canvas>');

    $("#brgy").empty();
    $("#brgy").append('<canvas id="brgy_canva" height="307" width="600"></canvas>');
    $("#d_bar").empty();
    $("#d_bar").append('<canvas id="donut_brgy" height="307" width="600"></canvas>');

    $("#aa").empty();
    $("#bb").empty();
    $("#cc").empty();
    $("#b").empty();
    $("#d").empty();
    $("#c").empty();
    $("#age_range").empty();

    var date_taguig = [];
    var date_a = [];
    var date_r = [];
    var date_d = [];
    var records_data = [];
    $.each(value.record, function (index, value) {
        date_taguig.push(index);
        date_a.push(value.actives);
        date_r.push(value.recovers);
        date_d.push(value.deaths);
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
    var timehere = new Chart(document.getElementById("timeline").getContext("2d"), {
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
                    }]
                },
                responsive: true,
            }
        });

    $.each(value.covids, function (index, value) {
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
    console.log(a);
    firebase.database().ref('taguig/').update({
            total_cases: Object.keys(value.covids).length,
            fatality_rate: ((c/Object.keys(value.covids).length)*100).toFixed(2),
            actives: a,
            recovers: b,
            deaths: c,
            m:male,
            f:female
        });
    $("#aa").html('<i class="fa fa-user" aria-hidden="true"></i>  ' +Object.keys(value.covids).length);
    $("#bb").html(((c/Object.keys(value.covids).length)*100).toFixed(2) +'%');
    $("#b").html('<i class="fa fa-certificate" aria-hidden="true"></i>  ' + a);
    $("#c").html('<i class="fa fa-user" aria-hidden="true"></i>  ' +b);
    $("#d").html(c);

    var ctx = document.getElementById("canvas").getContext("2d");
    var ctx1 = document.getElementById("canvas1").getContext("2d");
    var ctx2 = document.getElementById("age_range_barchart").getContext("2d");

    var barChartData = {
            labels: ['Hospitals','Quarantine','Testing'],
            datasets: [
                {
                    label: 'Facility No.',
                    backgroundColor: 'pink',
                    data: [Object.keys(value.hospitals).length,
                    Object.keys(value.quarantines).length,
                    Object.keys(value.testings).length
                    ]
                }
            ]
        };


    var barChartData1 = {
            labels: ['0 - 20 yrs old','21 - 40 yrs old','41 - 60 yrs old','61 - 80 yrs old','81 yrs old above'],
            datasets: [{
                label: 'Cases',
                backgroundColor: 'maroon',
                data: [aa,bb,cc,dd,ee]
            }]
    };

    var data = {
        labels: ['Male','Female'],
        datasets: [
          {
            label: "Users Count",
            data: [male,female],
            backgroundColor: ["blue","pink"],
            borderColor: "pink",
          }
        ]
      };

      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Gender Confirmed Cases",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
    
        var myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Facilities in Taguig City'
                }
            }
        });

        var myBar1 = new Chart(ctx2, {
            type: 'bar',
            data: barChartData1,
            options: {scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Age Range Covid Cases'
                }
            }
        });

        var chart1 = new Chart(ctx1, {
        type: "pie",
        data: data,
        options: options
      });

    $.each(value.barangays, function (index, value) {
        if (value) {
            labels_b.push(value.barangay);
            data_a.push(value.active);
            data_d.push(value.deceased);
            data_r.push(value.recover);
            data_m.push(value.m);
            data_f.push(value.f);
            data_total.push(value.total);
        }
    });

    var myBar2 = new Chart(document.getElementById("brgy_canva").getContext("2d"), {
            type: 'bar',
            data: {
                labels: labels_b,
                datasets: [
                    {
                        label: 'Active',
                        backgroundColor: '#BB0722',
                        data: data_a
                    },
                    {
                        label: 'Recover',
                        backgroundColor: 'green',
                        data: data_r
                    },
                    {
                        label: 'Deceased',
                        backgroundColor: 'black',
                        data: data_d
                    },
                    {
                        label: 'Female',
                        backgroundColor: '#CA1492',
                        data: data_f
                    },
                    {
                        label: 'Male',
                        backgroundColor: 'blue',
                        data: data_m
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                 elements: {
                  bar: {
                    borderWidth: 6,
                  }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Barangay Analytics'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                plugins: {
                      datalabels: {
                        color: 'green',
                        font: {
                          weight: 'bold',
                          size: 32,
                        }
                      }
                    }
            }
        });
    var myBar3 = new Chart(document.getElementById("donut_brgy").getContext("2d"), {
            type: 'bar',
            data: {
                labels: labels_b,
                datasets: [
                    {
                        label: 'Total Case',
                        backgroundColor: '#E6421E',
                        data: data_total
                    }
                ]
            },
            options: {scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                indexAxis: 'y',
                 elements: {
      bar: {
        borderWidth: 2,
      }
    },
                responsive: true,
                title: {
                    display: true,
                    text: 'Barangay Analytics'
                }
            }
        });



});



 });
      
$('.col-sm-2').click(function(){
    $('#customt').html("Covtrack : Taguig "+$(this).attr('data')+" Covid  Cases");
    $('#custom-width-modalLabel').html($(this).attr('data')+" Covid Cases")
       firebase.database().ref('covids/').orderByChild('status').equalTo($(this).attr('data')).on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                  htmls.push('<tr>\
                <td> C-' + index + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>' + value.created_at + '</td>\
                <td>' + value.updated_at + '</td>\
                 </tr>');
           
                
            }
        });
        // $('.sample').html("refresh"+ lastIndex );
        $('#table_pagination').DataTable();
        $('#table_pagination').DataTable().destroy();
        $('#covid_data').empty();
        $('#covid_data').html(htmls);
        $('#table_pagination').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });

    $('#data').modal('show');
});

$('#ttal').click(function(){
        $('#customt').html("Covtrack : Taguig Covid Cases");
        $('#custom-width-modalLabel').html("Taguig Covid Cases")
       firebase.database().ref('covids/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
        
                htmls.push('<tr>\
                <td> C-' + index + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>' + value.created_at + '</td>\
                <td>' + value.updated_at + '</td>\
                 </tr>');
            
               
                
            }
        });
        // $('.sample').html("refresh"+ lastIndex );
        $('#table_pagination').DataTable();
        $('#table_pagination').DataTable().destroy();
        $('#covid_data').empty();
        $('#covid_data').html(htmls);
        $('#table_pagination').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });

    $('#data').modal('show');
});

$('.col-lg-4').click(function(){
    

    var date =getDateXDaysAgo(4).toISOString().split('T')[0];
    if ($(this).attr('data') == "1"){
    date = new Date().toISOString().split('T')[0];
    $('#customt').html("Covtrack : Taguig Covid Cases - " + new Date().toLocaleString().split('T')[0]);
    firebase.database().ref('covids/')
       .orderByChild('created_at')
       .equalTo(date)
       .on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                  htmls.push('<tr>\
                <td> C-' + index + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>' + value.created_at + '</td>\
                <td>' + value.updated_at + '</td>\
                 </tr>');
           
                
            }
        });
        // $('.sample').html("refresh"+ lastIndex );
        $('#table_pagination_repo').DataTable();
        $('#table_pagination_repo').DataTable().destroy();
        $('#covid_repo').empty();
        $('#covid_repo').html(htmls);
        $('#table_pagination_repo').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });

    }else if ($(this).attr('data') == "7"){
        date =getDateXDaysAgo(7).toISOString().split('T')[0];
        $('#customt').html("Covtrack : Taguig Covid Cases - " + date +" to "+new Date().toISOString().split('T')[0]);
         firebase.database().ref('covids/')
       .orderByChild('updated_at')
       .startAt(date).endAt(new Date().toISOString().split('T')[0])
       .on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                  htmls.push('<tr>\
                <td> C-' + index + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>' + value.created_at + '</td>\
                <td>' + value.updated_at + '</td>\
                 </tr>');
           
                
            }
        });
        // $('.sample').html("refresh"+ lastIndex );
        $('#table_pagination_repo').DataTable();
        $('#table_pagination_repo').DataTable().destroy();
        $('#covid_repo').empty();
        $('#covid_repo').html(htmls);
        $('#table_pagination_repo').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });
    }else if ($(this).attr('data') == "m"){
    $('#customt').html("Covtrack : Taguig Covid Cases - Month of " + new Date().toLocaleString('default', { month: 'long' }) + " Report");

    firebase.database().ref('covids/')
       .orderByChild('created_at')
       .startAt(new Date().toISOString().substr(0, 6))
       .on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                  htmls.push('<tr>\
                <td> C-' + index + '</td>\
                <td>' + value.name + '</td>\
                <td>' + value.gender + '</td>\
                <td>' + value.age +'</td>\
                <td>' + value.barangay + '</td>\
                <td>' + value.status + '</td>\
                <td>' + value.created_at + '</td>\
                <td>' + value.updated_at + '</td>\
                 </tr>');
           
                
            }
        });
        // $('.sample').html("refresh"+ lastIndex );
         $('#table_pagination_repo').DataTable();
        $('#table_pagination_repo').DataTable().destroy();
        $('#covid_repo').empty();
        $('#covid_repo').html(htmls);
        $('#table_pagination_repo').DataTable({dom: 'Bfrtip',
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            ]
        });
    });
    }
       
});

function getDateXDaysAgo(numOfDays, date = new Date()) {
  const daysAgo = new Date();

  daysAgo.setDate(date.getDate() - numOfDays);

  return daysAgo;
}

