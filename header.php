<?php
include('session.php');
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Online-Quiz.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">
	   <img src="images/logo.png" alt="Online-Quiz.com" width="150" height="35">
	  </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Available Subjects <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Physics</a></li>
            <li><a href="#">Chemistry</a></li>
			      <li><a href="#">Biology</a></li>
            <li><a href="#">Math</a></li>
  
          </ul>
        </li>
        <li><a href="#" >Our Teachers</a></li>
        <li><a href="#">About us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <li><a href="inbox.php?command=sendmsg"><button type="button" class="btn btn-primary btn-xs">Inbox<span style="color:black"class="glyphicon glyphicon-envelope"></span> <span class="badge">1</span></button></a></li>
  <li><a href="chat.php"><button type="button" class="btn btn-primary btn-xs">Public<span style="color:black"class="glyphicon glyphicon-envelope"></span> <span class="badge">1</span></button></a></li>
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php if($user_type=='teacher'){
		   echo "<li><a href="."addquestion".".php>Add Question</li>";
		   }
		  ?>
		  <?php if($user_type=='admin'){
		   echo "<li><a href="."showuser".".php>Show Users</li>";
		   }
		  ?>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="profile.php">My profile</a></li>
          </ul>
        </li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>