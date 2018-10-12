<?php 

////Start Paths For All WebSite/////////////
		
$template="includes/template/";
$languages="includes/languages/";
$function="includes/functions/";
$css="layout/css/";
$js="layout/js/";


////End Paths For All WebSite/////////////


//// Important For all web  For  WebSite/////////////
include 'connection.php';
include $languages."english.php";
include $function."functions.php";
include $template."header.php";

if(!isset($noNavBar)){
	include $template."navbar.php";
}

?>
