<?php
	if(isset($_GET['blog']) && is_numeric($_GET['blog']))
	{
		$blog_id = htmlspecialchars($_GET['blog']);
		include_once('blog_functions.php');
		
		echo '<br><br><table width="800px" align="center" cellspacing="0" cellpadding="0">';
		display_blog($blog_id);
		echo '</table>';
	}
?>