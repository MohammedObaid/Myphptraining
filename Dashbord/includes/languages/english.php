<?php

function lang($keyword)
{
	static $lang=array(

		/////////////NavBar Titles////////////////
		"MESSAGE"=>"Wellcome in English Words",
		"Home"=>"Dashboard",
		"Categories"=>"Sections",
		"Items"=>"Items",
		"Members"=>"Members",
		"Statistic"=>"Statistic",
		"Logs"=>"Logs",
		"Alternativ"=>"Alternativ",	
		"Editprofile"=>"Edit Profile",		
"Setting"=>"Setting",	
"Logout"=>"Logout",	
		);
	return $lang[$keyword];
}
?>
