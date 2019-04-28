<?php include("header.php") ?>
<div style="min-height:550px;" class="container">
<div class="row">
<?php 
if($login_session=="Admin"){
$uname=$_GET['uname'];


if($_GET['command']=="sendmsg"){
  if(isset($_POST["msg_send"])){
      $uname=$_GET['uname'];
      $msg = $_POST["sent_msg"];
      $smsg_sql = "INSERT INTO Inbox(sender,receiver,text,chat_type)
      VALUES('Admin','$uname','$msg','private')";
      $result = mysqli_query($conn,$smsg_sql);
  }

$smsg_sql="select * from inbox where (sender='Admin' and receiver='$uname') OR (sender='$uname' and receiver='Admin') ORDER BY send_time";
$result = mysqli_query($conn,$smsg_sql);
//$cnt = mysqli_num_rows($result);
?>
<div class="col-md-3"></div>
<div class="col-md-5">
<div class="panel panel-primary">
    <div class="panel-heading">
  <h3 class="panel-title" style="text-align:center">Conversation</h3>
   </div>
  <div id="chat" class="panel-body" style="width: 450px;height:250px;overflow:scroll;" >
  <?php 
          while($row = mysqli_fetch_row($result)){
              if($uname == $row[1]){
                echo $row[1]." : ".$row[3];
                
              }else{
                  echo "Me : ".$row[3];
              }
              echo "<br>";
          }
       ?>
  </div>
  <form role="form" action="command.php?uname=<?php echo $uname; ?>&command=sendmsg" method="post">
    <div class="form-group">
   <input id="user_msg" class="form-control"name ="sent_msg" placeholder="Type your message here"type="text" required>
   </div>
<button id="send_msg" name = "msg_send" class="btn btn-primary btn-block" type="submit">Send</button>
</form> 

  </div>
    

</div>
<div class="col-md-4"></div>
<?php }

else if($_GET['command']=="block"){
$b_sql="update user set block='1' where uname='$uname'";
$b_result=$conn->query($b_sql);
?>
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="alert alert-success alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
   User<?php echo " ".$uname." "?>has been blocked Successfully.
</div>
</div class="col-md-4">
<div class="col-md-4"></div>
<?php
header("refresh:3.5;showuser.php");
}
else if($_GET['command']=="unblock"){
$ub_sql="update user set block='0' where uname='$uname'";
$ub_result=$conn->query($ub_sql);
?>
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="alert alert-success alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
   User<?php echo " ".$uname." "?>has been unblocked Successfully.
</div>
</div class="col-md-4">
<div class="col-md-4"></div>
<?php
header("refresh:3.5;showuser.php");
}
else if($_GET['command']=='delete'){

$d_sql="delete from user where uname='$uname'";
$d_result=$conn->query($d_sql);
?>
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="alert alert-success alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" 
      aria-hidden="true">
      &times;
   </button>
   User<?php echo " ".$uname." "?>has been deleted Successfully.
</div>
</div class="col-md-4">
<div class="col-md-4"></div>
<?php
header("refresh:3.5;showuser.php");
}
else{
header("Location: error404.php");
}
}
else{
header("Location: error404.php");
}
?>
</div>
</div>
