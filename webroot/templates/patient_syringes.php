<?php
include_once "libs/model.php";

include_once "libs/secureLib.php";
if(!validate("connected", "SESSION"))
{
    header("Location:login");
    die("");
}

if ($id=validate("id")){
    $syringes_info = listPatientSyringes($id);
    $patient_name = getPatient($id);
}
else{
    header("Location:./");
    die("");
}

include("webroot/templates/component_include/menu.html");
?>

<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="light white">Perf'Autom</h3>
                        <h1 class="white typed">Liste des seringues associées à <?php echo $patient_name ?></h1>
                        <span class="typed-cursor">|</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container container_profil_table">
    <div class="row row_profil_table">
        <div class="container col-10">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($syringes_info): ?>
                    <table id="liste_seringue_patient" class="display table table-stripped table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                        <th>N° Seringue</th>
                        <th>Substance</th>
                        <th>Dose prescrite</th>
                        <th>Dose max</th>
                        <th>Dose actuelle</th>
                        <th>Etat</th>
                        <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>N° Seringue</th>
                        <th>Substance</th>
                        <th>Dose prescrite</th>
                        <th>Dose max</th>
                        <th>Dose actuelle</th>
                        <th>Etat</th>
                        <th></th>
                        </tr>
                        </tfoot>
                        <?php
                        foreach($syringes_info as $syringe){
                        echo "<tr>";
                            echo "<td class='id_patient' id='id_patient-$id'>".$syringe["id"]."</td>";
                            echo "<td>".$syringe["substance"]."</td>";
                            echo "<td>".$syringe["prescribed_dose"]."</td>";
                            echo "<td>".$syringe["max_dose"]."</td>";
                            echo "<input type='hidden' id='old_dose-$syringe[id]' value='$syringe[new_dose]'/>";
                            if ($syringe["state"] != 3) echo "<td><input style='width: 70px;' type='text' placeholder='Changer la dose' value='$syringe[new_dose]' id='new_dose-$syringe[id]' /><button onclick='change_syringe_dose(this.id)' id='btn-$syringe[id]-$syringe[ip_address]-$syringe[new_dose]-$id' >Valider</button></td>";
                            else echo "<td><input style='width: 70px;' type='text' placeholder='Changer la dose' disabled value='$syringe[new_dose]' id='new_dose-$syringe[id]' /><button disabled onclick='change_syringe_dose(this.id)' id='btn-$syringe[id]-$syringe[ip_address]-$syringe[new_dose]-$id' >Valider</button></td>";
                            if ($syringe["state"] == 3) $img = "<img width=15 src='webroot/assets/img/red_point.png' title='Seringue Arrêtée !' />";
                            else if ($syringe["state"] == 2) $img = "<img width=15 src='webroot/assets/img/orange_point.png' title='Seringue Vide !' />";
                            else if ($syringe["state"] == 1) $img = "<img width=15 src='webroot/assets/img/green_point.png' title='Seringue en Marche !' />";
                            echo "<td id='state-$syringe[id]'>".$img."</td>";
                            if ($syringe["state"] == 1 || $syringe["state"] == 2) echo "<td><button id='stop-$syringe[id]-$syringe[ip_address]-$syringe[new_dose]-$id' onclick='stop_syringe(this.id)' title='Arrêter la seringue'><i class='fa fa-times'></i></button></td>";
                            if ($syringe["state"] == 3) echo "<td><button title='Redémarrer la seringue' id='reload-$syringe[id]-$syringe[ip_address]-$syringe[new_dose]-$id' onclick='reload_syringe(this.id)'><i class='fa fa-redo'></i></button><button id='remove-$syringe[id]-$id' title='Supprimer le traitement' onclick='remove_treatment(this.id)'><i class='fa fa-times'></i></button></td>";
                        echo "</tr>";

                        }
                        ?>
                    </table>
                    <?php else: ?>
                    <center><p>Il n'y a pas de seringue associée à ce patient...</p></center>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="webroot/assets/js/patientSyringes.js"></script>
<?php
include("webroot/templates/component_include/footer.html");
?>
