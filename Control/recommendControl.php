<?php
include "../model.php";
include "../config.php";
$offset=$_GET['offset'];
$leixing=$_GET['leixing'];
if($leixing=="song"){
    $recommendsong=recommendSong($offset);
    echo json_encode($recommendsong[0]);  
}else{
    $recommendSinger=recommendSinger($offset);
    echo json_encode($recommendSinger);  
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

