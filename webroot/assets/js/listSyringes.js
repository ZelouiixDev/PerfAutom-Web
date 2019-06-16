var last_result;

$(document).ready(function() {
    getSyringes(1);
    setInterval(function(){
        getSyringes(0);
    }, 2000);
});

function format(n){return n<10? '0'+n:''+n;}

function getSyringes(first){
    $.get("controller.php?action=list_syringes").done(function (result) {
        parsedResult = JSON.parse(result).data;
        dataTab = [];
        var i;
        for (i = 0; i < parsedResult.length; i++) {
            if (parsedResult[i].state === "3") img = "<img width=15 src='webroot/assets/img/red_point.png' title='Seringue Arrêtée !' />";
            else if (parsedResult[i].state === "1") img = "<img width=15 src='webroot/assets/img/green_point.png' title='Seringue En Marche !' />";
            else if (parsedResult[i].state === "2") img = "<img width=15 src='webroot/assets/img/orange_point.png' title='Seringue Vide !' />";
            else if (parsedResult[i].state === "0") img = "<img width=15 src='webroot/assets/img/grey_point.png' title='Seringue non assignée !' />";

            if (parsedResult[i].state === "0")
                dataTab.push(["<a href='syringe/"+parsedResult[i].id+"'>"+parsedResult[i].id+"</a>", 'Non assignée', '', '', '', '', '', img]);
            else
                dataTab.push(["<a href='syringe/"+parsedResult[i].id+"'>"+parsedResult[i].id+"</a>", parsedResult[i].patient_id + ' - ' + parsedResult[i].firstname + ' ' + parsedResult[i].lastname, parsedResult[i].room_number, parsedResult[i].substance, parseFloat(Math.round(parsedResult[i].prescribed_dose * 100) / 100).toFixed(2), parseFloat(Math.round(parsedResult[i].max_dose * 100) / 100).toFixed(2), parsedResult[i].prescriber, img]);
        }

        if (first || result !== last_result){
            $('#liste_seringue').DataTable({
                destroy: true,
                "data": dataTab
            });
            last_result = result;
            console.log("Change detected! Reloading array...");
        }
    });
}