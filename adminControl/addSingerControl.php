<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}
//$Tabsi=getTabsi();
////var_dump($Tabsi);
//$smarty->assign("Tabsi",$Tabsi[0]);
//$smarty->display("addSinger.html");
if(isset($_POST['sure'])){
    $data[0]=$_POST['cid'];
    $data[1]=$_POST['gname'];
    $data[2]=$_POST['is_best'];
    $data[3]=$_POST['description'];
    $singerImages="";
    $file=$_FILES['thumb'];   // 获取上传文件
    if(is_uploaded_file($file['tmp_name'])){   // 判断上传是不是通过HTTP POST上传的
        $str=stristr($file['name'],'.');         // stristr()函数获取上传文件的后缀
        // strtotime()函数定义一个Unix时间戳
        $path="../images/".strtotime("now").$str;   // 定义上传文件的存储位置
    $singerImages=strtotime("now").$str;
            $data[4]=$singerImages;
            $result=addSinger($data);
            if(key($result)==0){
                if(move_uploaded_file($file['tmp_name'],$path)){   // 执行文件上传操作
                autoGoto(5,'addSingerControl.php',$result[key($result)]);
                }else{
                autoGoto(5,'addSingerControl.php','图片上传失败');   
                }
            }else{
                autoGoto(5,'addSingerControl.php',$result[key($result)]);
            }
  }
    
//    $check=checkUserpwd($user,$password);
//    if(key($check))
//        echo $check[1];
//    else {
//        session_start();
//        $_SESSION['us']=$check[0];
//        include 'catControl.php';
//    }
//        
    
}else{
    $Tabsi=getTabsi();
    //var_dump($Tabsi);
    $smarty->assign("Tabsi",$Tabsi[0]);
    $smarty->display("addSinger.html");
}
