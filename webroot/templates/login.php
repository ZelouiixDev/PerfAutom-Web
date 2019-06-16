<?php

include_once "libs/secureLib.php";

if(validate("connected", "SESSION"))
{
    header("Location:index.php");
    die("");
}

if (validate("fail")) $fail = true;
else $fail = false;
$page = validate("page");
?>
<head>
	<title>Perf'Autom - Se connecter</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="webroot/assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/animsition/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/login/util.css">
	<link rel="stylesheet" type="text/css" href="webroot/assets/css/login/main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('webroot/assets/img/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Se Connecter
				</span>
                <div class="card-body">
                    <?php if ($fail): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur : </strong> Vérifiez vos identifiants !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    <form action="controller.php" >
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="login" class="form-control" placeholder="pseudo">

                        </div>
                        <?php if ($page): ?>
                        <input name="page" type="hidden" value="<?php echo $page;?>" />
                        <?php endif; ?>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="mot de passe">
                        </div>
                        <div class="form-group">
                            <center><button type="submit" name="action" value="login" class="btn btn-success">Go</button></center>
                        </div>
                    </form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="webroot/assets/js/jquery/jquery-3.2.1.min.js"></script>
	<script src="webroot/assets/js/animsition/js/animsition.min.js"></script>
	<script src="webroot/assets/js/bootstrap/js/popper.js"></script>
	<script src="webroot/assets/js/bootstrap/js/bootstrap.min.js"></script>
	<script src="webroot/assets/js/select2/select2.min.js"></script>
	<script src="webroot/assets/js/daterangepicker/moment.min.js"></script>
	<script src="webroot/assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="webroot/assets/js/countdowntime/countdowntime.js"></script>
	<script src="webroot/assets/js/login/main.js"></script>

</body>
</html>
