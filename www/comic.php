<div class="comic">
<?php
	include('rating_utils.php');
	
	include_once('db_access.php');
	db_connect();
	
	if(isset($_GET['comic']))
	{
		$curr_comic = htmlspecialchars($_GET['comic']);
		
		//check if comic exists hur
		
		if($curr_comic == 'random')
		{
			$max_comic = getLatest();
			$curr_comic = rand(1, $max_comic);
		}
		showComic($curr_comic);
	}
	else //find the latest
	{		
		showLatest();
	}
	
?>
	
</div>

<div id="bottom_bar" class="menu">
	<ul>
	<?php
		# Create all buttoms but hide which we don't want so we have a consistent layout and spacing
		if ($_SESSION['CURR_COMIC'] == 1) {
			$visibility = "hidden";
		} else {
			$visibility = "visible";
		}
		echo '<li><a href="?comic=1" style="visibility: ' . $visibility . '">First</a></li>';
		echo '<li><a href="?comic=' . getPrev() . '" style="visibility: ' . $visibility . '">Back</a></li>';
		echo '<li><a href="?comic=random">Random</a></li>';
		if($_SESSION['CURR_COMIC'] == getLatest()) {
			$visibility = "hidden";
		} else {
			$visibility = "visible";
		}
		echo '<li><a href="?comic=' . getNext() . '" style="visibility: ' . $visibility . '">Next</a></li>';
		echo '<li><a href="?comic=' . getLatest() . '" style="visibility: '. $visibility . '">Newest</a></li>';
	?>
	</ul>
</div>

<table width="900px">
	<tr>
		<td>
			<table cellspacing="5px">
				<tr>
					<td width="800px">
						<?php showRating(); ?>
					</td>
					<td valign="top" align="right">
						<?php
						echo '<a href="http://www.facebook.com/sharer.php?u=http://www.lolablecomics.com/index.php?comic=' . $_SESSION['CURR_COMIC'] .'" target="_blank"><img src="images/facebook.png"/></a>';
						?>
					</td>
					<td valign="top" align="right">
						<?php
						echo '<a href="http://twitter.com/home?status=http://www.lolablecomics.com/index.php?comic=' . $_SESSION['CURR_COMIC'] .'" target="_blank"><img src="images/twitter.png"/></a>';
						?>
					</td>
					<td valign="top" align="right">
						<?php
						echo '<a href="http://digg.com/submit?url=http://www.lolablecomics.com/index.php?comic=' . $_SESSION['CURR_COMIC'] .'&topic=comics_animation&media=image" target="_blank"><img src="images/digg.png"/></a>';
						?>
					</td>
					<td valign="top" align="right">
						<?php
						echo '<a href="http://www.stumbleupon.com/submit?url=http://www.lolablecomics.com/index.php?comic=' . $_SESSION['CURR_COMIC'] .'" target="_blank"><img src="images/stumble.png"/></a>';
						?>
					</td>
					<td valign="top" align="right">
						<?php
							global $conn;
							$result = mysqli_query($conn, "SELECT comic_name FROM comics WHERE comic_num=" . $_SESSION['CURR_COMIC']);
							$title = mysqli_fetch_row($result)[0];
							echo '<a href="http://www.reddit.com/submit?url=http://www.lolablecomics.com/index.php?comic=' . $_SESSION['CURR_COMIC'] . '&title=' . $title . ' [comic]" target="_blank"><img src="images/reddit.png"/></a>';
						?>
					</td>
				</tr>
			</table>
		</td>
	
	</tr>

	<tr  id="desc_button">
		<td>
			<p style="letter-spacing:0.5px"><b><font " size="3"><a href="javascript:show_description()" style="color:black">Don't Get This Comic? Click Here</a></font></b></p>
		</td>
	</tr>


	<tr id="description_text" style="display:none">
		<td>
			<?php showDescription(); ?>
		</td>
	</tr>
	<tr  id="hide_link" style="display:none">
		<td>
			<p style="letter-spacing:0.5px"><b><font size="3"><a href="javascript:hide_description()" style="color:black">OK, Now I Get It</a></font></b></p>
		</td>
	</tr>



<div class="blog">

<tr><td>
</br></br>
<table width="800px" align="center" cellspacing="0" cellpadding="0">
<?php
include('blog_functions.php');
include_once('db_access.php');
# Find related blogs (if any) and display them
global $conn;

$curr_comic = $_SESSION['CURR_COMIC'];
$sql = <<<EOT
  SELECT id FROM blogs
  JOIN (users) ON (blogs.user_id = users.user_id)
  WHERE comic_id = $curr_comic;
EOT;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
	display_blog($row[0]);
}
?>
</table>
</td></tr>
</div>
</table>

