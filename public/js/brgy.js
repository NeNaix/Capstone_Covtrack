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
$('#customt').html("Covtrack : Barangay Data");
var brgy = [
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

firebase.database().ref("covids").on('value', function (snapshot) {
        var value = snapshot.val();
        $('#table_pagination').DataTable().destroy();
        $('#count_brgy').empty();
        $.each(brgy, function (index1, barangay) {
            var htmls = [];
            var a=0,b=0,c=0,d=0;
            var male=0,female=0;

            $.each(value, function (index, value1) {
                    
               if (value1) {

                if (value1.barangay == barangay) {
                    if (value1.gender == "male") {
                    male = male + 1;
                }else{
                    female = female + 1;
                    
                }
                 if (value1.status == "Active") {
                    a = a + 1;
                }else if(value1.status == "Recovered"){
                    b =b+ 1;
                }else{
                    c =c+ 1;
                }
               }
               }

           }); 


            d=a+b+c;
            var count = index1 + 1;
            var motality = (c/d)*100;
            // firebase.database().ref('barangays/'+count).set({
            // barangay: barangay,
            // active: a,
            // recover: b,
            // deceased: c,
            // total:d,
            // mortality_barangay:motality.toFixed(2),
            // m:male,
            // f:female
            // });
            // <td style="font-size: 25px;"><button class="btn btn-info" id="a"data="'+barangay+'"><i class="fa fa-table" aria-hidden="true"></button></td>\
            htmls.push('<tr >\
                        <td style="font-size: 25px;"> ' + barangay + '</td>\
                        <td style="color:red;font-size: 25px;">' + a + '</td>\
                        <td style="color:darkgreen;font-size: 25px;">' + b + '</td>\
                        <td style="color:maroon;font-size: 25px;">' + c +'</td>\
                        <td style="color:maroon;font-size: 25px;">' + motality.toFixed(0) +'%</td>\
                        <td style="color:blue;font-size: 25px;">' + male + '</td>\
                        <td style="color:#ff3385;font-size: 25px;">' + female + '</td>\
                        <td style="font-size: 25px;">' + d + '</td>\
                    </tr>');
            $("#count_brgy").append(htmls);
        });
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
});

// $('.a').click(function(){
//     alert($(this).attr('data'));
//     $('#custom-width-modalLabel').html($(this).attr('data')+" Covid Cases")
//        firebase.database().ref('covids/').orderByChild('barangay').equalTo($(this).attr('data')).on('value', function (snapshot) {
//         var value = snapshot.val();
//         var htmls = [];
//         $.each(value, function (index, value) {
//             if (value) {
//                 if (value.status == "Deceased") {
//                     htmls.push('<tr>\
//                 <td> C-' + index + '</td>\
//                 <td>' + value.name + '</td>\
//                 <td>' + value.gender + '</td>\
//                 <td>' + value.age +'</td>\
//                 <td>' + value.barangay + '</td>\
//                 <td>' + value.status + '</td>\
//             </tr>');
//                 }else{
//                     htmls.push('<tr>\
//                 <td> C-' + index + '</td>\
//                 <td>' + value.name + '</td>\
//                 <td>' + value.gender + '</td>\
//                 <td>' + value.age +'</td>\
//                 <td>' + value.barangay + '</td>\
//                 <td>' + value.status + '</td>\
//             </tr>'); 
//                 }
           
                
//             }
//         });
//         // $('.sample').html("refresh"+ lastIndex );
//         $('#table_pagination').DataTable();
//         $('#table_pagination').DataTable().destroy();
//         $('#covid_data').empty();
//         $('#covid_data').html(htmls);
//         $('#table_pagination').DataTable({
//             dom: 'Bfrtip',
//             buttons: [
//                 'excelHtml5'
//                 ,
//                 {
//                 extend: 'pdfHtml5',
//                 customize: function ( doc ) {
//                     console.dir(doc)
//                     doc.content[1].margin = [ 100, 0, 100, 0 ]
//                 }
//             }

//             ]
            
//            });
//     });

//     $('#data').modal('show');
// });





