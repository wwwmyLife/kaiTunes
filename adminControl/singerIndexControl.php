<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}  
$tabSi=$_GET['tabSi'];
$Tabsi=getTabsi();
$resultSinger=getsingerlibiaoByID($tabSi,0);

if(key($resultSinger)==1){
    echo $resultSinger[key($resultSinger)];
    exit();
}
$smarty->assign("tabSi",$tabSi);
$smarty->assign("Tabsi",$Tabsi[0]);
$smarty->assign("resultSinger",$resultSinger);
$smarty->display("singer-index.html");