<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}
$memberInf=getMenberInf(0);
$smarty->assign("memberInf",$memberInf);
$smarty->display("Member-index.html");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

