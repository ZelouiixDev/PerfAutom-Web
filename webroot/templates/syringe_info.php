<?php
include_once "libs/secureLib.php";
include_once "libs/model.php";
if(!validate("connected", "SESSION"))
    include("webroot/templates/component_include/menuNotConnected.html");
else
    include("webroot/templates/component_include/menu.html");

if ($id=validate("id")){
    $syringeInfo = getSyringeInfo($id);
    if ($syringeInfo){
        $syringeInfo = $syringeInfo[0];
    }
}
else{
    header("Location:./");
    die("");
}
?>

<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="light white">Perf'Autom</h3>
                        <h1 class="white typed">Informations sur la seringue N° <?php echo $id; ?></h1>
                        <input type="hidden" id="syringe_id" value="<?php echo $id ?>"/>
                        <input type="hidden" id="patient_id" value="<?php echo $syringeInfo["patient_id"] ?>"/>
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
            <div class="row" style="margin: 0 auto;">
                <div class="col-md-6">
                    <center><h3>Patient associé :</h3></center>
                    <ul class="list-group">
                        <li class="list-group-item">N° Patient : <strong><?php echo $syringeInfo['patient_id']; ?></strong></li>
                        <li class="list-group-item">Nom : <strong><?php echo $syringeInfo['lastname']; ?></strong></li>
                        <li class="list-group-item">Prénom : <strong><?php echo $syringeInfo['firstname']; ?></strong></li>
                        <li class="list-group-item">Date de Naissance : <strong><?php echo $syringeInfo['birth_date']; ?></strong></li>
                        <li class="list-group-item">Motif d'hospitalisation : <strong><?php echo $syringeInfo['reason_hospitalisation']; ?></strong></li>
                        <li class="list-group-item">Nombre de jours d'hospitalisation : <strong><?php echo $syringeInfo['number_day_hospitalisation']; ?></strong></li>
                        <li class="list-group-item">Service : <strong><?php echo $syringeInfo['service_id'].' - '.$syringeInfo['specialty']; ?></strong></li>
                        <li class="list-group-item">N° de chambre : <strong><?php echo $syringeInfo['room_number']; ?></strong></li>
                        <li class="list-group-item">Reponsable : <strong><?php echo $syringeInfo['manager_name']; ?></strong></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <center><h3>Seringue :</h3></center>
                    <ul class="list-group">
                        <li class="list-group-item">N° Seringue : <strong><?php echo $id; ?></strong></li>
                        <li class="list-group-item">Substance : <strong><?php echo $syringeInfo['substance']; ?></strong></li>
                        <li class="list-group-item">Dose prescrite : <strong><?php echo $syringeInfo['prescribed_dose'].' ml/h'; ?></strong></li>
                        <li class="list-group-item">Dose maximale : <strong><?php echo $syringeInfo['max_dose'].' ml/h'; ?></strong></li>
                        <li class="list-group-item">Médecin prescripteur : <strong><?php echo $syringeInfo['prescriber']; ?></strong></li>
                    </ul>
                </div>
                <?php if ($syringeInfo["patient_id"]): ?>
                <div class="col-md-12">
                    <center><h3>Évolution du traitement de <?php echo $syringeInfo['substance'] ?> de <?php echo $syringeInfo['firstname'].' '.$syringeInfo['lastname'];?></h3></center>
                    <canvas id="treatment_evolution_chart" width="400" height="120"></canvas>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
include("webroot/templates/component_include/footer.html");
?>
<script src="webroot/assets/js/syringeInfo.js"></script>
</body>

</html>
