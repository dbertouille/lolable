<?php
	function getUserRating($comic_num)
	{
		$result = mysql_query("SELECT rating FROM ratings WHERE comic_num=" . $comic_num . " AND ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')");
			
		if(mysql_numrows($result) == 0)
			return -1;
		else
			return mysql_result($result,0,"rating");
	}
	
	function getAverageRating($comic_num)
	{
		$result = mysql_query("SELECT AVG(rating) FROM ratings WHERE comic_num=" . $comic_num);
		$avg = mysql_result($result,0,"AVG(rating)");
		$avg = round($avg,1);
		return $avg;
	}
	
	function getRatingCount($comic_num)
	{
		$result = mysql_query("SELECT COUNT(rating) FROM ratings WHERE comic_num=" . $comic_num);
		return mysql_result($result,0,"COUNT(rating)");
	}
?>
