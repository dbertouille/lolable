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





<?php


	if($_SESSION['CURR_COMIC']==1)
	{
		echo '<div class="bottom_bar">
				<img name="comic_bot_bar" src="images/bot_bar_first.png" usemap="#botbarmap" border="0">
			</div>
			<map name="botbarmap">';
			
		echo '<area shape="rect" coords="415,0,485,19" href="?comic=random"  onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_random_first.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_first.png\')" />';
		echo '<area shape="rect" coords="515,0,560,19" href="?comic=' . getNext() . '" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_next_first.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_first.png\')" />';
		echo '<area shape="rect" coords="605,0,675,19" href="?" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_new_first.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_first.png\')" />';
		echo '</map>';
	}
	else if($_SESSION['CURR_COMIC'] == getLatest())
	{
		echo '<div class="bottom_bar">
				<img name="comic_bot_bar" src="images/bot_bar_last.png" usemap="#botbarmap" border="0">
			</div>
			<map name="botbarmap">';
			
		echo '<area shape="rect" coords="230,0,280,19" href="?comic=1" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_first_last.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_last.png\')" />';
		echo '<area shape="rect" coords="340,0,380,19" href="?comic=' . getPrev() . '"  onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_back_last.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_last.png\')"/>';
		echo '<area shape="rect" coords="415,0,485,19" href="?comic=random"  onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_random_last.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/bot_bar_last.png\')" />';
		echo '</map>';
	}
	else
	{
		echo '<div class="bottom_bar">
				<img name="comic_bot_bar" src="images/comic_bot_bar.png" usemap="#botbarmap" border="0">
			</div>
			<map name="botbarmap">';
			
		echo '<area shape="rect" coords="230,0,280,19" href="?comic=1" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_first.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/comic_bot_bar.png\')" />';
		echo '<area shape="rect" coords="340,0,380,19" href="?comic=' . getPrev() . '"  onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_back.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/comic_bot_bar.png\')"/>';
		echo '<area shape="rect" coords="415,0,485,19" href="?comic=random"  onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_random.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/comic_bot_bar.png\')" />';
		echo '<area shape="rect" coords="515,0,560,19" href="?comic=' . getNext() . '" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_next.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/comic_bot_bar.png\')" />';
		echo '<area shape="rect" coords="605,0,675,19" href="?" onmouseover="swap_image(\'comic_bot_bar\',\'images/highlight_newest.png\')" onmouseout="swap_image(\'comic_bot_bar\',\'images/comic_bot_bar.png\')" />';
		echo '</map>';
	}
?>

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
							$title = mysql_result(mysql_query("SELECT comic_name FROM comics WHERE comic_num=" . $_SESSION['CURR_COMIC']),0,"comic_name");
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
	<?php include('blog.php');?>
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
			$_SESSION['CURR_COMIC'] = $num;
			
			$result = mysql_query("SELECT file FROM comics WHERE comic_num=" . $num);
			
			if(mysql_numrows($result) == 0)
				showError();
			else
				echo '<img src="comics/' . mysql_result($result,0,"file") . '"/>';
				
	}
	
	function showDescription()
	{
		$result = mysql_query("SELECT comic_description FROM comics WHERE comic_num=" . $_SESSION['CURR_COMIC']);
		if(mysql_numrows($result) == 0)
			echo "Error, could not find description";
		else
			echo '<font size="3">' . mysql_result($result,0,"comic_description") . '</font>';
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
		$result = mysql_query("SELECT MAX(comic_num) FROM comics");
		
		return mysql_result($result,0,"MAX(comic_num)");
		
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
