<?php header("Content-type: text/xml"); ?>

<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>
	<title>Lolable Comics Podcast</title>
	<link>http://www.lolablecomics.com</link>
	<language>en-us</language>
	<copyright>&#xA9; 2010 Lolable Comics</copyright>
	<itunes:subtitle>The Lolcast</itunes:subtitle>
	<itunes:author>Kyle Feduniw</itunes:author>
	<itunes:summary> Listen as Kyle, Dave and Greg think of ideas for Lolable comics and other lolable discussion.  Special guests include our hockey insider, Ian, our comic insider, Ian, and many more!! </itunes:summary>
	<description>Listen as Kyle, Dave and Greg think of ideas for Lolable comics and other lolable discussion.  Special guests include our hockey insider, Ian, our comic insider, Ian, and many more!! </description>
	<itunes:owner>
		<itunes:name>Kyle Feduniw</itunes:name>
		<itunes:email>kyle@lolablecomics.com</itunes:email>
	</itunes:owner>
	<itunes:image href="http://www.lolablecomics.com/images/lolable_logo.png" />
	<itunes:category text="Web Comics"/>

<?php
	include('db_access.php');
	db_connect();
	
	$podcasts = mysql_query("SELECT * FROM podcasts ORDER BY date_posted DESC");
	$num_podcasts =mysql_numrows($podcasts);
	
	for ( $i  = 0; $i < $num_podcasts; $i++)
	{
		$podcast_title = mysql_result($podcasts, $i, "title");
		$podcast_desc = mysql_result($podcasts, $i, "description");
		$podcast_file = "podcasts/" . mysql_result($podcasts,$i,'file');
		$podcast_url= 'http://www.lolablecomics.com/' . $podcast_file;
		$podcast_posted_date = mysql_result($podcasts, $i, 'date_posted');
		$podcast_filesize = filesize($podcast_file);
		$podcast_duration_seconds = mysql_result($podcasts, $i, 'runtime');
		$podcast_duration = (int)($podcast_duration_seconds / 60 ) . ':' . $podcast_duration_seconds % 60;
		
		echo	'<item>
				<title> ' . $podcast_title . '</title>
				<itunes:author>Lolable Comics</itunes:author>
				<itunes:summary>' . $podcast_desc . '</itunes:summary>
				<enclousre url="' . $podcast_url . '" length="' . $podcast_filesize . '" type="audio/mpeg" />
				<pubDate> ' . $podcast_posted_date . '</pubDate>
				<itunes:duration> ' . $podcast_duration . '</itunes:duration>
				<itunes:keywords> lolable, comics, web comics, lolable comics </itunes:keywords>
			</item>';
	}
	
	db_close();
?>

</channel>
</rss>