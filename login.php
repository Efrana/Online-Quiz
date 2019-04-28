	<?php
	session_start(); 
	$error=''; 
	if (isset($_POST['submit'])) {
	if (empty($_POST['uname']) || empty($_POST['password'])) {
	$error = "Username or Password is invalid";
	}
	else
	{

	$username=$_POST['uname'];
	$password=$_POST['password'];

	$connection = mysql_connect("localhost", "root", "");

	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	$db = mysql_select_db("quiz", $connection);

	$pass=md5($password);
	$query = mysql_query("select * from user where password='$pass' AND uname='$username'", $connection);
	$rows = mysql_num_rows($query);
	if ($rows == 1) {
	$_SESSION['login_user']=$username; 
	$status_query=mysql_query("update user set status='1' where uname='$username'", $connection);
	header("location: profile.php"); 
	} else {
	$error = "Meh Username or Password is invalid";
	}
	mysql_close($connection); 
	}
	}
	?>