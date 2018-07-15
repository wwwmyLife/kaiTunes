<?php
include "../model.php";
include "../config.php";
$singerID=$_GET["singerID"];
$singerinf=singerinf($singerID);
$singerSong=findSong("singerID",$singerID,0);
$singerAlbum=singerAlbum($singerID,0);
$smarty->assign("singerinf",$singerinf[0]);
$smarty->assign("singerSong",$singerSong);
$smarty->assign("singerAlbum",$singerAlbum);
$smarty->display("singerIndex.html",$singerID);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

