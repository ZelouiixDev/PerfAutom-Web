<?php
include_once "libs/secureLib.php";
include_once "libs/model.php";
if(!validate("connected", "SESSION"))
{
    header("Location:index.php?view=login&page=list_patients");
    die("");
}

$service = getServiceName($_SESSION["service_id"]);

include("webroot/templates/component_include/menu.html");
?>

<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="light white">Perf'autom</h3>
                        <h1 class="white typed">Liste des patients du service <?php echo $service; ?></h1>
                        <span class="typed-cursor">|</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<body>

<div class="container container_profil_table">
    <div class="row row_profil_table">
        <div class="container col-10">
            <div class="row">
                <div class="col-md-14">
                    <table id="liste_patient" class="display table table-stripped table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Motif hospitalisation</th>
                            <th>N° chambre</th>
                            <th>Médecin traitant</th>
                            <th>Nb jours hospit</th>
                            <th>Seringues</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Motif hospitalisation</th>
                            <th>N° chambre</th>
                            <th>Médecin traitant</th>
                            <th>Nb jours hospit</th>
                            <th>Seringues</th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="webroot/assets/js/listPatients.js"></script>
</body>
<?php
include("webroot/templates/component_include/footer.html");
?>
