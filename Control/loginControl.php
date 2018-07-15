<?php
include "../model.php";
include "../config.php";
$username=$_POST['username'];
$pwd=$_POST['pwd'];
//$result=login("abc",123);
$result=login($username,$pwd);
//var_dump($result);
if(key($result)!=1){
        session_start();
        $_SESSION['username']=$result[key($result)]['username'];
        $_SESSION['userID']=$result[key($result)]['userID'];
}  
//var_dump($_SESSION['user']);
echo json_encode($result);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

