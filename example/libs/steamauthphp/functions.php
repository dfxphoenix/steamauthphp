<?php
	/**
	* Generates a logout button for the user.
	* When the button is clicked, it sends a GET request with the 'logout' parameter.
	*/
	function logoutbutton()
	{
		echo "<form action='' method='get'><button name='logout' type='submit'>Logout</button></form>";
	}

	/**
	* Generates a login button for Steam using a specified style.
	*
	* @param string $buttonstyle The style of the button, can be "square" or "rectangle". Defaults to "square".
	*/
	function loginbutton($buttonstyle = "square")
	{
		$button['rectangle'] = "01";
		$button['square'] = "02";
		$button = "<a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
		
		echo $button;
	}

	/**
	 * Redirects to a specified page using headers or JavaScript fallback.
	 *
	 * @param string $url URL to redirect to
	 */
	function redirectToPage($url)
	{
		// Check if there's an error in the session
		if(isset($_SESSION['steam_error']))
		{
			return;
		}

		// Check if headers have already been sent
		if(!headers_sent())
		{
			header('Location: '.$url);
		}
		else
		{
			// Fallback to JavaScript redirection
			echo "<script type=\"text/javascript\">window.location.href='$url';</script>";
			echo "<noscript><meta http-equiv=\"refresh\" content=\"0;url=$url\" /></noscript>";
		}
		exit;
	}
?>
