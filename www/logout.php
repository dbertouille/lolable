<?php
	session_start();

	//phpBB login
	//some variables/defines used in the phpBB includes
	define('IN_PHPBB',true);
	$phpbb_root_path = "/home5/lolablec/www/forums/";
	$phpEx = "php";
	
	if(file_exists('/home5/lolablec/www/forums/common.php'))
	{
		require_once('/home5/lolablec/www/forums/common.php');
		
		$user->session_kill();
		$user->session_begin();
	}

	
	unset($_SESSION['curr_user_id']);
	unset($_SESSION['curr_user_email']);
	unset($_SESSION['curr_user_screen_name']);
	unset($_SESSION['curr_user_is_admin']);
	
	//remove the cookie if set
	if(isset($_COOKIE["lolablecomics"]))
		setcookie("lolablecomics","",time() - 1);
	
?>
<html>
	<meta http-equiv="REFRESH" content="0;url=index.php">
</html>