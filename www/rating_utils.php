<?php
	function getUserRating($comic_num)
	{
		global $conn;

		$result = mysqli_query($conn, "SELECT rating FROM ratings WHERE comic_num=" . $comic_num . " AND ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')");
			
		if(mysqli_num_rows($result) == 0)
			return -1;
		else
			return mysqli_fetch_row($result)[0];
	}
	
	function getAverageRating($comic_num)
	{
		global $conn;

		$result = mysqli_query($conn, "SELECT AVG(rating) FROM ratings WHERE comic_num = " . $comic_num);
		$avg = mysqli_fetch_row($result)[0];
		$avg = round($avg,1);
		return $avg;
	}
	
	function getRatingCount($comic_num)
	{
		global $conn;

		$result = mysqli_query($conn, "SELECT COUNT(rating) FROM ratings WHERE comic_num=" . $comic_num);
		return mysqli_fetch_row($result)[0];
	}
?>
