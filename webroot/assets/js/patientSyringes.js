function change_syringe_dose(id_button) {
        $.get( "controller.php?action=change_syringe_dose", {
                "syringe_id": id_button.split('-')[1],
                "patient_id": id_button.split('-')[4],
                "ip_address": id_button.split('-')[2],
                "old_dose": document.getElementById('old_dose-'+id_button.split('-')[1]).value,
                "new_dose": document.getElementById('new_dose-'+id_button.split('-')[1]).value
        }).done(function(data){
		console.log(data);
		document.getElementById('old_dose-'+id_button.split('-')[1]).value = data
		document.getElementById('stop-'+id_button.split('-')[1]+'-'+id_button.split('-')[2]+'-'+id_button.split('-')[3]+'-'+id_button.split('-')[4]).id = 'stop-'+id_button.split('-')[1]+'-'+id_button.split('-')[2]+'-'+document.getElementById('old_dose-'+id_button.split('-')[1]).value+'-'+id_button.split('-')[4];
		document.getElementById(id_button).id  =  'btn-'+id_button.split('-')[1]+'-'+id_button.split('-')[2]+'-'+document.getElementById('old_dose-'+id_button.split('-')[1]).value+'-'+id_button.split('-')[4];
		document.getElementById('new_dose-'+id_button.split('-')[1]).value = data;
	});
}

function stop_syringe(id_button){
	$.get( "controller.php?action=stop_syringe", {
                "syringe_id": id_button.split('-')[1],
                "ip_address": id_button.split('-')[2]
        }).done(function(data){
		document.getElementById('state-'+id_button.split('-')[1]).innerHTML = "<td id='state-"+id_button.split('-')[1]+"'><img width=15 src='webroot/assets/img/red_point.png' title='Seringue Arrêtée !' /></td>";
		document.getElementById(id_button).parentElement.innerHTML = "<button title='Redémarrer la seringue' id='reload-"+id_button.split('-')[1]+"-"+id_button.split('-')[2]+"-"+id_button.split('-')[3]+'-'+id_button.split('-')[4]+"' onclick='reload_syringe(this.id)'><i class='fa fa-redo'></i></button><button id='remove-"+id_button.split('-')[1]+"-"+id_button.split('-')[4]+"' title='Supprimer le traitement' onclick='remove_treatment(this.id)'><i class='fa fa-times'></i></button>";
		document.getElementById('new_dose-'+id_button.split('-')[1]).disabled = true;
		document.getElementById('btn-'+id_button.split('-')[1]+'-'+id_button.split('-')[2]+'-'+id_button.split('-')[3]+'-'+id_button.split('-')[4]).disabled = true;
	})
}

function reload_syringe(id_button){
	$.get( "controller.php?action=reload_syringe", {
                "syringe_id": id_button.split('-')[1],
                "ip_address": id_button.split('-')[2],
				"dose": id_button.split('-')[3]
        }).done(function(data){
		document.getElementById('state-'+id_button.split('-')[1]).innerHTML = "<td id='state-"+id_button.split('-')[1]+"'><img width=15 src='webroot/assets/img/green_point.png' title='Seringue en Marche !' /></td>";
		document.getElementById(id_button).parentElement.innerHTML = "<button title='Arrêter la seringue' id='stop-"+id_button.split('-')[1]+"-"+id_button.split('-')[2]+"-"+id_button.split('-')[3]+'-'+id_button.split('-')[4]+"' onclick='stop_syringe(this.id)'><i class='fa fa-times'></i>";
		document.getElementById('new_dose-'+id_button.split('-')[1]).disabled = false;
		document.getElementById('btn-'+id_button.split('-')[1]+'-'+id_button.split('-')[2]+'-'+id_button.split('-')[3]+'-'+id_button.split('-')[4]).disabled = false;
	})
}

function remove_treatment(id_button){
	request = "controller.php?action=remove_treatment&syringe_id="+id_button.split('-')[1] + "&patient_id="+id_button.split('-')[2];
	window.location.replace(request);
}
