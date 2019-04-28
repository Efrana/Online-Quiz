<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
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
        <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Available Subjects <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Physics</a></li>
            <li><a href="#">Chemistry</a></li>
             <li><a href="#">Biology</a></li>
            <li><a href="#">Math</a></li>
          </ul>
        </li>
        <li><a href="#teacher" >Our Teachers</a></li>
        <li><a href="#about">About us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		 <li><a href="#login"><span class="glyphicon glyphicon-user"></span> Log in</a></li>
        <li><a href="signup.php"><span class="glyphicon glyphicon-pencil"></span> Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>
<div style="min-height:550px;" class="container-fluid">
<div id="myCarousel" class="carousel slide">
   <!-- Carousel indicators -->
   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
   </ol>   
   <!-- Carousel items -->
   <div class="carousel-inner">
      <div class="item active">
	  
         <img src="images/banner1.jpg" alt="">
         <div class="carousel-caption">
		 <h3 style="font-size:100px;color:white">OnlineQuiz.com</h3>
		 <p style="font-size:20px;color:white">Check your Strength</p>
		 </div>
      </div>
      <div class="item">
         <img src="images/banner2.jpg" alt="">
         <div class="carousel-caption">
		   <h3 style="font-size:100px;color:white">Learning is fun</h3>
		   <p style="font-size:20px;color:white">Boost your skills through fun</p>
		   </div>
      </div>
      <div class="item">
         <img src="images/banner3.jpg" alt="">
         <div class="carousel-caption">
		 <h3 style="font-size:100px;color:white">Learning is free</h3>
		 <p style="font-size:20px;color:white">It is free and always will be</p>
		 </div>
      </div>
   </div>
   <!-- Carousel nav -->
   <a class="carousel-control left" href="#myCarousel" 
      data-slide="prev">&lsaquo;</a>
   <a class="carousel-control right" href="#myCarousel" 
      data-slide="next">&rsaquo;</a>
</div> 
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
	<div id="login">
    <form action="" method="post">
     <input id="name" name="uname" placeholder="Username" type="text">
  <label></label>
	
    <input id="password" name="password" placeholder="Password" type="password">
	<label><br></label>
    <input name="submit" type="submit" value=" Login ">
    <span><?php echo $error; ?></span>
    <span><br>Not a member yet? Register <a href="signup.php"><span style="color:white">here!</span></a></span>
</form>
</div>
	
	</div>
    <div class="col-sm-4"></div>
	
<div id="about"style=""class="col-md-8 jumbotron">
<h1>EVERYTHING YOU NEED TO KNOW </h1>
     <P>
      <ul>
     <li>We have A huge collection of MCQ question on various topics.</li>
     <li> Expert Teacher on different courses.</li>
     <li> Excelent progress report at the basis of given Quizes.</li>
     <li> *24/7 Expert help.</li>
     </ul>
     </P>
     <div class="jumbotron">
     <h1 id="teacher">Our Teachers</h1>
     <ul>
     <li>We have many Expert Teachers</li>
     <li>They are Friendly and Helpfull </li>
     <li> They are from all over the world.</li>
     <li> *24/7 hours available.</li>
     </ul>
     </div>
    </div>

    <div class="col-md-4 ">
    <h1 style="color:white;text-align:center;">Admin</h1>
    <img  src="images/Admin.jpg" class="img-circle" alt="Admin" width="146" height="146">
    </div>

  </div>
</div>


<?php
include("footer.php");
?>