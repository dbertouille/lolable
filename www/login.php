<?php
	
	$er='';
	$username='';
	$pass='';
	
	//form submitted
	if(isset($_POST['username']))
	{
		include_once('db_access.php');
		db_connect();
		global $conn;

		$username = htmlspecialchars($_POST['username']);
		$pass = htmlspecialchars($_POST['password']);
		if(isset($_POST['remember']))
			$remember = "1";
		else
			$remember = "0";
		
		$query = "SELECT * FROM users WHERE screen_name='" . $username . "' AND password=MD5('" . $pass . "')";
		
		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result) == 0)
			$er = "Incorrect username or password";
		else
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if ( isset($row))
		{
			if ((int)$row["validated"] == 0)
				$er = "Account not yet validated</br>Check your E-mail";
			else
			{
				$_SESSION['curr_user_id'] = $row["user_id"];
				$_SESSION['curr_user_email'] = $row["email"];
				$_SESSION['curr_user_screen_name'] = $row["screen_name"];
				$_SESSION['curr_user_is_admin'] = $row["admin"];
			
			}
		}
		
		if($er != '')
			show_form($er,$username);
		else
		{
			//post vars and auto submit
			echo '<form action="phpBBlogin.php" method="post" name="theform">
					<input type="hidden" name="user" value="' . $username . '" />
					<input type="hidden" name="password" value="' . $pass . '" />
					<input type="hidden" name="remember" value="' . $remember .'"/>
					<input type="submit" value="Continue" />
			</form>
			
			<script type="text/javascript">
				document.theform.submit();
			</script>'; 
		}
		
		
		db_close();
	}
	else
	{
		show_form($er,$username);
	}
	
	function show_form($er,$username)
	{

		
		echo '<table width="800px" align="center" cellspacing="0" cellpadding="0">
				<tr height="25px"></tr>
				<tr>
					<td background="images/corner_top_left.png" height="40px" width="40px">
					</td>
					<td background="images/line_top.png">
					</td>
					<td background="images/corner_top_right.png" width="40px">
					</td>
				</tr>
				<tr>
				
				<td background="images/line_left.png" width="40px">
				</td>
				<td background="images/white_alpha_43.png" width="720px"> ';
	

		echo '<table cellspacing="0" cellpadding="0">
			<tr>
				<td width="100px">
				</td>
				<td colspan="2">
					<a href="index.php?action=password_reset">Forgot/Change Your Password</a>
				</td>
			</tr>
			<form method="post" action="?action=login">';
			

			if($er != '')
			{
				echo '<tr><td align="center" colspan="3">';
				echo '	<p><font color="red">' . $er . '</font></p>';
				echo '</tr></td>';
			}

			echo
				'<tr>
					<td width="100px">
					</td>
					<td width="200px">
						User name :
					</td>
					<td>
						<input type="text" name="username" value="' . $username . '">
					</td>
				</tr>
				<tr>
					<td width="100px">
					</td>
					<td width="200px">
						Password :
					</td>
					<td>
						<input type="password" name="password">
					</td>
				</tr>
				<tr>
					<td width="100px"/>
					<td width="200px">
						Remember me
					</td>
					<td>
						<input type="checkbox" name="remember">
					</td>
				</tr>
				<tr>
					<td colspan="2">
					</td>
					<td>
						<input type="submit" value="Login">
					</td>
				</tr>
			</form>
		</table>';
		
		
		echo '</td>
		<td background="images/line_right.png" width="40px">
		</td>
		</tr>
		
		<tr>
			<td background="images/corner_bot_left.png" height="40px" width="40px">
			</td>
			<td background="images/line_bottom.png">
			</td>
			<td background="images/corner_bot_right.png" width="40px">
			</td>
		</tr>
		</table>';
	}
?>