<script language="JavaScript">
	var xmlHttp;
	var new_rating=-1;

	function show_description()
	{
		document.getElementById('desc_button').style.display = 'none';
		document.getElementById("hide_link").style.display = 'block';
		document.getElementById('description_text').style.display = 'block';
	}
	
	function hide_description()
	{
		document.getElementById('desc_button').style.display = 'block';
		document.getElementById("hide_link").style.display = 'none';
		document.getElementById('description_text').style.display = 'none';
	}
	
	function highlight_stars(num_stars)
	{
		for(i=1;i<=5;i++)
		{
			if(num_stars >= i)
				document.images['star_' + i].src = 'images/star_full.png';
			else if(num_stars >= (i-0.5))
				document.images['star_' + i].src = 'images/star_half.png';
			else
				document.images['star_' + i].src = 'images/star_empty.png';
		}
		
		switch(num_stars)
		{
		case 1:
			document.getElementById('rating_desc').innerHTML='sigh';
			break;
		case 2:
			document.getElementById('rating_desc').innerHTML='meh';
			break;
		case 3:
			document.getElementById('rating_desc').innerHTML='lol';
			break;
		case 4:
			document.getElementById('rating_desc').innerHTML="I lol'd";
			break;
		case 5:
			document.getElementById('rating_desc').innerHTML="I lol'd all over the place!";
			break;
		default:
			document.getElementById('rating_desc').innerHTML='';
			break;
		}

	}
	
	function restore_rating(old_rating)
	{
		if(new_rating==-1)
			highlight_stars(old_rating);
		else
			highlight_stars(new_rating);
			
		document.getElementById('rating_desc').innerHTML = '';
	}
	
	
	function set_rating(comic_num,rating)
	{
		new_rating=rating;
		xmlHttp=GetXmlHttpObject();
		xmlHttp.open("GET","ajax_requests/set_rating.php?comic=" + comic_num + "&rating=" + rating,true);
		xmlHttp.send(null);
	}
	
	/*
	function set_rating_received()
	{
		if (xmlHttp.readyState==4)
		{
			alert(xmlHttp.responseText);
		}
	}
	*/
	
	function GetXmlHttpObject()
	{
		var xmlHttp=null;
		
		try
		{
		  // Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch (e)
		{
		  // Internet Explorer
			try
			{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		
		return xmlHttp;
	}
	


</script>

<?php db_close(); ?>


<?php

	function showLatest()
	{
		showComic(getLatest());
	}
	
	function showComic($num)
	{
			global $conn;
			$_SESSION['CURR_COMIC'] = $num;
			
			$result = mysqli_query($conn, "SELECT file FROM comics WHERE comic_num=" . $num);
			
			if(mysqli_num_rows($result) == 0)
				showError();
			else
				echo '<img src="comics/' . mysqli_fetch_row($result)[0] . '"/>';
				
	}
	
	function showDescription()
	{
		global $conn;

		$result = mysqli_query($conn, "SELECT comic_description FROM comics WHERE comic_num=" . $_SESSION['CURR_COMIC']);
		if(mysqli_num_rows($result) == 0)
			echo "Error, could not find description";
		else
			echo '<font size="3">' . mysqli_fetch_row($result)[0];
	}
	
	function showRating()
	{
		$rating = getUserRating($_SESSION['CURR_COMIC']);
		
		if($rating == -1)
			$rating = getAverageRating($_SESSION['CURR_COMIC']);
			
			
		if(!isset($rating))
			$rating = 0;

			
		echo '<table cellspacing="0" width="400px">';
		echo '<tr height="45px">';
		echo '<td>';
		echo '<b><font size="3">RATE THIS COMIC:</font> </b>';
		echo '</td>';
		echo '<td>';
		for($i=1;$i<=5;$i++)
		{
			if($rating >= $i)
				echo '<img name="star_' . $i . '" src="images/star_full.png" onMouseOver="javascript:highlight_stars(' . $i . ')" onMouseOut="javascript:restore_rating(' . $rating . ')" onClick="javascript:set_rating(' . $_SESSION['CURR_COMIC'] . ',' . $i  . ')">';
			else if($rating >= ($i-0.5))
				echo '<img name="star_' . $i . '" src="images/star_half.png" onMouseOver="javascript:highlight_stars(' . $i . ')" onMouseOut="javascript:restore_rating(' . $rating . ')" onClick="javascript:set_rating(' . $_SESSION['CURR_COMIC'] . ',' . $i  . ')">';
			else
				echo '<img name="star_' . $i . '" src="images/star_empty.png" onMouseOver="javascript:highlight_stars(' . $i . ')" onMouseOut="javascript:restore_rating(' . $rating . ')" onClick="javascript:set_rating(' . $_SESSION['CURR_COMIC'] . ',' . $i . ')">';
		}
		echo '</td>';

		echo '<td width="10px">';
		echo '</td>';
		echo '<td width="100px">
			<font size="2"><i><p id="rating_desc"></p></i></font>
			</td>';
		echo '</tr>';
		echo '</table>';

	}
	
	//put functions here
	function getPrev()
	{
		if($_SESSION['CURR_COMIC'] > 1)
		{
			return $_SESSION['CURR_COMIC'] -1;
		}
		else
			return 1;
	}
	
	function getNext()
	{
		//find latest
		if($_SESSION['CURR_COMIC'] < (int)getLatest())
		{
			return $_SESSION['CURR_COMIC'] + 1;
		}
			return getLatest();
	}
	

	function getLatest()
	{
		global $conn;
		$result = mysqli_query($conn, "SELECT MAX(comic_num) FROM comics");
		return mysqli_fetch_row($result)[0];
	}
	
	function showError()
	{
		echo '<table width="900px" bgcolor="white">
				<tr><td width="900px">
					Error, Comic Does Not Exist
				</tr></td>
			</table>';
	}
	

?>
