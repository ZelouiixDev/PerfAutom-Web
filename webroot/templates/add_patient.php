<?php

include_once "libs/secureLib.php";
include_once "libs/model.php";

if(!validate("connected", "SESSION"))
{
    header("Location:index.php?view=login&page=ajouter_patient");
    die("");
}
$services = getServices();

include("webroot/templates/component_include/menu.html");
?>

<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="light white">Perf'autom</h3>
                        <h1 class="white typed">Ajouter un nouveau patient</h1>
                        <span class="typed-cursor">|</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<body>
<div class="container-contact100">
    <div class="wrap-contact100">
        <form class="contact100-form validate-form" action="controller.php">
            <div class="container">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_name">Nom </label>
                        <input id="form_nom" type="text" name="lastname" class="form-control" placeholder="Nom du patient" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_name">Prénom</label>
                        <input id="form_prenom" type="text" name="firstname" class="form-control" placeholder="Prenom du patient" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_date_naissance">Date de naissance</label>
                        <input id="form_date_naissance" type="date" name="birth_date" class="form-control" placeholder="Date de naissance du patient" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_medecin">Médecin traitant</label>
                        <input id="form_medecin" type="text" name="doctor" class="form-control" placeholder="Medecin du patient" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="form_motif_hospit">Motif d'hospitalisation</label>
                        <input id="form_motif_hospit" type="text" name="reason_hospitalisation" class="form-control" placeholder="Motif hospitalisation du patient" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_medecin">Numéro de chambre</label>
                        <input id="form_medecin" type="text" name="room_number" class="form-control" placeholder="Numéro de chambre" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_nb_jour_hospit">Nombre de jours d'hospitalisation</label>
                        <input id="form_nb_jour_hospit" type="text" name="number_day_hospitalisation" class="form-control" placeholder="Nombre de jours d'hospitalisation" required="required" data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_id_service">Service</label>
                        <div class="wrap-input100">
                            <select name="service_id" id="service" class="form-control">
                                <option value="">Selectionnez un service</option>
                                <?php
                                    foreach ($services as $service){
                                        echo "<option value=$service{id]>$service[specialty]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
		</div>
            <div class="col-md-12">
                <button name="action" value="add_patient" type="submit" style="background-color: green;" class="btn btn-success">Ajouter un patient</button>
            </div>
	</div>
        </form>

    </div>
</div>
</body>
<?php
include("webroot/templates/component_include/footer.html");
?>
