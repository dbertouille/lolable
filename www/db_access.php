<?php

	$conn = null;
		
	function db_connect()
	{
		$dbhost = 'SETME';
		$dbuser = 'SETME';
		$dbpass = 'SETME';
		$dbname = 'SETME';

		if(!isset($conn))
		{
			$conn = mysql_connect($dbhost,$dbuser,$dbpass);
			mysql_select_db($dbname);
		}
	}
	
	function db_close()
	{
		if(isset($conn))
			mysql_close($conn);
	}
?>
