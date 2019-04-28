<?php

session_start();
if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign up</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css">
<?php
 include('connection.php');

?>
</head>
<body>
<?php
$fnameErr =$lnameErr= $unameErr= $emailErr = $pasErr= "";
$fname =$lname= $uname= $email=$pass =$type="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$type=$_POST["type"];
if(empty($_POST["fname"])){
$fnameErr="Name is Required";
}
else{
$fname = test_input($_POST["fname"]);
if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
  $nameErr = "Only letters and white space allowed";
}
}
if(empty($_POST["lname"])){
$lnameErr="Name is Required";
}
else{
$lname = test_input($_POST["lname"]);
if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed";
}
}
if(empty($_POST["uname"])){
$unameErr="User name is Required";
}

$uname=$_POST["uname"];
$duname_sql="SELECT * FROM user WHERE uname='$uname'";
$d_result=$conn->query($duname_sql);
$duplicat_row=$d_result->num_rows;
echo $duplicat_row;
if($duplicat_row>0){
$unameErr="This Username has been taken try another Username";
}
else{
$uname=test_input($_POST["uname"]);
}

 if(empty($_POST["email"])){
$emailErr="E-mail is Required";
}
$mail=$_POST["email"];
$demail_sql="SELECT * FROM user WHERE email='$mail'";
$demail_result=$conn->query($demail_sql);
$duplicat_email=$demail_result->num_rows;
if($duplicat_email>0){
$emailErr="This email address is already used";
}
else{
$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}
}
$pass=$_POST["password"];
$passc=$_POST["passwordc"];
if($pass==$passc){
$password=$_POST["password"];
}
else{
$pasErr="Password did not matched";
}
}


function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div  class="container">
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
        <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Subjects <span class="caret"></span></a>
          <ul class="dropdown-menu"style="background-color:blue;">
            <li><a href="#">Physics</a></li>
            <li><a href="#">Chemistry</a></li>
  
          </ul>
        </li>
        <li><a href="#" >Our Teachers</a></li>
        <li><a href="#">About us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		 <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Log in</a></li>
        <li><a href="signup.php"><span class="glyphicon glyphicon-pencil"></span> Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
	<div id="login">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<input id="name" name="fname" placeholder="First Name" type="text">
<span class="error"><?php echo $lnameErr;?></span>
<label></label>
<input id="name" name="lname" placeholder="Last Name" type="text">
<span class="error"><?php echo $lnameErr;?></span><br>
<label></label>
<input id="name" name="uname" placeholder="Username" type="text">
<span class="error"><?php echo $unameErr;?></span>
<label></label>
<input id="name" name="email" placeholder="Email Address" type="text">
<span class="error"><?php echo $emailErr;?></span>
<label></label>
<input id="password" name="password" placeholder="Password" type="password">
<label></label>
<input id="password" name="passwordc"placeholder="Re-type Password" type="password">
<span class="error"><?php echo $pasErr;?></span><br>
<input type="radio" name="type" value="student" checked>Student
<input type="radio" name="type" value="teacher">Teacher
<label><br></label>
<input name="submit" type="submit" value=" Sign up ">
</form>
</div>
	
	</div>
    <div class="col-sm-4"></div>
  </div>
</div>

<?php
if($fname !=NULL&&$fnameErr==NULL && $lname!=NULL&&$lnameErr==NULL && $uname!=NULL&&$unameErr==NULL && $email!=NULL&&$emailErr==NULL&&$pasErr==NULL){
 $passmd5=md5($password); 
  $sql = "INSERT INTO user (fname,lname, uname, email,password,type)
VALUES ('$fname', '$lname','$uname', '$email','$passmd5','$type')";
 if ($conn->query($sql) === TRUE) {
      header("location: index.php");
	
} else {
    header("location: error404.php");
}
  }
?>
<?php
include("footer.php");
?>