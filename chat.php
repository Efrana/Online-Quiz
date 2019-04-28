<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Welcome to online-Quiz.com</title>

<link type="text/css" rel="stylesheet" href="chat/chat.css" />
<link type="text/css" rel="stylesheet" href="chat/style.css" />
</head>
</body>
<?php
session_start();
if(isset($_GET['logout'])){
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['login_user'] ." has left the conversation.</i><br></div>");
    fclose($fp);
    header("Location: profile.php"); //Redirect the user
}
if(!isset($_SESSION['login_user'])){
  header("Location: index.php");
}
else{
?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <b><?php echo $_SESSION['login_user']; ?></b></p>
        <p class="logout"><a id="exit" href="#">Close</a></p>
        <div style="clear:both"></div>
    </div>   
    <div id="chatbox"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?></div>
     
    <form style="text-align:center"name="message" action="" method="post">
        <input name="usermsg" type="text" id="usermsg" size="63" />
		<label><br><br></label><br>
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" /><br>
    </form>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
    function loadLog(){     
        var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; 
        $.ajax({
            url: "log.html",
            cache: false,
            success: function(html){        
                $("#chatbox").html(html); 
                
                //Auto-scroll           
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; 
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }               
            },
        });
    }
    setInterval (loadLog, 2000);    
    
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the conversation?");
        if(exit==true){window.location = 'chat.php?logout=true';}      
    });
    
    $("#submitmsg").click(function(){ 

        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        return false;
    });

});
</script>
<?php
}
?>
</body>
</html>