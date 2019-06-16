$(document).ready(function() {
    $.get("controller.php?action=list_patients").done(function (result) {
        parsedResult = JSON.parse(result).data;
        dataTab = [];
        var i;
        for (i = 0; i < parsedResult.length; i++) {
            button_patient_syringes = "<a href='./patient/"+parsedResult[i].id +"' ><button class= 'btn btn-syringes-patient' id='id_patient-"+parsedResult[i].id +"' type='button'>Seringues</button></a>";
            date1 = new Date(parsedResult[i].birth_date);
            dataTab.push([parsedResult[i].id, parsedResult[i].lastname, parsedResult[i].firstname, format(date1.getDate()) + '/' + format(date1.getMonth()+1) + '/' + date1.getFullYear(), parsedResult[i].reason_hospitalisation, parsedResult[i].room_number, parsedResult[i].doctor, parsedResult[i].number_day_hospitalisation, button_patient_syringes]);
        }
        $('#liste_patient').DataTable({
            "data": dataTab
        });
    });


});

function format(n){return n<10? '0'+n:''+n;}
