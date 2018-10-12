<?php 
session_start();

/*
 STEP1 This to check if user is login in web site ,Than include main component for web site
*/

if(isset($_SESSION['UserName']))
{
	$pageTitle='Dashboard';
	include 'init.php';
/*
STEP2 Here Make Component for this page
*/

	echo "Wellcom".' '.$_SESSION['UserName'];


	include $template."footer.php";
}
else
{
	/*
STEP3 If user does not login in website redirect him to login paget
*/
	header('location:login.php');
		exit();
}



?> 