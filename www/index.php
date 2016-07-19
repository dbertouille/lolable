<?php
	if (!session_start())
		echo "SESSION FAILED";
	date_default_timezone_set('America/Winnipeg')
?>
<html>
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<title>Lolable Comics</title>
<body bgcolor="#303030" style="font-family:verdana">

<div class="content" align="center">

	<table cellspacing="0" cellpadding="0">
		<td width="900px" background="images/bg.jpg" align="center">
			<table width="900px" cellspacing="0" cellpadding="0">
				<tr>
					<td width="262px">
					</td>
					
					<td width="375px">
						<div class="banner">
							<a href="?"><img src="images/lolable_logo.png" border="0"></a>
						</div>
					</td>
					
					<td align="right" width="263px">
					<?php
						echo '<br><b><font  size="2"><a href="feed.php" style="color:black"><img src="images/rss.gif"/>RSS Feed</a>&nbsp&nbsp&nbsp</br></font></b>';
					?>
					</td>
				</tr>
			</table>

			<div class="announcement">
			<?php
				include_once("db_access.php");
				global $conn;
				db_connect();
				$result = mysqli_query($conn,
				    "SELECT announcement FROM announcements " .
				    "WHERE start_time < CURRENT_TIMESTAMP AND " .
				    "end_time > CURRENT_TIMESTAMP " .
				    "ORDER BY start_time DESC LIMIT 1");
				$row = mysqli_fetch_array($result);
				if ($row) {
					echo "<table><tr><td><b>ANNOUNCENMENT:</b></td><td>" . $row[0] . "</td></tr></table>";
				}
			?>
			</div>
		
	
			<div class="menu">
				<div class="top_bar">
					<ul>
						<li><a href="?action=about">About</a></li>
						<li><a href="?action=archive">Archive</a></li>
						<li><a href="?action=extras">Podcasts</a></li>
					</ul>
				</div>
			</div>
			
			<?php
				if(!isset($_GET['action']))
					include("comic.php");
				else if($_GET['action'] == 'about')
					include("about.php");
				else if($_GET['action'] == 'archive')
					include("archive.php");
				else if($_GET['action'] == 'contact')
					include("contact.php");
				else if($_GET['action'] == 'faq')
					include("faq.php");
				else if($_GET['action'] == 'blog_archive')
					include("blog_archive.php");
				else if($_GET['action'] == 'show_blog')
					include("show_blog.php");
				else if($_GET['action'] == 'extras')
					include('extras.php');
				else
					include("comic.php");
					
			?>
			<div class="footer">
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td  background="images/footer.png" height="75px" width="900px">
						<p align="center" style="color:white"><font size="2">© 2009 Lolable Comics.  All Rights Reserved.  Webmaster: <a href="mailto:webmaster@lolablecomics.com">webmaster@lolablecomics.com</a></font></p>
					</td>
				</tr>
				</table>
			</div>
		</td>
	</table>
</div>
</body>
</html>

<script languague="JavaScript">
	function swap_image(imgName,newImage)
	{
		document.images[imgName].src = newImage;
	}
</script>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9574904-1");
pageTracker._trackPageview();
} catch(err) {}</script>
