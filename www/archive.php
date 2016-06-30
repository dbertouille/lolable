<img src="images/banner_archive.png"/>

</br>
</br>

<table width="800px" align="center" cellspacing="0" cellpadding="0" >
	<tr>
		<td background="images/corner_top_left.png" height="40px" width="40px">
		</td>
		<td background="images/line_top.png">
		</td>
		<td background="images/corner_top_right.png" width="40px">
		</td>
	</tr>
	<tr>
		<td background="images/line_left.png"></td>
		
		<td background="images/white_alpha_43.png">
			<table width="720px">
			<?php
				
				
				include_once("db_access.php");
				include_once("rating_utils.php");
				
				db_connect();
				

				
				if(isset($_GET["orderby"]) && $_GET["orderby"] == "date")
				{
					if(isset($_GET["order"]) && $_GET["order"] == "asc")
					{
						$result = mysql_query("SELECT * FROM comics ORDER BY date ASC");
						print_table_headers('date','asc');
					}
					else
					{
						$result = mysql_query("SELECT * FROM comics ORDER BY date DESC");
						print_table_headers('date','desc');
					}
				}
				else if(isset($_GET["orderby"]) && $_GET["orderby"] == "title")
				{
					if(isset($_GET["order"]) && $_GET["order"] == "desc")
					{
						$result = mysql_query("SELECT * FROM comics ORDER BY comic_name DESC");
						print_table_headers('title','desc');
					}
					else
					{
						$result = mysql_query("SELECT * FROM comics ORDER BY comic_name");
						print_table_headers('title','asc');
					}
				}
				else if(isset($_GET["orderby"]) && $_GET["orderby"] == "average_rating")
				{
					if(isset($_GET["order"]) && $_GET["order"] == "asc")
					{
						$result = mysql_query("SELECT * FROM comics LEFT JOIN((SELECT AVG(rating) AS average,comic_num FROM ratings GROUP BY(comic_num)) AS r) ON(comics.comic_num = r.comic_num) ORDER BY average ASC");
						print_table_headers('average_rating','asc');

					}
					else
					{
						$result = mysql_query("SELECT * FROM comics LEFT JOIN((SELECT AVG(rating) AS average,comic_num FROM ratings GROUP BY(comic_num)) AS r) ON(comics.comic_num = r.comic_num) ORDER BY average DESC");
						print_table_headers('average_rating','desc');
					}
				}
				else if(isset($_GET["orderby"]) && $_GET["orderby"] == "user_rating" && isset($_SESSION['curr_user_id']))
				{
					if(isset($_GET["order"]) && $_GET["order"] == "asc")
					{
						$result = mysql_query("SELECT * FROM comics LEFT JOIN(ratings) ON(ratings.comic_num = comics.comic_num && ratings.user_id=" . $_SESSION['curr_user_id'] . ") ORDER BY rating ASC");
						print_table_headers('user_rating','asc');
					}
					else
					{
						$result = mysql_query("SELECT * FROM comics LEFT JOIN(ratings) ON(ratings.comic_num = comics.comic_num && ratings.user_id=" . $_SESSION['curr_user_id'] . ") ORDER BY rating DESC");
						print_table_headers('user_rating','desc');
					}
				}
				//default to date desc
				else
				{
					$result = mysql_query("SELECT * FROM comics ORDER BY date DESC");
					print_table_headers('date','desc');
				}
				
				
				echo '<tr height="10px"></tr>';
				
				$num_comics = mysql_numrows($result);
				
				for($i=0;$i<$num_comics;$i++)
				{
					$date_time = split(" ",mysql_result($result,$i,"date"));
					
					echo '<tr>
							<td>
								' . $date_time[0] . '
							</td>
							<td>
								<a style="color:black" href="?comic=' . mysql_result($result,$i,"comic_num") . '">' . mysql_result($result,$i,"comic_name") . '</a>
							</td>

							<td>
								' . get_stars(getAverageRating(mysql_result($result,$i,"comic_num"))) . '
							</td>';
						
					if(isset($_SESSION['curr_user_id']))
					{
						echo 	'<td>
								' . get_stars(getUserRating(mysql_result($result,$i,"comic_num"))) . '
							</td>';
					}
						
					echo	'</tr>';
				}
				
				db_close();
				
				function get_stars($num_stars)
				{
					$stars = '';
					for($i=1;$i<=5;$i++)
					{
						if($num_stars >= $i)
							$stars .= '<img src="images/star_full.png"/>';
						else if($num_stars >= ($i - 0.5))
							$stars .= '<img src="images/star_half.png"/>';
						else
							$stars .= '<img src="images/star_empty.png"/>';
					}
					
					return $stars;
				}
			?>
			</table>
		</td>
		
		<td background="images/line_right.png" width="40px"></td>
	</tr>
	<tr>
		<td background="images/corner_bot_left.png" height="40px" width="40px">
		</td>
		<td background="images/line_bottom.png">
		</td>
		<td background="images/corner_bot_right.png" width="40px">
		</td>
	</tr>
	<tr colspan="3" height="300px">		
	</tr>

</table>
</br>

<?php
	function print_table_headers($sort_attribute,$order)
	{
		echo '<tr>';
		
		echo '<td>';
		if($sort_attribute == "date")
		{
			if($order == "desc")
				echo '<b><a style="color:black" href="?action=archive&orderby=date&order=asc">Date Added </a></b><img src="images/arrow_down.png"/>';
			else
				echo '<b><a style="color:black" href="?action=archive">Date Added </a></b><img src="images/arrow_up.png"/>';
		}
		else 
			echo '<a style="color:black" href="?action=archive">Date Added </a>';
		echo '</td>';
			
		echo '<td>';
		if($sort_attribute == "title")
		{
			if($order == "desc")
				echo '<b><a style="color:black" href="?action=archive&orderby=title&order=asc">Title </a></b><img src="images/arrow_down.png"/>';
			else
				echo '<b><a style="color:black" href="?action=archive&orderby=title&order=desc">Title</a></b><img src="images/arrow_up.png"/>';
		}
		else
			echo '<a style="color:black" href="?action=archive&orderby=title">Title</a>';
		echo '</td>';
		
		echo '<td>';
		if($sort_attribute == "average_rating")
		{
			if($order == "desc")
				echo '<b><a style="color:black" href="?action=archive&orderby=average_rating&order=asc">Average Rating</a></b><img src="images/arrow_down.png"/>';
			else
				echo '<b><a style="color:black" href="?action=archive&orderby=average_rating&order=desc">Average Rating</a></b><img src="images/arrow_up.png"/>';
		}
		else
			echo '<a style="color:black" href="?action=archive&orderby=average_rating">Average Rating</a>';
		echo '</td>';
		
		if(isset($_SESSION['curr_user_id']))
		{
			echo '<td>';
			if($sort_attribute == "user_rating")
			{
				if($order == "desc")
					echo '<b><a style="color:black" href="?action=archive&orderby=user_rating&order=asc">My Rating</a></b><img src="images/arrow_down.png"/>';
				else
					echo '<b><a style="color:black" href="?action=archive&orderby=user_rating&order=desc">My Rating</a></b><img src="images/arrow_up.png"/>';
			}
			else
				echo '<a style="color:black" href="?action=archive&orderby=user_rating">My Rating</a>';
			echo '</td>';
		}
		
		echo '</tr>';
				
	}
?>