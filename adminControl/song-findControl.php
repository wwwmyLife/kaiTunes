<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}
$smarty->display('song-find.html');



