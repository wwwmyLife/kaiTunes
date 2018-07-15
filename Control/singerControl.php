<?php
include "../model.php";
include "../config.php";
$tabSi=$_GET['tabSi'];
$singertab=getTabsi();
$resultSinger=getsingerByID($tabSi,0);
$smarty->assign("singertab",$singertab);
$smarty->assign("resultSinger",$resultSinger);
$smarty->display("singer.html");
//include "../view/itcast_categoryView.php";



?>

