<?php

/*
This function to get page title ,If any error accoure get defualt name for page title
*/
function getTitlt()
{
	global  $pageTitle;
	if(isset($pageTitle))
	{
		echo $pageTitle;

	}
	else{
			echo "Default Title";
	}
}




?>