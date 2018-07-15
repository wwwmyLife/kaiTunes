<?php
include "../model.php";
include "../config.php";
if(!isset($_SESSION['username'])){
   session_start();
   $userID=$_SESSION['userID'];
}
if(isset($_POST['sure'])){
    $data[0]=$_POST['uname'];
    $data[1]=$_POST['pwd'];
    $data[2]=$_POST['year'].".".$_POST['mouth'].".".$_POST['day'];
    $data[3]=$_POST['description'];
    //$data[4]=$_POST['img'];
    $singerImages="";
    $file=$_FILES['thumb'];   // 获取上传文件
    if(!empty($file['tmp_name'])){
        if(is_uploaded_file($file['tmp_name'])){   // 判断上传是不是通过HTTP POST上传的
        $str=stristr($file['name'],'.');         // stristr()函数获取上传文件的后缀
        // strtotime()函数定义一个Unix时间戳
        $path="../images/".strtotime("now").$str;   // 定义上传文件的存储位置
        $singerImages=strtotime("now").$str;
            $data[4]=$singerImages;
            $result=updateUser($data,$userID);
            if(key($result)==0){
                $img=iconv("utf-8","gb2312","../images/".$_POST['img']);
                 if(file_exists($img)){
                    fopen($img,'a+');
                    if(unlink($img)){//删除原图片
                    }
                 }
                if(move_uploaded_file($file['tmp_name'],$path)){   // 执行文件上传操作                   
                autoGoto(5,'myControl.php',$result[key($result)]);
                }else{
                autoGoto(5,'myControl.php','图片上传失败');   
                }
            }else{
                autoGoto(5,'myControl.php',$result[key($result)]);
            }
        }
    }else{
        $data[4]=$_POST['img'];
        $result=updateUser($data,$userID);
        if(key($result)==0){              
                autoGoto(5,'myControl.php',$result[key($result)]);
            }else{
                autoGoto(5,'myControl.php',$result[key($result)]);
            }
    }    
}else{ 
    $userinf=getUserinf($userID);
    //var_dump($Tabsi);
    $shengri=explode(".", $userinf[0]['shengri']); 
    $userinf[0]['shengri']=$shengri;
    $smarty->assign("userinf",$userinf[0]);
    $smarty->display("userInf.html");
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

