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
<?php 
if($login_session=="Admin"){
$uname=$_GET['uname'];
$p_sql="select * from user where uname='$uname'";
$sql_result=$conn->query($p_sql);
$row = $sql_result->fetch_assoc();
$fname=$row['fname'];
$lname=$row['lname'];
$email=$row['email'];
$type=$row['type'];
$institution=$row['institute'];
$about=$row['about'];
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
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
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Subjects <span class="caret"></span></a>
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
	  <li><a href="chat.php"><button type="button" class="btn btn-primary btn-xs"><span style="color:black"class="glyphicon glyphicon-envelope"></span> <span class="badge">7</span></button></a></li>
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
          </ul>
        </li>
		
		
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div style="min-height:550px;" class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="jumbotron">
     <img  src="images/<?php echo $uname;?>.jpg" class="img-circle" alt="<?php echo $uname;?>" width="146" height="146"><br><br> 	
	
    <a href="#" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span> <?php echo $fname." ".$lname; ?></a>
  </div>
    </div>
    
    <div class="col-md-8"> 
        <div class="panel panel-primary">
          <div class="panel-heading">
      <h3 class="panel-title">About me</h3>
         </div>
      <div style="text-align:center"class="panel-body">
      Hi, I am <?php echo $fname." ".$lname ;?>. I am a <?php echo " ".$type." of ".$institution.". ".$about;?>. 
      </div>
      </div>
	  
    </div>
    <div class="clearfix visible-lg"></div>
  </div>

</div>
<?php
}
else{
header("Location:error404.php");
} ?>

