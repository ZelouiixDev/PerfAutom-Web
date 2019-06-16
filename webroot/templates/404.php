<?php
include_once "libs/secureLib.php";
if(!validate("connected", "SESSION"))
    include("webroot/templates/component_include/menuNotConnected.html");
else
    include("webroot/templates/component_include/menu.html");

?>
<header id="intro">
    <div class="container">
        <div class="table">
            <div class="header-text">
                <div class="row">
                    <h3 style="color: white;">Erreur <strong>404</strong> : La page demandée n'existe pas...</h3>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
	
<?php
    include("webroot/templates/component_include/footer.html");
?>
</body>

</html>
