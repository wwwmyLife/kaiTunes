<?php
include "../Smarty/Smarty.class.php";
$smarty=new Smarty;
$smarty->left_delimiter="<{";
$smarty->right_delimiter="}>";
$smarty->compile_dir="../view_c/";
$smarty->template_dir="../adminView/";
//$smarty->caching=true;
//$smarty->cache_lifetime=200;
//$smarty->cache_dir='../cache/';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

