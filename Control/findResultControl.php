<?php
include "../model.php";
include "../config.php";

$content=$_GET['content'];
$result=find($content,0);
if(key($result)!=1){
    $smarty->assign("result",$result);
    $smarty->assign("content",$content);
    $smarty->display('findResult.html');
}else{
    autoGoto(5,'indexControl.php',$result[key($result)]);
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

