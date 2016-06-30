<?php header("Content-type: text/xml"); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>
<rss version="2.0">
<channel>
<title>Lolable Comics</title>
<link>http://www.lolablecomics.com</link>
  
  <?php
  
  include('db_access.php');
  db_connect();
  
  $comics = mysql_query("SELECT * FROM comics ORDER BY date DESC LIMIT 10");
  $num_comics = mysql_numrows($comics);
  
  $blogs = mysql_query("SELECT * FROM blogs ORDER BY time DESC LIMIT 10");
  $num_blogs = mysql_numrows($blogs);
  
  $comic_index=0;
  $blog_index=0;

  for($i=0;$i<($num_comics + $num_blogs);$i++)
  {
	if($comic_index < $num_comics)
	{
		$comic_date = mysql_result($comics,$comic_index,"date");
	}
	else
	{
		$comic_date = "0";
	}
	
	if($blog_index < $num_blogs)
	{
		$blog_date = mysql_result($blogs,$blog_index,"time");
	}
	else
	{
		$blog_date = "0";
	}


	$title='';
	$description='';
	$link='';
	$pubdate="";
	
	if($comic_date > $blog_date)
	{
		$title = 'New Comic - ' . mysql_result($comics,$comic_index,"comic_name");
		$link = "http://www.lolablecomics.com/index.php?comic=" . mysql_result($comics,$comic_index,"comic_num");
		$pubdate = $comic_date;
		$comic_index++;
	}
	else
	{
		$title = 'New Blog - ' . mysql_result($blogs,$blog_index,"title");
		$link = "http://www.lolablecomics.com";
		$pubdate = $blog_date;
		$blog_index++;
	}
	
	echo '<item>
		<title>' . $title . '</title>
		<description>' . htmlspecialchars($description).'</description>
		<link>' . $link . '</link>
		<pubDate>' . $pubdate . '</pubDate>
		</item>';
  }
  
  db_close();
  ?>
</channel>
</rss>