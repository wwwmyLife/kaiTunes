<?php
include "../config.php";
if(!isset($_SESSION['userID'])){
    session_start();
    if(empty($_SESSION['userID'])){
        $userID="";
        $username="";
        $smarty->assign("userID",$userID);
        $smarty->assign("username",$username);
        $smarty->display("playMusic.html");
    }else{
        $userID=$_SESSION['userID'];
        $username=$_SESSION['username'];
        $smarty->assign("userID",$userID);
        $smarty->assign("username",$username);
        $smarty->display("playMusic.html");
    }
}
?>

