<?php
	 include('session.php');
	  include('connection.php');
				if($user_type=="student"){
		   $chart_sql="SELECT subject,percentage FROM chart WHERE uname='$login_session' ";
				  $result = $conn->query($chart_sql);
				   $rows = array();
				    $table = array();
				     $table['cols'] = array(
				      array('label' => 'subject', 'type' => 'string'),
				      array('label' => 'Percentage', 'type' => 'number')
				      );
				     /* Extract the information from $result */
				     foreach($result as $r) {
				      $temp = array();
				      // The following line will be used to slice the Pie chart
				      $temp[] = array('v' => (string) $r['subject']); 
				      // Values of the each slice
				      $temp[] = array('v' => (int) $r['percentage']); 
				      $rows[] = array('c' => $temp);
				     }

				     $table['rows'] = $rows;
				      // convert data into JSON format
				     $jsonTable = json_encode($table);
				      //echo $jsonTable;
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
					   <?php if($user_type=="student"){ ?>
			            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
			    <script type="text/javascript">

			    google.load('visualization', '1', {'packages':['corechart']});

			    google.setOnLoadCallback(drawChart);

			    function drawChart() {

			      // Create our data table out of JSON data loaded from server.
			      var data = new google.visualization.DataTable(<?=$jsonTable?>);
			      var options = {
			           title: '',
			          is3D: 'true',
			          width: 530,
			          height: 400
			        };
			      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
			      chart.draw(data, options);
			    }
			    </script>

					   <?php }?>
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
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Subjects <span class="caret"></span></a>
	  <ul class="dropdown-menu">
		<li><a href="#">Physics</a></li>
		<li><a href="#">Chemistry</a></li>
		<li><a href="#">Biology</a></li>
		<li><a href="#">Math</a></li>

	  </ul>
	</li>
	<li><a href="#" >Our Teachers</a></li>
	<li><a href="aboutus.php">About us</a></li>
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
	  </ul>
	</li>
	<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
  </ul>
</div>
</div>
</nav>

<div style="min-height: 550px;"class="container">
<div class="row">
<div class="col-md-5">
  <div class="jumbotron">
 <img  src="images/<?php echo $login_session;?>.jpg" class="img-circle" alt="<?php echo $login_session;?>" width="146" height="146"><br><br> 	
 <h4 style="text-align:center">Welcome!<br><br></h4> 
<a href="#" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span> <?php echo $first_name." ".$last_name; ?></a>
</div>
<div class="panel panel-info">
	  <div class="panel-heading">
  <h3 class="panel-title" style="text-align:center">About Me</h3>
	 </div>
  <div class="panel-body">
  Hi, I am <?php echo $first_name." ".$last_name ;?>. I am a <?php echo " ".$user_type." of ".$institution.". ".$about;?>. 
  </div>
  </div>
       <?php if($user_type=="student") {?>
        <div class="jumbotron">
        <Button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span>My Quiz History</Button>
        <table class="table table-bordered">
		       <thead>
		       	<th>Sl</th>
         <th>Topic</th>
         <th>Tried</th>
         <th>Solved</th>
		       <th>Accuracy</th>
		       <th>Date</th>
        </thead>
	 	    <tbody>
	 	    <tr>	 
      <?php 
	  $user_sql="select * from progress where uname='$login_session' ";
	  $sql_result=$conn->query($user_sql);
      $total_user=@$sql_result->num_rows;
      $sl=0;
	  while($row = $sql_result->fetch_assoc()) {
	  	  $sl=$sl+1;
      $subject=$row['subject'];
	     $tried=$row['tried'];
	    $solved=$row['solved'];
		   $percent=$row['percentage'];
		   $date=$row['time'];
	  ?>     
	  <td><?php echo $sl;?></td>
         <td><?php echo $subject;?></td>
         <td><?php echo $tried;?></td>
		       <td><?php echo $solved;?></td>
         <td><?php echo $percent."%"?></td>
		      <td><?php echo $date?></td>
        </tr>
          <?php }?>
           </tbody>
         </table>
        </div>
        	<?php }?>
	</div>
					
             <div class="col-md-7"> 
			   <?php if($user_type=='student') {?>
				<div class="panel panel-primary">
				  <div class="panel-heading">
			  <h3 class="panel-title">Do you Want to start Quiz?</h3>
				 </div>
			  <div style="text-align:center"class="panel-body">
			  <a href="quiz.php"><button class="btn btn-success btn-lg">Yes</button></a>
			  <a href="home.php"><button class="btn btn-danger btn-lg">No</button></a>
			  </div>
			  </div>
			  <div class="jumbotron">
			   <Button class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-primary"></span>Overall Performance</Button>
			  <div id="chart_div"></div>
			  <p style="color:blue"><span>*</span>Give more than One quiz</p>
			   </div>
			  <?php }else{?>
				   <div class="panel panel-primary">
				  <div class="panel-heading">
				  <h3 class="panel-title">Do you Want to Add Question?</h3>
				 </div>
					 <div style="text-align:center"class="panel-body">
					 <a href="addquestion.php"><button class="btn btn-success btn-lg">Yes</button></a>
					 <a href="home.php"><button class="btn btn-danger btn-lg">No</button></a>
					 </div>
					</div>
					<?php }?>
			</div>
			
		<div class="clearfix visible-lg"></div>
	</div>
</div>

<?php include("footer.php");?>

