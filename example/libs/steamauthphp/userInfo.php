<?php
	if(!empty($steamauth['apikey']) && !empty($_SESSION['steam_steamid']) && (empty($_SESSION['steam_uptodate']) || empty($_SESSION['steam_personaname'])))
	{
		// Construct the Steam API URL using the API key and user's Steam ID
		$url = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steam_steamid'];

		// Initialize cURL session
		$ch = curl_init();

		// Set cURL options for the request
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		// Execute the API call
		$response = curl_exec($ch);

		// Check for cURL errors
		$errno = curl_errno($ch);

		if($errno)
		{
			if($errno != 28)
			{
				error_log('cURL #'.$errno.': '.curl_error($ch));
			}

			curl_close($ch);

			unset($_SESSION['steam_steamid']);
			$_SESSION['steam_error'] = "Unable to connect to the Steam API!";
			$steamprofile = [
				'error' => $_SESSION['steam_error'],
			];
			return;
		}

		// Close the cURL session
		curl_close($ch);

		// Decode the JSON response from the API
		$data = json_decode($response, true);

		// Extract player data from the API response (handle missing data with defaults)
		$player = $data['response']['players'][0] ?? [];

		// Checks if the player data is empty and handles the error
		if(empty($player))
		{
			unset($_SESSION['steam_steamid']);
			$_SESSION['steam_error'] = "Invalid Steam API!";
			$steamprofile = [
				'error' => $_SESSION['steam_error'],
			];
			return;
		}

		// Updates the session with player data or default values if unavailable
		$_SESSION['steam_communityvisibilitystate'] = $player['communityvisibilitystate'] ?? 0;
		$_SESSION['steam_profilestate'] = $player['profilestate'] ?? 0;
		$_SESSION['steam_personaname'] = $player['personaname'] ?? 'Unknown';
		$_SESSION['steam_lastlogoff'] = $player['lastlogoff'] ?? 0;
		$_SESSION['steam_profileurl'] = $player['profileurl'] ?? '';
		$_SESSION['steam_avatar'] = $player['avatar'] ?? '';
		$_SESSION['steam_avatarmedium'] = $player['avatarmedium'] ?? '';
		$_SESSION['steam_avatarfull'] = $player['avatarfull'] ?? '';
		$_SESSION['steam_personastate'] = $player['personastate'] ?? 0;
		$_SESSION['steam_realname'] = $player['realname'] ?? 'Real name not given';
		$_SESSION['steam_primaryclanid'] = $player['primaryclanid'] ?? '';
		$_SESSION['steam_timecreated'] = $player['timecreated'] ?? 0;
		$_SESSION['steam_uptodate'] = time();
	}

	// Create a profile array with session data for easier access
	$steamprofile = [
		'steamid' => $_SESSION['steam_steamid'] ?? NULL,
		'communityvisibilitystate' => $_SESSION['steam_communityvisibilitystate'] ?? NULL,
		'profilestate' => $_SESSION['steam_profilestate'] ?? NULL,
		'personaname' => $_SESSION['steam_personaname'] ?? NULL,
		'lastlogoff' => $_SESSION['steam_lastlogoff'] ?? NULL,
		'profileurl' => $_SESSION['steam_profileurl'] ?? NULL,
		'avatar' => $_SESSION['steam_avatar'] ?? NULL,
		'avatarmedium' => $_SESSION['steam_avatarmedium'] ?? NULL,
		'avatarfull' => $_SESSION['steam_avatarfull'] ?? NULL,
		'personastate' => $_SESSION['steam_personastate'] ?? NULL,
		'realname' => $_SESSION['steam_realname'] ?? NULL,
		'primaryclanid' => $_SESSION['steam_primaryclanid'] ?? NULL,
		'timecreated' => $_SESSION['steam_timecreated'] ?? NULL,
		'uptodate' => $_SESSION['steam_uptodate'] ?? NULL,
		'error' => $_SESSION['steam_error'] ?? NULL
	];
?>