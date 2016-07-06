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
		

			<div class="top_bar">
				<img name="comic_top_bar" src="images/top_bar.png" usemap="#topbarmap" border="0">
			</div>

			<map name="topbarmap">
				<area shape="rect" coords="180,0,240,25" href="?action=about" onmouseover="swap_image('comic_top_bar','images/highlight_about.png')" onmouseout="swap_image('comic_top_bar','images/top_bar.png')"  />
				<area shape="rect" coords="270,0,340,25" href="?action=archive" onmouseover="swap_image('comic_top_bar','images/highlight_archive.png')" onmouseout="swap_image('comic_top_bar','images/top_bar.png')" />
				<area shape="rect" coords="370,0,440,25" target="_blank" onmouseover="swap_image('comic_top_bar','images/highlight_forum.png')" onmouseout="swap_image('comic_top_bar','images/top_bar.png')" />
				<area shape="rect" coords="480,0,510,25" href="?action=faq" onmouseover="swap_image('comic_top_bar','images/highlight_faq.png')" onmouseout="swap_image('comic_top_bar','images/top_bar.png')" />
				<area shape="rect" coords="550,0,625,25" href="?action=contact" onmouseover="swap_image('comic_top_bar','images/highlight_contact.png')" onmouseout="swap_image('comic_top_bar','images/top_bar.png')" />
				<area shape="rect" coords="660,0,720,25" href="?action=extras" onmouseover="swap_image('comic_top_bar','images/highlight_extras.png')" onmouseout="swap_images('comic_top_bar','images/top_bar.png')" />
			</map>

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
