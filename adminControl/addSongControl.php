<?php
include "../model.php";
include "../adminConfig.php";
if(!isset($_SESSION['username'])){
   session_start();
}
if(isset($_POST['sure'])){
    $data[0]=$_POST['gname'];
    $data[1]=$_POST['aname'];
    $data[2]=$_POST['sname'];
    $song="";
    if($data[1]==""){
        $data[1]="未知专辑";
    }
    if($data[0]==""){
       $data[0]="未知歌手";  
       $data[1]="未知专辑";
    }   
    $file=$_FILES['thumb'];   // 获取上传文件
   if(is_uploaded_file($file['tmp_name'])){   // 判断上传是不是通过HTTP POST上传的
        $str=stristr($file['name'],'.');         // stristr()函数获取上传文件的后缀 
       $path="../music/".iconv("UTF-8", "gbk",$data[0]." - ".$data[2].$str); 
            $result1=singerExist($data[0]);
            if(key($result1)==0){
                $data[0]=$result1[0];
                $result2=albumExist($data[0],$data[1]);
                if((key($result2)==0)){
                    $data[1]=$result2[0];          
                }else{
                    autoGoto(3,'addSongControl.php',$result2[1]);
                    exit();
                }
            }else{
                autoGoto(3,'addSongControl.php',$result1[1]);
                exit();
            }     
           $result=addSong($data);
            if(key($result)==0){
                if(move_uploaded_file($file['tmp_name'],$path)){   // 执行文件上传操作
                autoGoto(3,'addSongControl.php',$result[key($result)]);
                }else{
                
                autoGoto(3,'addSongControl.php','图片上传失败');   
                }
            }else{
                autoGoto(3,'addSongControl.php',$result[key($result)]);
            }
  }  
}else{
    $smarty->display('addSong.html');
}

// echo "<br><center><p style='font-size:1.2em'>www"
//    . "<br><span id='jump' style='color:red'>4</span>秒自动返回</font></center>";
// echo "<script language='JavaScript'>"
// . "function qqq(){"
// . "if(confirm('qurewwwww')){"
//         . "alert('vvvvv')"
//         . "}"
//         . "}"
//         . "qqq();"
//         . "</script>";
