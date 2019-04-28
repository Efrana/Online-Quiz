<?php
include("header.php");
?>
<div style="min-height: 550px;" class="container">
<div class="row">
	<?php
if($_GET['command']=="sendmsg"){
  if(isset($_POST["msg_send"])){
      $uname=$_GET['uname'];
      $msg = $_POST["sent_msg"];
      $smsg_sql = "INSERT INTO Inbox(sender,receiver,text,chat_type)
      VALUES('$login_session','$uname','$msg','private')";
      $result = mysqli_query($conn,$smsg_sql);
  }
$uname='Admin';
$smsg_sql="select * from inbox where (sender='$login_session' and receiver='$uname') OR (sender='$uname' and receiver='$login_session') ORDER BY send_time";
$result = mysqli_query($conn,$smsg_sql);
//$cnt = mysqli_num_rows($result);
?>
<div class="col-md-3"></div>
<div class="col-md-5">
<div class="panel panel-primary">
    <div class="panel-heading">
  <h3 class="panel-title" style="text-align:center">Conversation</h3>
  <p style="text-align:right"><a id="exit" href=#><span>X</span></a></p>
   </div>
  <div id="chat" class="panel-body " style="width: 450px;height:250px;overflow:scroll;" >
  <?php 
          while($row = mysqli_fetch_row($result)){
              if($uname == $row[1]){
                echo "(".$row[6].") <i>".$row[1]." :</i> ".$row[3]."<br>";
                
              }else{
                  echo "(".$row[6].") "."<b>Me :</b> ".$row[3]."<br>";
              }
              echo "<br>";
          }
       ?>
  </div>
  <form role="form" action="inbox.php?uname=<?php echo $uname; ?>&command=sendmsg" method="post">
    <div class="form-group">
   <input id="user_msg" class="form-control"name ="sent_msg" placeholder="Type your message here"type="text" required>
   </div>
<button id="send_msg" name = "msg_send" class="btn btn-primary btn-block" type="submit">Send</button>
</form> 

  </div>
</div>
<div class="col-md-4"></div>
<?php }
?>
</div>
</div>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	 $("#send_msg").click(function(){ 
        var oldscrollHeight = $("#chat").attr("scrollHeight") - 20; 
        //Auto-scroll           
        var newscrollHeight = $("#chat").attr("scrollHeight") - 20; 
        if(newscrollHeight > oldscrollHeight){
        $("#chat").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }  
    });
    
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the conversation?");
        if(exit==true){window.location = 'profile.php';}      
    });
    
});
</script>

<?php 
include("footer.php")
?>