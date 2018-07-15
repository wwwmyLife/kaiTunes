<?php
include "../model.php";
include "../config.php";
$falg=$_GET['falg'];
if($falg==0){
    $currentabSi=$_GET['tabSiID'];
    $offset=$_GET['yema'];
    $result=getsingerByID($currentabSi,$offset);
    echo json_encode($result);
}else if($falg==1){
    $attr=$_GET['attr'];
    $attrValue=$_GET['singerID'];
    $offset=$_GET['yema'];
    $result=findSong($attr,$attrValue,$offset);
    echo json_encode($result);
}else if($falg==2){
    $singerID=$_GET['singerID'];
    $offset=$_GET['yema'];
    $result=singerAlbum($singerID,$offset);
    echo json_encode($result);
}else if($falg==3){
    $attr=$_GET['attr'];
    $attrValue=$_GET['albumID'];
    $offset=$_GET['yema'];
    $result=findSong($attr,$attrValue,$offset);
    echo json_encode($result);
}else if($falg==4){
    $userID=$_GET['userID'];
    $offset=$_GET['yema'];
    $result=getmyLike($userID,$offset);
    echo json_encode($result);
}else if($falg==5){
    $name=$_GET['name'];
    $offset=$_GET['yema'];
    $result=find($name,$offset);
    echo json_encode($result);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

