<?php
include_once "libs/secureLib.php";
if(!validate("connected", "SESSION"))
{
    header("Location:index.php?view=login");
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
                        <h1 class="white typed">Liste des services hospitaliers</h1>
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
                    <table id="liste_service" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom du responsable</th>
                            <th>Spécialité</th>
                            <th>Nombre de chambre</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nom du responsable</th>
                            <th>Spécialité</th>
                            <th>Nombre de chambre</th>

                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="webroot/assets/js/listServices.js"></script>
</body>
<?php
include("webroot/templates/component_include/footer.html");
?>