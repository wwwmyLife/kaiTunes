<?php
include "../model.php";
include "../adminconfig.php";
$falg=$_GET['falg'];
if($falg==0){
    $currentabSi=$_GET['tabSiID'];
    $offset=$_GET['yema'];
    $result=getsingerlibiaoByID($currentabSi,$offset);
    echo json_encode($result);
}else if($falg==1){
    $singerID=$_GET['singerID'];
    $offset=$_GET['yema'];  
    if($singerID=="-1"){
        $singername=$_GET['singername'];
        $result=singerExist($singername);
        if(key($result)!=0){
         echo json_encode($result);
        }else{
         $result1= getalbumlibiaoByID($result[0],$offset);
         echo json_encode($result1);
        }
    }else{
        $result1=getalbumlibiaoByID($singerID,$offset);
        echo json_encode($result1);
    }    
}else if($falg==2){
    $offset=$_GET['yema'];
    $result=getMenberInf($offset);
    echo json_encode($result);
}else if($falg==3){
    $name=$_GET['name'];
    $offset=$_GET['yema'];
    $result=search($name,$offset);
    echo json_encode($result);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

