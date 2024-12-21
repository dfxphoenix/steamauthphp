<?php
	$steamauth['apikey'] = ""; // Your Steam WebAPI-Key found at https://steamcommunity.com/dev/apikey
	$steamauth['domainname'] = ""; // The main URL of your website displayed in the login page
	$steamauth['logoutpage'] = "./"; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
	$steamauth['loginpage'] = "./"; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
	$steamauth['automaticallyrefresh'] = false; // Enable/disable automatically refresh Steam profile data if older than specified time when they next visit your site
?>