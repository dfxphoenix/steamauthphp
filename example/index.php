<?php
	include 'auth/steam_config.php';
	include 'libs/steamauthphp/steamauth.php';
	include 'libs/steamauthphp/userInfo.php';
?>
<HTML>
<head>
	<title>Steam Auth PHP</title>
</head>
<body>
	<?php if(isset($steamprofile['error'])) { ?>
		<p><?php echo $steamprofile['error']; ?></p>
	<?php } ?>
	<?php if(!isset($steamprofile['steamid'])) { ?>
		<?php loginbutton(); ?>
	<?php } else { ?>
		<p>Logged as <b><?php echo $steamprofile['personaname']; ?></b>.</p>
		<?php logoutbutton(); ?>
	<?php } ?>
</body>
</HTML>
