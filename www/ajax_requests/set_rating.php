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
			
			//check if comic exists
			$result = mysql_query('SELECT * FROM comics WHERE comic_num=' . $comic);
			
			if(mysql_numrows($result) != 0)
			{
				mysql_query("REPLACE INTO ratings(ip,comic_num,rating) VALUES(INET_ATON('" . $ip . "')," .$comic . ',' . $rating . ')');
			}
			
			db_close();
		}
	}

?>
