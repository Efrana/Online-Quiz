<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add questions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/style.css">
   <?php include("connection.php");?>
</head>
<body>
<?php if($login_session=="Admin"){?>
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
        <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
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
	  <li><a href="chat.php"><button type="button" class="btn btn-primary btn-xs"><span style="color:white"class="glyphicon glyphicon-envelope"></span> <span class="badge">7</span></button></a></li>
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php">My Profile</a></li>
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
	     <div class="col-md-3"></div>
		   <div class="col-md-6">
	   <Button class="btn btn-danger btn-lg btn-block"><span style="color:black" class="glyphicon glyphicon-user"></span>&nbspAdmin Panel</Button>
	   </div>
	     <div class="col-md-3"></div>
	       <div class="col-md-12">
		   <div class="jumbotron">
	    <Button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span>Users</Button>
         <table class="table table-bordered">
		 <thead>
		 <th>ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Username</th>
		 <th>User Type</th>
		 <th>Email</th>
		 <th>Status</th>
		 <th>Actions</th>
        </thead>
	 	 <tbody>	 
      <?php 
	  $user_sql="select * from user where uname!='Admin' order by id";
	  $sql_result=$conn->query($user_sql);
      $total_user=@$sql_result->num_rows;
	  while($row = $sql_result->fetch_assoc()) {
      $id=$row['id'];
      $fname=$row['fname'];
	   $lname=$row['lname'];
	    $uname=$row['uname'];
		 $email=$row['email'];
		 $type=$row['type'];
		 if($row['status']==1){
		  $status="Online";
		 }
		 else{
		 $status="Offline";
		 }	 
	  ?>
      <tr>
         <td><?php echo $id?></td>
         <td><?php echo $fname?></td>
         <td><?php echo $lname?></td>
		 <td><a href="publicprofile.php?uname=<?php echo $uname;?>"> <?php echo $uname;?></a></td>
         <td><?php echo $type?></td>
		 <td><?php echo $email?></td>
         <td><?php echo $status?></td>
		 <td>
		 <div class="btn-group">
		 <?php 
		 if($row['block']==0){?>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Actions&nbsp
			<span style="color:black" class="caret"></span></button>
			<?php 
			}
			else{
			?>
			<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Actions&nbsp
			<span style="color:black" class="caret"></span></button>
			<?php }?>
            <ul class="dropdown-menu" role="menu">
            <li><a href="command.php?uname=<?php echo $uname;?>&command=sendmsg"><span style="color:black" class="glyphicon glyphicon-envelope"></span>&nbspSend Message</a></li>
            <?php 
			if($row['block']==0){?>
			<li><a href="command.php?uname=<?php echo $uname;?>&command=block"><span class="glyphicon glyphicon-ban-circle"></span>&nbspBlock</a></li>
		    <?php }
			else {?>
			<li><a href="command.php?uname=<?php echo $uname;?>&command=unblock"><span style="color:green"class="glyphicon glyphicon-ok-sign"></span>&nbspUnblock</a></li>
			<?php }?>
			<li><a href="command.php?uname=<?php echo $uname;?>&command=delete"><span class="glyphicon glyphicon-trash"></span>&nbspDelete</a></li>
            </ul>
            </div>   
		    </td>
			
        </tr>
          <?php }?>
           </tbody>
         </table>		
		
		</div>
		</div>
		  <Button class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-"></span></Button>
      <div class="clearfix visible-lg"></div>
       </div>
	   </div>
	   <?php }
	   else{
	   header("Location:error404.php");
	   }?>
<?php
include("footer.php");
?>
