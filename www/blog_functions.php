<?php
function display_blogs($limit, $start=0)
{
	include_once('db_access.php'); //since it was likely included somewhere already
	db_connect();
	
	global $conn;

	$result = mysqli_query($conn, "SELECT * FROM blogs JOIN(users) ON(blogs.user_id = users.user_id) ORDER BY time DESC LIMIT " . $start . ',' . $limit);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$blog["time"] = $row["time"];
		$blog["screen_name"] = $row["screen_name"];
		$blog["avatar"] = $row["avatar"];
		$blog["title"] = $row["title"];
		$blog["blog"] = $row["blog"];
		$blog["id"] = $row["id"];
		render_blog($blog);
		
	}
	
	db_close();
}

function display_blog($blog_id)
{
	include_once('db_access.php');
	db_connect();

	global $conn;
	
	$result = mysqli_query($conn, "SELECT * FROM blogs JOIN(users) ON(blogs.user_id = users.user_id) WHERE blogs.id = " . $blog_id . " LIMIT 1");
	if(mysqli_num_rows($result) == 1)
	{
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$blog["time"] = $row["time"];
		$blog["screen_name"] = $row["screen_name"];
		$blog["avatar"] = $row["avatar"];
		$blog["title"] = $row["title"];
		$blog["blog"] = $row["blog"];
		$blog["id"] = $row["id"];
		render_blog($blog);
	}
	
	db_close();
}

function render_blog($blog)
{
	$date_time = explode(" ",$blog["time"]);
	
	echo	'<tr>
			<td background="images/corner_top_left.png" height="40px">
			</td>
			<td background="images/line_top.png" colspan="2">
			</td>
			<td background="images/corner_top_right.png">
			</td>
		</tr>';

	echo '<tr>
			<td background="images/line_left.png"></td>
			<td background="images/white_alpha_43.png" align="left" valign="top" width="125px">
				<font face="verdana" size="2"><b>' . $blog["screen_name"] .'</b></font></br>
				<img border="2" width="75px" height="75px" src="avatars/' . $blog["avatar"] . '"/></br>
				<font face="verdana" size="2">' . $date_time[0] . '</font></br>
				<font face="verdana" size="2">' . $date_time[1] . ' CST </font></br></br>
				
			</td>
			<td background="images/white_alpha_43.png"> 
					<p><b><font face="verdana">' . str_replace("\n","</br>",$blog["title"]) . '</font></b></p>
					<p><font face="verdana">' . str_replace("\n","</br>",$blog["blog"]) . '</font></p></br></br>
					<p align="right"><font size="2"><b><a href="?action=show_blog&blog=' . $blog["id"] . '" style="color:black">Permalink</a></b></font></p>
			</td>
			<td background="images/line_right.png"></td>
		</tr>';
		
	echo '<tr>
			<td background="images/corner_bot_left.png" height="40px" width="40px">
			</td>
			<td colspan="2" background="images/line_bottom.png">
			</td>
			<td background="images/corner_bot_right.png" width="40px">
			</td>
		</tr>';
		
	echo '<tr height="25px"></tr>';
}

?>
