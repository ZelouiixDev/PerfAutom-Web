<?php

session_start();
include_once "libs/secureLib.php";

if (isset($_GET["view"]) && $_GET["view"]!="")
{
    $view = $_GET["view"];
}

else $view="home";
switch($view)
{
    case "home" :
        include("webroot/templates/home.php");
        break;

    default :
        if (file_exists("webroot/templates/$view.php"))
            include("webroot/templates/$view.php");
        else
            include("webroot/templates/404.php");
}
?>
