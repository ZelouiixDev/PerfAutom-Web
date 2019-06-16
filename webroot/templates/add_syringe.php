<?php
include_once "libs/model.php";
include_once "libs/secureLib.php";

if(!validate("connected", "SESSION"))
{
    header("Location:index.php?view=login&page==ajouter_seringue");
    die("");
}
$syringesList = listAvailableSyringes();
$syringe = validate("syringe");
include("webroot/templates/component_include/menu.html");
?>

<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <?php if ($syringe): ?>
                        <div class="alert alert-success" role="alert">Seringue <strong><?php echo $syringe; ?></strong> assignée avec succès !</div>
                    <?php endif; ?>
                    <div class="col-md-12 text-center">
                        <h3 class="light white">Perf'autom</h3>
                        <h1 class="white typed">Assigner une nouvelle seringue</h1>
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
                        <label for="form_identifiant">Identifiant du patient </label>
                        <input id="form_identifiant" type="text" name="patient_id" class="form-control" placeholder="Identifant du patient" required="required" data-error="Identifiant patient est requis.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_substance">Substance</label>
                        <input id="form_substance" type="text" name="substance" class="form-control" placeholder="Substance dans la seringue" required="required" data-error="Substance seringue est requis.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_dose_prescrite">Dose Prescrite en ml/h</label>
                        <input id="form_dose_prescrite" type="text" name="prescribed_dose" class="form-control" placeholder="Dose seringue prescrite " required="required" data-error="Dose seringue prescrite est requise.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_dose_maximale">Dose maximale en ml/h</label>
                        <input id="form_dose_maximale" type="text" name="max_dose" class="form-control" placeholder="Dose seringue maximale" required="required" data-error="Dose seringue maximale est requise">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_medecin_prescripteur">Medecin prescripteur</label>
                        <input id="form_medecin_prescripteur" type="text" name="prescriber" class="form-control" placeholder="Medecin prescripteur" required="required" data-error="Le medecin prescripteur est requis">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
	
		<div class="col-md-6">
                    <div class="form-group">
			<label for="seringue_select">Numéro de seringue</label>
			    <select name='syringe_id' class="form-control" id="seringue_select">
			      <?php
					foreach ($syringesList as $syringe)
						echo "<option value='$syringe[id]'>Seringue n°$syringe[id]</option>";
				?>
			  </select>
		    </div>
		</div>

            <div class="col-md-12">
                <button name="action" value="add_syringe" style="background-color: green;" type="submit" class="btn btn-success">Assigner une seringue</button>
            </div>
	</div>
	</div>
        </form>

    </div>
</div>
</body>
<?php
include("webroot/templates/component_include/footer.html");
?>
