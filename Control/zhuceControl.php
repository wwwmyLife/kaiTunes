<?php
include "../model.php";
include "../config.php";
$username=$_POST['username'];
$pwd=$_POST['pwd'];
$result=zhuce($username,$pwd);

echo json_encode($result);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

