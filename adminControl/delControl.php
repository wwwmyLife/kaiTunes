<?php
include "../model.php";
include "../adminConfig.php";
$falg=$_POST['falg'];
if($falg==0){
    $userID=$_POST['userID'];
    $result=delFunction($userID,$falg);
    echo json_encode($result);
}
if($falg==1){
    $singerID=$_POST['singerID'];
     $result1=delfileBysinger($singerID);
    if(key($result1)==0){
        $result=delFunction($singerID,$falg);
        echo json_encode($result);
   }else{
        echo json_encode($result1);
   }  
}
if($falg==2){
    $albumID=$_POST['albumID'];
     $result1=delfileByalbum($albumID);
    if(key($result1)==0){
        $result=delFunction($albumID,$falg);
        echo json_encode($result);
   }else{
        echo json_encode($result1);
   }  
}
if($falg==3){
    $songID=$_POST['songID'];
     $result1=delfileBysong($songID);
    if(key($result1)==0){
        $result=delFunction($songID,$falg);
        echo json_encode($result);
   }else{
        echo json_encode($result1);
   }  
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

