$(document).ready(function() {
    $.get("controller.php?action=list_services").done(function (result) {
        parsedResult = JSON.parse(result).data;
        console.log(result);
        dataTab = [];
        var i;
        for (i = 0; i < parsedResult.length; i++) {
            dataTab.push([parsedResult[i].id, parsedResult[i].manager_name, parsedResult[i].specialty,parsedResult[i].rooms_number]);
        }
        $('#liste_service').DataTable({
            "data": dataTab
        });
    });


});
