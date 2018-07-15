<?php
include "../model.php";
include "../config.php";
$flag=$_POST['flag'];
$userID=$_POST['userID'];
if($flag=="0"){
    $songID=$_POST['songID'];
    $result=addlikeSong($userID,$songID);
    echo json_encode($result);
}else if($flag=="1"){
    $songIDs=$_POST['songIDs'];
    $result=piliang_addlikeSong($userID,$songIDs);
    echo json_encode($result);
    //echo json_encode($songIDs);
}else if($flag=="2"){
    $songID=$_POST['songID'];
    $result=dellikeSong($userID,$songID);
    echo json_encode($result);
}else if($flag=="3"){
    $songIDs=$_POST['songIDs'];
    $result=piliang_dellikeSong($userID,$songIDs);
    echo json_encode($result);
    //echo json_encode($songIDs);
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

