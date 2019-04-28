<?php
session_start();
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("quiz", $connection);
$username=$_SESSION['login_user'];
$offline_query=mysql_query("update user set status='0' where uname='$username'", $connection);
if(session_destroy()) // Destroying All Sessions
{
header("Location: index.php"); // Redirecting To Home Page
}
?>
