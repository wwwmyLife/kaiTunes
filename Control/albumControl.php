<?php
include "../model.php";
include "../config.php";
$albumID=$_GET["albumID"];
$singerID=$_GET["singerID"];
$albumSong=findSong("albumID",$albumID,0);
$singerOtherAlbum=singerOtherAlbum($albumID,$singerID);
$smarty->assign("albumSong",$albumSong);
$smarty->assign("singerOtherAlbum",$singerOtherAlbum[0]);
$smarty->assign("albumID",$albumID);
//$smarty->assign("singerAlbum",$singerAlbum[0]);
$smarty->display("albumSong.html",$albumID);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

