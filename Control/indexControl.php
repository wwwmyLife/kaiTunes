<?php
include "../model.php";
include "../config.php";
$lunbotu=getLunbotu();
$recommendsong=recommendSong(0);
$recommendsinger=recommendSinger(0);
$smarty->assign("lunbotu",$lunbotu);
$smarty->assign("recommendsong",$recommendsong);
$smarty->assign("recommendsinger",$recommendsinger);
$smarty->display("index.html");
//include "../view/itcast_categoryView.php";
?>

