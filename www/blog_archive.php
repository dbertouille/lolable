<img src="images/banner_blogs.png"/>

<br><br>


<?php
	$blogs_per_page = 10;
	
	if(isset($_GET['page']))
		$page = htmlspecialchars($_GET['page']);
	else
		$page = 1;
		
	if($page < 1)
		$page = 1;

	
	include_once('db_access.php'); //since it was likely included somewhere already
	db_connect();
	
	$result = mysql_query("SELECT COUNT(*) FROM blogs");
	$num_blogs = mysql_result($result,0,0);	
	db_close();
	
	$start = $page * $blogs_per_page;
	$end = min($start + $blogs_per_page, $num_blogs);
	
	echo '<table width="800px" align="center" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left">';
				
				if(($page+1) * $blogs_per_page < $num_blogs)
					echo '<b><font size="2"><a href=?action=blog_archive&page=' . ($page + 1) . ' style="color:black">Older Blogs</a></font></b>';
			echo'<td align="right">';
				if($page > 1)
					echo '<b><font size="2"><a href=?action=blog_archive&page=' . ($page - 1) . ' style="color:black">Newer Blogs</a></font></b>';
			echo '</td>
			</tr>
		</table>';
		
	echo '<br><br>
		<table width="800px" align="center" cellspacing="0" cellpadding="0">';
		
	include_once("blog_functions.php");
	display_blogs(10,$start);
	
?>

</br></br>