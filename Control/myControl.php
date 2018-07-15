<?php
include "../model.php";
include "../config.php";
if(!isset($_SESSION['userID'])){
    session_start();
    if(!empty($_SESSION['userID'])){
        $userID=$_SESSION['userID'];
        $userInf=getUserinf($userID);
        $mylike=getmyLike($userID,0);
        $smarty->assign('userInf',$userInf);
        $smarty->assign('mylike',$mylike);
        $smarty->assign('userID',$userID);
        $smarty->display("my.html",$userID);
    }
    else{
        $smarty->display("nologin.html");
    } 
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

