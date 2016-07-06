<?php
	session_start();
	if(isset($_GET['rating']) && isset($_GET['comic']))
	{
		$rating = htmlspecialchars($_GET['rating']);
		$comic = htmlspecialchars($_GET['comic']);
		$ip = $_SERVER['REMOTE_ADDR'];

		if($rating  >=1 && $rating <= 5)
		{
			include('../db_access.php');
			db_connect();

			global $conn;
			
			//check if comic exists
			$result = mysqli_query($conn, 'SELECT * FROM comics WHERE comic_num=' . $comic);
			
			if(mysqli_num_rows($result) != 0)
			{
				mysqli_query($conn, "REPLACE INTO ratings(ip,comic_num,rating) VALUES(INET_ATON('" . $ip . "')," .$comic . ',' . $rating . ')');
			}
			
			db_close();
		}
	}

?>
