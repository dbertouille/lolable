<img src="images/banner_extras.png"/>

<h2>Podcasts</h2>
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
			<td background="images/line_left.png" width="40px"></td>
			<td background="images/white_alpha_43.png">
				<table width="100%">
					<?php
						include_once("db_access.php");
						db_connect();
						
						$result = mysql_query("SELECT * FROM podcasts ORDER BY date_posted DESC");
						
						while($row = mysql_fetch_assoc($result))
						{
								$timestamp = mysql_result(mysql_query("SELECT UNIX_TIMESTAMP(date_posted) FROM podcasts WHERE id=" . $row['id']),0,0);
								echo 	'<tr>
										<td valign="bottom">
											' . $row['title'] . '
										</td>
										<td valign="bottom">
											<font size="1"><i>' . date("M-d-Y",$timestamp) . '</i></font>
										</td>
										<td valign="bottom">
											' . str_pad((int)($row['runtime']/60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($row['runtime']%60, 2, '0', STR_PAD_LEFT) . '
										</td>
										<td width="300px" valign="bottom" align="center">';
								echo	'		<a href="podcasts/' . $row['file'] . '" style="color:black">Listen</a>';
								//echo	'		<embed src="podcasts/' . $row['file'] . '" autostart="false" height="16"/>';
								//echo  '		<embed type="application/x-shockwave-flash" src="http://www.google.com/reader/ui/3247397568-audio-player.swf?audioUrl=podcasts/' . $row['file'] . '" width="300" height="25" allowscriptaccess="never" quality="best" bgcolor="#ffffff" wmode="window" flashvars="playerMode=embedded" />';
								//echo	'		<embed type="application/x-shockwave-flash" src="http://www.odeo.com/flash/audio_player_standard_gray.swf" width="300" height="25" flashvars="audio_duration=' . $row['runtime'] .'&amp;external_url=podcasts/' . $row['file'] . '"/>';
								//echo	'		<audio src="podcasts/' . $row['file'] .'" controls="controls">Your browser does not support HTML 5</audio>';
								echo	'	</td>
									</tr>
									<tr>
										<td colspan="4" valign="bottom">
											<font size="2">' . $row['description'] . '</font><br/><br/>
										</td>
									</tr>';
						}
						
						db_close();
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

</table>
<br/>
<br/>

