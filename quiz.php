<?php include("header.php") ?>
<div style="min-height: 550px;" class="container">
	<div class="row"> 
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Select Your Subject</h3>
				</div>
				<div class="panel-body">
					<div class="dropdown">
						<button class="btn btn-primary btn-lg dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Subjects
							<span style="color:black"class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="quiz.php?subject=physics">Physics</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="quiz.php?subject=chemistry">Chemistry</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="quiz.php?subject=math">Math</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="quiz.php?subject=biology">Biology</a></li>
								<li role="presentation" class="divider"></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="request.php">Need to Add another subject? Request here!</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron">
				<?php if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SERVER["REQUEST_METHOD"] == "POST" ) {
					$subject=@$_GET['subject'];
					$q=@$_GET['quantity'];
					?>

					<h3><?php echo $subject." ";?> Quiz</h3>
					<?php
					$q_sql="SELECT * from question where subject='$subject'";
					$q_result=$conn->query($q_sql);
					$total_q=@$q_result->num_rows;
					$correct_ans=0;
					if ($total_q > 0) {
						?>
						<button class="btn btn-primary btn-lg" data-toggle="modal" 
						data-target="#myModal">
						Click here to enter your question numbers
					</button>
					<form action="quiz.php?start=ok&subject=<?php echo $subject; ?>&quantity=<?php echo $q; ?>" Method="POST">
						<?php
						if(@$_GET['start']=="ok"){

							$c=1;
					while($c<=$q) {
						$row=$q_result->fetch_assoc();
						?>
						<div id="quiz">
			<fieldset id=<?php echo "q".$c?>>
				<legend style="color:blue">Question <?php echo $c?></legend>
				<legend><?php echo $row["question"]?></legend>
				<label><input type="radio" name="<?php echo "que".$c?>" value="<?php echo $row["a"]?>"/><?php echo " ".$row["a"]?></label><br/>
				<label><input type="radio" name="<?php  echo "que".$c?>" value="<?php echo $row["b"]?>"/><?php echo " ".$row["b"]?></label><br/>
				<label><input type="radio" name="<?php echo "que".$c?>" value="<?php echo $row["c"]?>"/><?php echo " ".$row["c"]?></label>
				<?php
				if(isset($_POST["check_ans"])){
					$ans = @$_POST["que".$c];

					if($ans==$row['ans']){
						echo "<p><span style=" ."color:green"." >"."Correct ans"."</span></p>";
						$correct_ans= $correct_ans+1;
					}
					else{
						echo "<p><span>"."Wrong ans! "."</span>Correct ans is ".$row['ans']."</p>";
					}
					?>
					<?php
				}else{
					?>
					<?php
				}
				?>
			</fieldset>
						</div>
						<?php
						$c=$c+1;
							}
						}
					} else {
					}
					?>
					<?php }
					?>
					<Button  type ="submit" name="check_ans"value="check_ans"class="btn btn-primary">Check And Save</Button>
				</form>
				<p>
					<?php 
					if(isset($_POST["check_ans"])){
						echo "Correct ans: ".$correct_ans;
						echo "<br>Question tried: ".$q;
						$percentage=($correct_ans*100)/$q;
						$percentage=(int)$percentage;
						$p_sql="insert into progress (uname,subject,tried,solved,percentage) 
						values ('$login_session','$subject','$q','$correct_ans','$percentage')";

						$up_sql="SELECT * from chart where uname='$login_session' and subject='$subject' ";
						$up_result=$conn->query($up_sql);
						if($up_result->num_rows>0){
							$chart_rows=$up_result->fetch_assoc();
							$chart_parcent=($percentage+$chart_rows['percentage'])/2;
							$chart_sql="update chart set percentage='$chart_parcent' where uname='$login_session' and subject='$subject'";
							$csql_result=$conn->query($chart_sql);
						}
						else{
							$chart_sql="insert into chart (uname,subject,percentage)
							values('$login_session','$subject','$percentage')";
							$chart_result=$conn->query($chart_sql);
						}
						if ($conn->query($p_sql) === TRUE) {?>

						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" 
							aria-hidden="true">
							&times;
						</button>
						Progress has been updated Successfully.
					</div>

					<?php } else {
						header("location:error404.php");
					}
				}?></p>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percentage;?>"
						aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage."%";?>">
						<?php echo $percentage."%";?>
					</div>
				</div>
				<a href="quiz.php"><button type="button" class="btn btn-primary btn-lg"><span style="color:black"class="glyphicon glyphicon-share-alt"></span>Go to Quiz</button></a>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Enter desired Question amounts from 5 to <?php echo $total_q;?>
					</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" Method="Get">
						<div class="form-group">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<input type="number" value="5" class="form-control" name="quantity" min="5" max="<?php echo $total_q;?>">
								<input type="hidden" value="<?php echo $subject; ?>"name="subject">

							</div>
							<button type="submit" name="start" value="ok" class="btn btn-primary">Submit</button>
							<div class="col-md-3"></div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php include("footer.php")?>