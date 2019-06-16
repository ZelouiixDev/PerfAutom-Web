<?php
include_once "libs/secureLib.php";
if(!validate("connected","SESSION"))
{
    header("Location:index.php?view=login&page=list_syringes");
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
                        <h3 class="light white">Perf'autom</h3>
                        <h1 class="white typed">Liste des seringues</h1>
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
                <div class="col-md-12">
                    <table id="liste_seringue" class="display table table-stripped table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Patient</th>
			                <th>Chambre</th>
                            <th>Substance</th>
                            <th>Dose prescrite</th>
                            <th>Dose maximale</th>
                            <th>Medecin prescripteur</th>
                            <th>Etat</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Patient</th>
			                <th>Chambre</th>
                            <th>Substance</th>
                            <th>Dose prescrite</th>
                            <th>Dose maximale</th>
                            <th>Medecin prescripteur</th>
                            <th>Etat</th>

                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="col-md-12" style="margin: 10px;">
                <button class="btn btn-declare-syringe patient">Déclarer une nouvelle seringue</button>
            </div>
        </div>
    </div>
</div>

<script src="webroot/assets/js/listSyringes.js"></script>
</body>
<?php
include("webroot/templates/component_include/footer.html");
?>
