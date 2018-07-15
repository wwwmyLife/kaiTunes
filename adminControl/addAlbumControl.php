<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}
if(isset($_POST['sure'])){
    $data[0]=$_POST['gname'];
    $data[1]=$_POST['aname'];
    $result1=singerExist($data[0]);
    if(key($result1)==0){
        $data[0]=$result1[0];
    }else{
        autoGoto(3,'addAlbumControl.php',$result1[1]);
        exit();
    }
    $albumImages="";
    $file=$_FILES['thumb'];   // 获取上传文件
    if(is_uploaded_file($file['tmp_name'])){   // 判断上传是不是通过HTTP POST上传的
        $str=stristr($file['name'],'.');         // stristr()函数获取上传文件的后缀
        // strtotime()函数定义一个Unix时间戳
        $path="../images/".strtotime("now").$str;   // 定义上传文件的存储位置
         $albumImages=strtotime("now").$str;
            $data[2]=$albumImages;
            $result=addAlbum($data);
            if(key($result)==0){
                if(move_uploaded_file($file['tmp_name'],$path)){   // 执行文件上传操作
                autoGoto(3,'addAlbumControl.php',$result[key($result)]);
                }else{
                autoGoto(3,'addAlbumControl.php','图片上传失败');   
                }
            }else{
                autoGoto(3,'addAlbumControl.php',$result[key($result)]);
            }  
  }   
}else{
   
    $smarty->display("addAlbum.html");
}
