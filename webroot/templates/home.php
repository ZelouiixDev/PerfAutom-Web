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
                    <div class="col-md-12 text-center">
                        <?php if (validate("connected", "SESSION")): ?>
                            <h2 class="light white">Bonjour <?php echo $_SESSION["firstname"].' '.$_SESSION["lastname"]; ?> !</h2>
                            <br/>
                        <?php endif; ?>
                        <h3 class="light white">Perf'autom</h3>
                        <h1 class="white typed">Gestion des traitements à distance</h1>
                        <span class="typed-cursor">|</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
	<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
                <div class="col-md-4">
                    <div class="intro-table intro-table-hover">
                        <h5 class="white heading hide-hover">Infos services</h5>
                        <div class="bottom">
                            <h4 class="white heading small-pt">Liste des services</h4>
                            <a href="services" class="btn btn-white-fill expand">Go</a>
                        </div>
                    </div>
                </div>

				<div class="col-md-4">
					<div class="intro-table intro-table-hover">
						<h5 class="white heading hide-hover">Infos patients</h5>
						<div class="bottom">
							<h4 class="white heading small-pt">Liste des patients</h4>
							<a href="patients" class="btn btn-white-fill expand">Go</a>
						</div>
					</div>
				</div>

                <div class="col-md-4">
                    <div class="intro-table intro-table-hover">
                        <h5 class="white heading hide-hover">Infos traitements</h5>
                        <div class="bottom">
                            <h4 class="white heading small-pt">Liste des seringues</h4>
                            <a href="syringes" class="btn btn-white-fill expand">Go</a>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</section>

<?php
    include("webroot/templates/component_include/footer.html");
?>
</body>

</html>
