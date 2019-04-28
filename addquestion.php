<?php
include("session.php");
include("connection.php");
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
</head>
<body>
  <?php 
  if($user_type!="student"){
    $n_question=$n_a=$n_b=$n_c=$n_ans=$credit=$n_subject="";
     if (isset($_POST['submit'])) {
      $n_subject=$_POST['subject'];

      $n_question=$_POST['question'];
      $n_question=stripslashes($n_question);
      $n_question=mysql_real_escape_string($n_question);

      $n_a=$_POST['a'];
      $n_a=stripslashes($n_a);
      $n_a=mysql_real_escape_string($n_a);

      $n_b=$_POST['b'];
      $n_b=stripslashes($n_b);
      $n_b=mysql_real_escape_string($n_b);

      $n_c=$_POST['c'];
      $n_c=stripslashes($n_c);
     $n_c=mysql_real_escape_string($n_c);

      $n_ans=$_POST['ans'];
      $n_ans=stripslashes($n_ans);
      $n_ans=mysql_real_escape_string($n_ans);

      $credit=$_POST['credit'];

    }
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
           <li><a href="chat.php"><button type="button" class="btn btn-primary btn-xs"><span style="color:Black"class="glyphicon glyphicon-envelope"></span> <span class="badge">7</span></button></a></li>
           <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-user"></span><?php echo " ".$login_session; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="editprofile.php">Edit Profile</a></li>
              <li><a href="profile.php">My Profile</a></li>
            </ul>
          </li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container">

    <div class="row">

     <div class="col-md-9">
      <?php if($user_type!="student")?>
      <div class="jumbotron">
        <Button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span>My Added Question History</Button>
        <table class="table table-bordered">
         <thead>
          <th>SL</th>
          <th>Topic</th>
          <th>Question</th>
          <th>A</th>
          <th>B</th>
          <th>C</th>
          <th>Ans</th>
          <th>Date</th>
        </thead>
        <tbody>
          <tr>   
            <?php 
            $user_sql="select * from question where credit='$login_session' ";
            $sql_result=$conn->query($user_sql);
            $total_user=@$sql_result->num_rows;
            $sl=0;
            while($row = $sql_result->fetch_assoc()) {
              $sl=$sl+1;
              $subject=$row['subject'];
              $question=$row['question'];
              $op_a=$row['a'];
              $op_b=$row['b'];
              $op_c=$row['c'];
              $c_ans=$row['ans'];
              $datetime=$row['create_date'];
              ?>     
              <td><?php echo $sl;?></td>
              <td><?php echo $subject;?></td>
              <td><?php echo $question;?></td>
              <td><?php echo $op_a;?></td>
              <td><?php echo $op_b;?></td>
              <td><?php echo $op_c;?></td>
              <td><?php echo $c_ans;?></td>
              <td><?php echo $datetime;?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-3">
 <div id="login">
  <Button class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span>Add Questions</Button>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <select name="subject">
     <option value="physics">Physics</option>
     <option value="chemistry">Chemistry</option>
     <option value="biology">Biology</option>
     <option value="math">Math</option>
   </select>
   <label></label>
   <input id="question" name="question" placeholder="Question" type="text" required>
   <label></label>
   <input id="a" name="a" placeholder="Option A" type="text" required>
   <label></label>
   <input id="b" name="b" placeholder="Option B" type="text" required>
   <label></label>
   <input id="c" name="c" placeholder="Option C" type="text" required>
   <label></label>
   <input id="ans" name="ans" placeholder="Ans" type="text" required>
   <input name="credit" value="<?php echo $login_session?>" type="hidden">
   <label><br></label>
   <input name="submit" type="submit" value=" Add ">
 </form>
</div>
</div>

<div class="clearfix visible-lg"></div>
</div>

</div>
<?php
if($n_subject!=NULL && $n_question!=NULL && $n_a!=NULL && $n_b!=NULL && $n_c!=NULL && $n_ans!=NULL){
  
  $sql = "INSERT INTO question (subject,question,a,b,c,ans,credit)
  VALUES ('$n_subject', '$n_question','$n_a', '$n_b','$n_c','$n_ans','$credit')";
  if ($conn->query($sql) === TRUE) {?>

     <div style ="align:right"class="alert alert-success alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" 
         aria-hidden="true">
         &times;
       </button>
       Question has been Added Successfully.
     </div>

 <?php } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

}
else{
  header("Location:error404.php");
}
?>
<?php
include("footer.php");
?>

