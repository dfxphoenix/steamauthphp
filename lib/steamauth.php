<?php
	// Start output buffering and session
	ob_start();
	session_start();

	// Include required functions
	require 'functions.php';

	// Clear any previous error from session
	unset($_SESSION['steam_error']);

	// Check if the Steam API Key is provided
	if(empty($steamauth['apikey']))
	{
		$_SESSION['steam_error'] = "Please supply a Steam API-Key!";
		redirectToPage($steamauth['loginpage']); // Redirect to login page
	}

	// Set default domain name if not provided
	if(empty($steamauth['domainname']))
	{
		$steamauth['domainname'] = $_SERVER['SERVER_NAME'];
	}

	// Handle the login process
	if(isset($_GET['login']))
	{
		// Include the LightOpenID library
		require 'libs/lightopenid/openid.php';

		try
		{
			$openid = new LightOpenID($steamauth['domainname']);

			if(!$openid->mode)
			{
				// Redirect user to Steam OpenID authentication page
				$openid->identity = 'https://steamcommunity.com/openid';
				redirectToPage($openid->authUrl());
			}
			elseif($openid->mode === 'cancel')
			{
				// Handle authentication cancellation
				$_SESSION['steam_error'] = 'User has canceled authentication!';
				redirectToPage($steamauth['loginpage']); // Redirect to login page
			}
			else
			{
				// Validate the OpenID response
				if($openid->validate())
				{
					$id = $openid->identity;

					// Extract the Steam ID from the OpenID URL
					$pattern = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
					if(preg_match($pattern, $id, $matches))
					{
						$_SESSION['steam_steamid'] = $matches[1];
						redirectToPage($steamauth['loginpage']); // Redirect to login page
					}
					else
					{
						$_SESSION['steam_error'] = "Invalid Steam ID format.";
						redirectToPage($steamauth['loginpage']); // Redirect to login page
					}
				}
				else
				{
					// Handle login validation failure
					$_SESSION['steam_error'] = "User is not logged in.";
					redirectToPage($steamauth['loginpage']); // Redirect to login page
				}
			}
		}
		catch(ErrorException $e)
		{
			// Log any errors during the process
			error_log("Error: ".htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
		}
	}

	// Handle the logout process
	if(isset($_GET['logout']))
	{
		// Clear session data and redirect to the logout page
		session_unset();
		session_destroy();
		redirectToPage($steamauth['logoutpage']);
	}

	// Check for automatic profile refresh
	if($steamauth['automaticallyrefresh'])
	{
		// Reset profile update timestamp and refresh user info
		if(isset($_GET['update']) || !empty($_SESSION['steam_uptodate']) && $_SESSION['steam_uptodate']+(24*60*60) < time())
		{
			unset($_SESSION['steam_uptodate']);
			require 'userInfo.php';
			redirectToPage($steamauth['loginpage']);
		}
	}
	else
	{
		// Manual profile refresh
		if(isset($_GET['update']))
		{
			unset($_SESSION['steam_uptodate']);
			require 'userInfo.php';
			redirectToPage($steamauth['loginpage']);
		}
	}
?>