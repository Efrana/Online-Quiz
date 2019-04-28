<?php
session_start();
if(isset($_SESSION['login_user'])){
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
    date_default_timezone_set("Asia/Dhaka");
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['login_user']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>