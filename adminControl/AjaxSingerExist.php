<?php
include "../model.php";
$singername=$_GET['singername'];
$result=singerExist($singername);

echo json_encode($result);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

