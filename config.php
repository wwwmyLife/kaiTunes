<?php
include "../Smarty/Smarty.class.php";
$smarty=new Smarty;
$smarty->left_delimiter="<{";
$smarty->right_delimiter="}>";
$smarty->compile_dir="../view_c/";
$smarty->template_dir="../view/";
$smarty->caching=false;
$smarty->cache_lifetime=200;
$smarty->cache_dir='../cache/';
