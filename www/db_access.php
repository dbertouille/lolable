<?php

	$conn = null;
		
	function db_connect()
	{
		global $conn;

		if(!isset($conn))
		{
			$conn = mysqli_connect(
			    '127.0.0.1',
			    ini_get('mysqli.default_user'),
			    ini_get('mysqli.default_pw'),
			    "lolable");
		}
	}
	
	function db_close()
	{
		global $conn;

		if(isset($conn))
		{
			mysqli_close($conn);
			$conn = null;
		}
	}
?>
