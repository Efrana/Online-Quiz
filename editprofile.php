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
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Subjects <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Physics</a></li>
              <li><a href="#">Chemistry</a></li>

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
           <li><a href="profile.php">My Profile</a></li>
         </ul>
       </li>
       <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
     </ul>
   </div>
 </div>
</nav>
<div style="min-height:550px;"class="container">

  <div class="row">
    <div class="col-md-4">
      <div class="jumbotron">
       <img  src="images/<?php echo $login_session;?>.jpg" class="img-circle" alt="<?php echo $login_session;?>" width="146" height="146"><br><br> 	
       <h4 style="text-align:center">Welcome!<br><br></h4> 
       <a href="#" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span> <?php echo $first_name." ".$last_name; ?></a>
     </div>
     <?php 
     $picErr="";
     if (isset($_POST['submit_pic'])) {
      $target_dir = "images/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  
      $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {

        $uploadOk = 1;
      } else {
        $picErr="File is not an image.";
        $uploadOk = 0;
      }
  
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        $picErr="Sorry, your file is too large.";
        $uploadOk = 0;
      }
  
      if($imageFileType != "jpg") {
        $picErr= "Sorry, only JPG file is allowed.";
        $uploadOk = 0;
      }
  
      if ($uploadOk == 0) {
        $picErr= "Sorry, your file was not uploaded.";
  
      } else {
       $temp = explode(".",$_FILES["fileToUpload"]["name"]);
       $newfilename = $login_session . '.' .end($temp);
       move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir. $newfilename);
       $picErr="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
     }
   }
   ?>
   <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Upload Your Profile picture</h3>
      <h5>*Maximum image size is 5 MB</h5>
    </div>
    <div class="panel-body">
     <form action="" method="post" enctype="multipart/form-data">
       <input type="file" name="fileToUpload" id="fileToUpload">
       <h6 style="color:black">*Only JPG format is allowed</h6><br>
       <input type="submit" value="Upload Image" name="submit_pic">
       <span style="color:blue"><?php echo $picErr?></span>
     </form>
   </div>
 </div>
</div>
<?php 
$u_info=$err_info="";
if(isset($_POST["update_info"])){
  $fname=$_POST['fname'];
   $fname=stripslashes($fname);
  $fname=mysql_real_escape_string($fname);

  $lname=$_POST['lname'];
  $lname=stripslashes($lname);
  $lname=mysql_real_escape_string($lname);

  $email=$_POST['email'];
  $email=stripslashes($email);
  $email=mysql_real_escape_string($email);

  $institut=$_POST['institute'];
  $institut=stripslashes($institut);
  $institut=mysql_real_escape_string($institut);

  $abt=$_POST['about'];
  $abt=stripslashes($abt);
  $abt=mysql_real_escape_string($abt);

  $info_sql = "UPDATE user set fname='$fname',lname='$lname', email='$email',institute='$institut',about='$abt'
  where uname='$login_session'";

  if ($conn->query($info_sql) === TRUE) {
    $u_info="Information has been updated successfully";
    header("refresh:2;editprofile.php");
  } 
  else{
   $err_info="Something went wrong"; 
 }
}
?>
<div class="col-md-8"> 
 <div class="jumbotron">
  <h3>Edit profile</h3>
  <div id="edit">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label>First Name:</label>
    <input  name="fname" placeholder="Edit Your First Name" value="<?php echo $first_name;?>"type="text" required>
    <label>Last Name:</label>
    <input name="lname" placeholder="Edit Your Last Name" value="<?php echo $last_name;?>" type="text" required>
    <label>Email:</label>
    <input name="email" placeholder="Edit Your Email Address" value="<?php echo $email;?>"type="text" required>
    <br><label>Institution:</label>
    <input name="institute" placeholder="Edit Your Institution" value="<?php echo $institution;?>" type="text" required>
    <br><label>About:</label>
    <textarea name="about" placeholder="About Yourself" rows="5" cols="96"><?php echo $about;?></textarea>
    <label><br></label><br>
    <br><button style="float:right"type="submit" name="update_info" class="btn btn-success btn-lg">Update</button>
    <span><?php echo $err_info; ?></span>
    <span style="color:green"><?php echo $u_info; ?></span>
  </form>
</div>
</div>

<?php 
$old_passErr=$new_passErr=$updated="";

if(isset($_POST["pass_Update"])){

  $pass1=$_POST['pass1'];
  $pass1=stripslashes($pass1);
  $pass1=mysql_real_escape_string($pass1);

   $pass2=$_POST['pass2'];
   $pass2=stripslashes($pass2);
   $pass2=mysql_real_escape_string($pass2);

   $old_pass=$_POST['old_pass'];
   $old_pass=stripslashes($old_pass);
   $old_pass=mysql_real_escape_string($old_pass);

  
  $pass=md5($old_pass);

  $pass_sql="select * from user where password='$pass' AND uname='$login_session'";
  $pass_result=$conn->query($pass_sql);
  $total_row=@$pass_result->num_rows;
  if($pass1==$pass2){
   $password=$pass1;
   $password=md5($password);
 }
 else{
  $new_passErr="Password did not matched";
}
if($total_row!=1){
  $old_passErr="Wrong old password";
}

if($new_passErr==Null&&$old_passErr==Null&&$total_row==1){
 $update_sql="Update user set password='$password' where uname='$login_session'";
 if($conn->query($update_sql)==true){
   $updated="Password Updated Succesfully";
 }
 else{
  header("location:error404.php");
}
}
}

?>
<div class="jumbotron">
  <h3>Edit Password</h3>
  <div id="edit">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
     <input  name="pass1" placeholder="Enter Your New Password" type="password" required>
     <label></label>
     <input  name="pass2" placeholder="Confirm Your New Password" type="password" required>
     <label></label>
     <span><?php echo $new_passErr?></span>
     <input name="old_pass" placeholder="Enter Your Old Password" type="password" required>
     <span><?php echo $old_passErr?></span>
     <label><br></label>
     <br><button style="float:right"type="submit" name="pass_Update" class="btn btn-primary btn-lg">Update</button>
     <span style="color:green"><?php echo $updated?></span>
   </form>
 </div>
</div>
</div>
<div class="clearfix visible-lg"></div>
</div>

</div>

</body>
</html>

