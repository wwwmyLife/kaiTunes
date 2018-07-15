<?php
//获取轮播图
function getLunbotu(){  
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select lunbotuID,lunbotuPath from web_lunbotu limit 4";
    if($result=$pdo->query($sql))
    while($row=$result->fetch(PDO::FETCH_ASSOC))
        {
            $data[]=$row;       
        }
    $fanhui=array(0=>$data);
    return $fanhui;
      } 
    catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }
    }
//获取推荐歌曲
function recommendSong($offset){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select singername,songname,songID,singerImages from web_music limit 8 offset $offset";
    if($result=$pdo->query($sql))
      {
    while($row=$result->fetch(PDO::FETCH_ASSOC))
            $data[]=$row; 
        $fanhui=array(0=>$data);
        return $fanhui;
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//获取推荐歌手
function recommendSinger($offset){ 
    $i=0;
//    $j=0;$k=5;
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select singername,singerID,singerImages from web_singer limit 15 offset $offset";
    if($result=$pdo->query($sql))
      {
    while($row=$result->fetch(PDO::FETCH_ASSOC))
    {
        $data[]=$row;      
        $i++;
        if($i==5){
            $dataAll[]=$data;            
//             while($j<$k){
//                  unset($data[$j]); 
//                  $j++;
//             }
//            $k=$k+5;
                    unset($data);
            $i=0;
        }        
    }  
       return $dataAll;
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//歌手详情页数据
function singerinf($singerID){ 
    try{
        $data=array();
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
      $sql="select singerID,singername,singerImages,singerjieshao from web_singer where singerID=$singerID";
      if($result=$pdo->query($sql))
      {
        while($row=$result->fetch(PDO::FETCH_ASSOC))
            $data[]=$row; 
        $fanhui=array(0=>$data);
      }   
        return $fanhui; 
    }catch (Exception $e){
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//通过不同条件获取歌列表
function findSong($attr,$attrValue,$currenYe){ 
    try{
        $data=array();
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        if($currenYe==0){
            $sql0="select count(*) Total from web_music where $attr=$attrValue";
            $sql="select singername,songname,songID,singerImages,albumname,albumImages from web_music where $attr=$attrValue limit 10 offset $currenYe";
                    if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
//                        if($row['Total']>0){
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }    
//                        }                  
                    }            
        }else{
            $sql="select singername,songname,songID,singerImages,albumname,albumImages from web_music where $attr=$attrValue limit 10 offset $currenYe";
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(3=>$data);
                 }
        }
       return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//获取歌手的所有专辑
function singerAlbum($singerID,$currenYe){ 
    try{
        $data=array();
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        if($currenYe==0){
            $sql0="select count(*) Total from web_album where singerID=$singerID";
            $sql="select singerID,albumID,albumname,albumImages from web_album where singerID=$singerID limit 10 offset $currenYe";
                    if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }    
//                        }                  
                    }            
        }else{
            $sql="select singerID,albumID,albumname,albumImages from web_album where singerID=$singerID limit 10 offset $currenYe";
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(3=>$data);
                 }
        }
       return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}


//获取歌手推荐专辑
function singerOtherAlbum($albumID,$singerID){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select singerID,albumID,albumname,albumImages from web_album where singerID=$singerID and albumID!=$albumID limit 5";
    if($result=$pdo->query($sql))
      {
    while($row=$result->fetch(PDO::FETCH_ASSOC))
            $data[]=$row; 
        $fanhui=array(0=>$data);
        return $fanhui;
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//歌手分类页
function singerAll($ID){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        if($ID==0){
            $sql="select count(*) singerTotal from web_singer";
        }else
        {
            $sql="select count(*) singerTotal from web_singer where ID=$ID";
        } 
    if($result=$pdo->query($sql))
      {
    while($row=$result->fetch(PDO::FETCH_ASSOC))
            $data[]=$row; 
        $fanhui=array(0=>$data);
        //var_dump($fanhui);
      return $fanhui;
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}

function getsingerByID($tabsiID,$currentYe){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');   
        if($tabsiID==0){
            if($currentYe==0){
                $sql0="select count(*) singerTotal from web_singer";
                $sql1="select singerID,singername,singerImages from web_singer limit 12"; 
                $sql2="select singerID,singername from web_singer limit 24 offset 12"; 
                 if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                        if($row['singerTotal']<=12)
                        {   $a=$row['singerTotal'];
                            $sql2="select singerID,singername from web_singer limit 24 offset $a"; 
                        }
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql1))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }   
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql2))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }       
                    }      
            }else{
                $sql3="select singerID,singername from web_singer limit 48 offset $currentYe";
                if($result=$pdo->query($sql3))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(0=>$data);
                 }
             }  
        }
        else{
            if($currentYe==0){
               $sql0="select count(*) singerTotal from web_singer where tabsiID=$tabsiID";
               $sql1="select singerID,singername,singerImages from web_singer where tabsiID=$tabsiID limit 12"; 
               $sql2="select singerID,singername from web_singer where tabsiID=$tabsiID limit 24 offset 12"; 

                if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                        if($row['singerTotal']<=12)
                        {   $a=$row['singerTotal'];
                            $sql2="select singerID,singername from web_singer where tabsiID=$tabsiID limit 24 offset $a"; 
                        }
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql1))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }   
                             unset($data);
                             $data=array();
                             if($result=$pdo->query($sql2))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }       
                    }      
               
            }else{
                $sql3="select singerID,singername from web_singer where tabsiID=$tabsiID limit 48 offset $currentYe";
                if($result=$pdo->query($sql3))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(0=>$data);
                  }
             }   
        } 
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}



//获取歌手分类
function getTabsi(){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');       
        $sql="select tabsiID,tabname from web_singertab"; 
    if($result=$pdo->query($sql))
      {
    while($row=$result->fetch(PDO::FETCH_ASSOC))
            $data[]=$row; 
            $fanhui=array(0=>$data);
      } 
           return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
//用户注册
function zhuce($username,$pwd){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/
        $stmt=$pdo->prepare("select * from web_user where username=:username");
        $stmt->execute(array(':username'=>$username));  
    if($stmt->rowCount()){
        $fanhui=array(1=>"用户名已存在，请重新输入!");
         return $fanhui;
    }else{
        $stmt=$pdo->prepare("insert into web_user(username,pwd)values(:username,:pwd)");
        $stmt->execute(array(':username'=>$username,':pwd'=>$pwd));
       if($stmt->rowCount()){
        $fanhui=array(0=>"注册成功，立即登录!");
        }else{
            $fanhui=array(1=>"注册失败！");
        }
        return $fanhui;
    }
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}

//登录
function login($username,$pwd){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/
        $stmt=$pdo->prepare("select * from web_user where username=:username and pwd=:pwd");
        $stmt->execute(array(':username'=>$username,':pwd'=>$pwd));
    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
             $data['is_admin']=$row['is_admin'];
             $data['userID']=$row['userID'];
             $data['username']=$row['username'];
        }
        if($data['is_admin']==1){
            $fanhui=array(2=>$data);
        }else{
             $fanhui=array(0=>$data);
        }       
    }  
      else
          $fanhui=array(1=>"抱歉，无此用户，请先注册!");
          return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }   
}
//获取用户信息
function getUserinf($userID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/
        $stmt=$pdo->prepare("select * from web_user where userID=:userID");
        $stmt->execute(array(':userID'=>$userID));
    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
             $data['username']=$row['username'];
             $data['shengri']=$row['shengri'];
             $data['qianming']=$row['qianming'];
             $data['pwd']=$row['pwd'];
             $data['userImages']=$row['userImages'];
        }   
        $fanhui=array(0=>$data);
    }  
      else
          $fanhui=array(1=>"There is not this user!");
          return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}

//更新用户信息
function updateUser($data,$userID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/
        $stmt=$pdo->prepare("update web_user set username=:b,pwd=:c,shengri=:d,qianming=:e,userImages=:f where userID=$userID");
        $stmt->execute(array(':b'=>$data[0],':c'=>$data[1],':d'=>$data[2],':e'=>$data[3],':f'=>$data[4]));
        if($stmt->rowCount()){            
        $fanhui=array(0=>"修改成功!");
        }else{
            $fanhui=array(1=>"修改失败！");
        }
        return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}
//获取用户喜欢的歌曲列表
function getmyLike($userID,$currenYe){ 
    try{
        $data=array();
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        if($currenYe==0){
        $sql0="SELECT count(*) Total FROM web_music,web_mylike WHERE web_mylike.songID = web_music.songID AND web_mylike.userID = $userID limit 10 offset $currenYe";
        $sql="SELECT web_music.songID,likeID,songname,singername,singerImages,albumname FROM web_music,web_mylike WHERE web_mylike.songID = web_music.songID AND web_mylike.userID = $userID order by likeID DESC limit 10 offset $currenYe";
                    if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             if($result=$pdo->query($sql))
                             {
                                 $data=array();
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }    
//                        }                  
                    }            
        }else{
        $sql="SELECT web_music.songID,likeID,songname,singername,singerImages,albumname FROM web_music,web_mylike WHERE web_mylike.songID = web_music.songID AND web_mylike.userID = $userID order by likeID DESC limit 10 offset $currenYe";
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(3=>$data);
                 }
        }
       return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}


//添加喜欢的歌曲
function addlikeSong($userID,$songID){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/
        $stmt=$pdo->prepare("select * from web_mylike where userID=:userID and songID=:songID");
        $stmt->execute(array(':userID'=>$userID,':songID'=>$songID));  
    if($stmt->rowCount()){
        $fanhui=array(1=>"您喜欢的歌曲已经添加过啦!");
         return $fanhui;
    }else{
        $stmt=$pdo->prepare("insert into web_mylike(userID,songID)values(:userID,:songID)");
        $stmt->execute(array(':userID'=>$userID,':songID'=>$songID));
       if($stmt->rowCount()){
        $fanhui=array(0=>"收藏成功，快去查看吧!");
        }else{
            $fanhui=array(1=>"收藏失败！");
        }
        return $fanhui;
    }
    }catch (Exception $e){
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}
//批量添加喜欢的歌曲
function piliang_addlikeSong($userID,$songIDs){
    try{
        $exist=0;
        $success=0;
        $fail=0;
        $num=0;
        $result2=0;
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        //$fanhui=array(0=>"歌曲全部收藏成功！");
        //return $songIDs;
       foreach ($songIDs as $value){
            $result1=$pdo->query("select * from web_mylike where userID=$userID and songID=$value");
            $num=$result1->rowCount();
            if($num==0){
                $result2=$pdo->exec("insert into web_mylike(userID,songID) value($userID,$value)");
                if($result2>0){
                   // return "rrrr";
                    $success=$success+1;
                }else{
                   // return "wwww";
                    $fail=$fail+1;
                }
            }else{
                $exist=$exist+1;
              //  return "qqqq";
            }
            $num=0;
            $result2=0;
      }
        if($success==count($songIDs)){
            $fanhui=array(0=>"歌曲全部收藏成功！");
        }else if($success==0){
            $msg="所有选择歌曲已存在！";
            $fanhui=array(0=>$msg);
        }else if($fail==0){
            $msg="部分歌曲已存在,其他歌曲收藏成功";
            $fanhui=array(0=>$msg);
        }else{
            $msg="部分歌曲已存在,部分歌曲收藏失败，其他歌曲收藏成功";
            $fanhui=array(0=>$msg);
        }
       return $fanhui;
    }catch (Exception $e){
        $fanhui=array(0=>$e->getMessage());
         return $fanhui;
    }  
}
//删除喜欢的歌曲
function dellikeSong($userID,$songID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $stmt=$pdo->prepare("delete from web_mylike where userID=:userID and songID=:songID");
        $stmt->execute(array(':userID'=>$userID,':songID'=>$songID));
        if($stmt->rowCount()){  
                return (array(0=>"移除成功"));
            }
            else{
                return (array(1=>"移除失败"));  
            }
       }catch(PDOException $e){
                 return (array(1=>$e->getMessage())); 
            }   
    }
    
    //批量删除歌曲
    function piliang_dellikeSong($userID,$songIDs){
        try{
        $unexist=0;
        $success=0;
        $fail=0;
        $num=0;
        $result2=0;
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
       foreach ($songIDs as $value){
            $result1=$pdo->query("select * from web_mylike where userID=$userID and songID=$value");
            $num=$result1->rowCount();
            if($num!=0){
                $result2=$pdo->exec("delete from web_mylike where userID=$userID and songID=$value");
                if($result2>0){                 
                    $success=$success+1;
                }else{
                    $fail=$fail+1;
                }
            }else{
                $unexist=$unexist+1;         
            }
            $num=0;
            $result2=0;
      }
        if($success==count($songIDs)){
            $fanhui=array(0=>"歌曲全部删除成功！");
        }else if($success==0){
            $msg="所有选择歌曲不存在！";
            $fanhui=array(1=>$msg);
        }else if($fail==0){
            $msg="部分歌曲不存在,其他歌曲删除成功";
            $fanhui=array(2=>$msg);
        }else{
            $msg="部分歌曲不存在,部分歌曲删除失败，其他歌曲删除失败";
            $fanhui=array(3=>$msg);
        }
       return $fanhui;
    }catch (Exception $e){
        $fanhui=array(0=>$e->getMessage());
         return $fanhui;
    }  
    }
    
    //后台功能函数
    
    
    //跳转页面
    function autoGoto($secs,$location,$inf){
    echo "<br><center><p style='font-size:1.2em'>$inf"
    . "<br><span id='jump' style='color:red'>$secs</span>秒自动返回</font></center>";
    echo "<script language='JavaScript'>"
    . "function countDown(secs){"
            . "jump.innerText=secs;"
            . "if(--secs >= 0) {"
            . "setTimeout('countDown(' + secs + ')',1000);"
            . "} else {"
            . "location.href = '$location';"
            . "}"
            . "}"
            . "countDown($secs)"
            . "</script>";
}
 
    //获取所有用户信息,并分页显示

function getMenberInf($currentYe){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');                         
            if($currentYe==0){
                $sql0="select count(*) userTotal from web_user where is_admin!=1";
                $sql="SELECT * FROM web_user where is_admin!=1 limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
                     unset($data);
                    if($result=$pdo->query($sql0))
                    {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui[]=$data;
                    }
            }
               else{
                   $sql="SELECT * FROM web_user where is_admin!=1 limit 2 offset $currentYe";            
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
               }
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
    
    //删除功能，包括用户，歌手等
    function delFunction($ID,$falg){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        if($falg==0){
            $stmt=$pdo->prepare("delete from web_user where userID=:userID");
        $stmt->execute(array(':userID'=>$ID));
        if($stmt->rowCount()){  
                return (array(0=>"删除成功"));
            }
            else{
                return (array(1=>"删除失败"));  
            }
        }
        if($falg==1){
            $stmt=$pdo->prepare("delete from web_songs where singerID=:singerID");   
            $stmt->execute(array(':singerID'=>$ID));
            if($stmt->rowCount()){
                $stmt=$pdo->prepare("delete from web_album where singerID=:singerID");   
                $stmt->execute(array(':singerID'=>$ID));
                if($stmt->rowCount()){
                    $stmt=$pdo->prepare("delete from web_singer where singerID=:singerID");   
                    $stmt->execute(array(':singerID'=>$ID));
                    if($stmt->rowCount()){
                         $fanhui=(array(0=>"删除歌手所有资料成功！"));
                    }else{
                        $fanhui=(array(1=>"歌手媒体文件删除成功，专辑、歌曲删除成功，删除歌手信息失败！"));
                    }   
                }else{
                     $fanhui=(array(1=>"歌手媒体文件删除成功，歌曲删除成功，删除专辑失败！"));  
                }   
            }
            else{
                $fanhui=(array(1=>"歌手媒体文件删除成功，数据库信息删除失败"));  
            }
        }
        if($falg==2){
            $stmt=$pdo->prepare("delete from web_songs where albumID=:albumID");   
            $stmt->execute(array(':albumID'=>$ID));
            if($stmt->rowCount()){
                $stmt=$pdo->prepare("delete from web_album where albumID=:albumID");   
                $stmt->execute(array(':albumID'=>$ID));
                if($stmt->rowCount()){
                         $fanhui=(array(0=>"删除专辑所有资料成功！"));
                }else{
                     $fanhui=(array(1=>"专辑媒体文件及歌曲信息删除成功，专辑信息删除失败！"));
                }   
            }
            else{
                $fanhui=(array(1=>"专辑媒体文件删除成功，数据库信息删除失败"));  
            }
        }
        if($falg==3){
            $stmt=$pdo->prepare("delete from web_songs where songID=:songID");   
            $stmt->execute(array(':songID'=>$ID));
            if($stmt->rowCount()){             
                $fanhui=(array(0=>"删除歌曲及文件成功！"));
            }
            else{
                $fanhui=(array(1=>"歌曲文件删除成功，数据库信息删除失败"));  
            }
        }
        return $fanhui;
       }catch(PDOException $e){
                 return (array(1=>$e->getMessage())); 
            }   
    }
    

    
    //添加歌手
    function addSinger($data){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/  
        $stmt=$pdo->prepare("select * from web_singer where singername=:a");
        $stmt->execute(array(':a'=>$data[1]));
    if($stmt->rowCount()){
        $fanhui=array(1=>"您添加的歌手已经存在啦!");
         return $fanhui;
    }else{
        $stmt=$pdo->prepare("insert into web_singer(tabsiID,singername,singerImages,is_re_singer,singerjieshao) values(:b,:c,:d,:e,:f)");
        $stmt->execute(array(':b'=>$data[0],':c'=>$data[1],':d'=>$data[4],':e'=>$data[2],':f'=>$data[3]));
        if($stmt->rowCount()){            
        $fanhui=array(0=>"添加成功，快去查看吧!");
        }else{
            $fanhui=array(1=>"添加失败！");
        }
        return $fanhui;
    }
    }catch (Exception $e){
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}
//添加专辑

function addAlbum($data){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/  
        $stmt=$pdo->prepare("select * from web_album where singerID=:a and albumname=:b");
        $stmt->execute(array(':a'=>$data[0],':b'=>$data[1]));
    if($stmt->rowCount()){
        $fanhui=array(1=>"您添加的专辑已经存在了!");
         return $fanhui;
    }else{
        $stmt=$pdo->prepare("insert into web_album(singerID,albumname,albumimages) values(:b,:c,:d)");
        $stmt->execute(array(':b'=>$data[0],':c'=>$data[1],':d'=>$data[2]));
        if($stmt->rowCount()){
        $fanhui=array(0=>"添加成功，快去查看吧!");
        }else{
            $fanhui=array(1=>"添加失败！");
        }
        return $fanhui;
    }
    }catch (Exception $e){
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
}

//添加歌曲
    function addSong($data){
        try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        /*PDO预处理防止sql注入*/  
        $stmt=$pdo->prepare("select * from web_songs where singerID=:a and albumID=:b and songname=:c");
        $stmt->execute(array(':a'=>$data[0],':b'=>$data[1],':c'=>$data[2]));
    if($stmt->rowCount()){
        $fanhui=array(1=>"您添加的歌曲已经存在了!");
         return $fanhui;
    }else{
        $stmt=$pdo->prepare("insert into web_songs(singerID,albumID,songname) values(:b,:c,:d)");
        $stmt->execute(array(':b'=>$data[0],':c'=>$data[1],':d'=>$data[2]));
        if($stmt->rowCount()){
        $fanhui=array(0=>"添加成功，快去查看吧!");
        }else{
            $fanhui=array(1=>"添加失败！".$data[0]."www".$data[1].$data[2]);
        }
        return $fanhui;
    }
    }catch (Exception $e){
        $fanhui=array(1=>$e->getMessage());
         return $fanhui;
    }  
    }

    //检查歌手是否存在
    function singerExist($singername){
        try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="SELECT singerID FROM web_singer where singername=:singername";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(':singername'=>$singername));    
    if($stmt->rowCount())
      {
        while($row=$stmt->fetch())
            $data['singerID']=$row['singerID']; 
            $fanhui=array(0=>$data['singerID']);
            return $fanhui;
      }else{
          return array(1=>"您填写的歌手不存在，请出门左转添加该歌手！");
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
    }
    
    //歌手专辑是否存在
    function albumExist($singerID,$albumname){
         try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="SELECT albumID FROM web_album where singerID=:singerID and albumname=:albumname";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(':singerID'=>$singerID,':albumname'=>$albumname));    
    if($stmt->rowCount())
      {
        while($row=$stmt->fetch())
            $data['albumID']=$row['albumID']; 
            $fanhui=array(0=>$data['albumID']);
            return $fanhui;
      }else{
          if($albumname=="未知专辑"){
              $stmt=$pdo->prepare("insert into web_album(singerID,albumname,albumimages) values(:b,:c,:d)");
              $stmt->execute(array(':b'=>$singerID,':c'=>$albumname,':d'=>"singer0.jpg"));
              if($stmt->rowCount()){
                  $ID=$pdo->lastInsertId();
                  $fanhui=array(0=>$ID);
                  return $fanhui;
              }else{
                  return array(1=>"添加失败啦！");
              }
          }else{
              return array(1=>"该歌手不存在该专辑，请出门左转添加该专辑！");
          }  
      } 
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
    }
    
    
    //歌手列表页
    function getsingerlibiaoByID($tabsiID,$currentYe){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');   
        if($tabsiID==0){ 
            if($currentYe==0){
                $sql0="select count(*) singerTotal from web_singer";
                $sql="select singerID,singername,tabname,is_re_singer from web_singer,web_singertab where web_singer.tabsiID=web_singertab.tabsiID limit 2 offset $currentYe";
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
                     unset($data);
                    if($result=$pdo->query($sql0))
                    {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui[]=$data;
                    }
            }else{
               $sql="select singerID,singername,tabname,is_re_singer from web_singer,web_singertab where web_singer.tabsiID=web_singertab.tabsiID limit 2 offset $currentYe";
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
               }
        }
        else{                      
            if($currentYe==0){
                $sql0="select count(*) singerTotal from web_singer where tabsiID=$tabsiID";
                $sql="select singerID,singername,tabname,is_re_singer from web_singer,web_singertab where web_singer.tabsiID=web_singertab.tabsiID and  web_singer.tabsiID=$tabsiID limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
                     unset($data);
                    if($result=$pdo->query($sql0))
                    {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui[]=$data;
                    }
            }
               else{
                $sql="select singerID,singername,tabname,is_re_singer from web_singer,web_singertab where web_singer.tabsiID=web_singertab.tabsiID and web_singer.tabsiID=$tabsiID limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
               }
        } 
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
    
//专辑列表
function getalbumlibiaoByID($singerID,$currentYe){ 
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');                         
            if($currentYe==0){
                $sql0="select count(*) albumTotal from web_album where singerID=$singerID";
                $sql="select albumID,albumname,singername from web_singer,web_album where web_singer.singerID=web_album.singerID and  web_album.singerID=$singerID limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
                     unset($data);
                    if($result=$pdo->query($sql0))
                    {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui[]=$data;
                    }
                    unset($data);
                    $fanhui[]=array(0=>$singerID);
            }
               else{
                $sql="select albumID,albumname,singername from web_singer,web_album where web_singer.singerID=web_album.singerID and  web_album.singerID=$singerID limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(2=>$data);
                 }
               }
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
    }    
}
    
    


function delfileBysinger($ID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select singerImages,albumImages,singername,songname from web_music where singerID=$ID";   
                         if($result=$pdo->query($sql)){
                             while($row=$result->fetch(PDO::FETCH_ASSOC)){
                                 $data[]=$row;
                             }
                             $singerFile="../images/";
                             $albumFile="../images/";
                             $songFile="../music/";
                             $singerFalg=true;
                             $albumFalg=true;
                             $count=0;
                             foreach ($data as $key => $value) {
                                 $singerFile=$singerFile.$value['singerImages'];
                                 $albumFile=$albumFile.$value['albumImages'];
                                 $songFile=$songFile.$value['singername']." - ".$value['songname'].".mp3";
                                 $songFile=iconv("utf-8","gb2312",$songFile);
                                 if($singerFalg&&file_exists($singerFile)){
                                     fopen($singerFile,'a+');
                                     if(unlink($singerFile)){
                                         $singerFalg=false;
                                     }
                                 }
                                 if(file_exists($albumFile)){
                                     fopen($albumFile,'a+');
                                     if(unlink($albumFile)){
                                         $albumFalg=false;
                                     }
                                 } 
                                 if(file_exists($songFile)){
                                     fopen($songFile,'a+');
                                     if(unlink($songFile)){
                                         $count++;
                                     }
                                 }
                                 $singerFile="../images/";
                                 $albumFile="../images/";
                                 $songFile="../music/";   
                             }
                             if(!$singerFalg&&!$albumFalg&&$count==count($data)){
                                 $fanhui=(array(0=>"删除歌手相关文件成功！"));
                             }else if($singerFalg&&$albumFalg){
                                 $fanhui=(array(1=>"删除歌手图片文件成功，歌曲文件删除失败！"));
                             }else if($count==count($data)){
                                 $fanhui=(array(1=>"删除歌手图片文件失败，歌曲文件删除成功！"));
                             }else{
                                 $fanhui=(array(1=>"删除歌手相关图片音频文件失败！"));
                             }
                         }else{
                              $fanhui=(array(1=>"歌手相关图片音频文件删除失败！"));
                         }
                         return $fanhui;
       }catch(PDOException $e){
                 return (array(1=>$e->getMessage())); 
            }   
}


function delfileByalbum($ID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select albumImages,singername,songname from web_music where albumID=$ID";   
                         if($result=$pdo->query($sql)){
                             while($row=$result->fetch(PDO::FETCH_ASSOC)){
                                 $data[]=$row;
                             }
                             $albumFile="../images/";
                             $songFile="../music/";
                             $albumFalg=true;
                             $count=0;
                             foreach ($data as $key => $value) {
                                 $albumFile=$albumFile.$value['albumImages'];
                                 $songFile=$songFile.$value['singername']." - ".$value['songname'].".mp3";
                                 $songFile=iconv("utf-8","gb2312",$songFile);
                                 if(file_exists($albumFile)){
                                     fopen($albumFile,'a+');
                                     if(unlink($albumFile)){
                                         $albumFalg=false;
                                     }
                                 } 
                                 if(file_exists($songFile)){
                                     fopen($songFile,'a+');
                                     if(unlink($songFile)){
                                         $count++;
                                     }
                                 }
                                 $albumFile="../images/";
                                 $songFile="../music/";   
                             }
                             if(!$albumFalg&&$count==count($data)){
                                 $fanhui=(array(0=>"删除专辑相关文件成功！"));
                             }else if($albumFalg){
                                 $fanhui=(array(1=>"删除专辑图片文件成功，歌曲文件删除失败！"));
                             }else if($count==count($data)){
                                 $fanhui=(array(1=>"删除专辑图片文件失败，歌曲文件删除成功！"));
                             }else{
                                 $fanhui=(array(1=>"删除专辑相关图片音频文件失败！"));
                             }
                         }else{
                              $fanhui=(array(1=>"专辑相关图片音频文件删除失败！"));
                         }
                         return $fanhui;
       }catch(PDOException $e){
                 return (array(1=>$e->getMessage())); 
            }   
}


function delfileBysong($ID){
    try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');
        $sql="select singername,songname from web_music where songID=$ID";   
                         if($result=$pdo->query($sql)){
                             while($row=$result->fetch(PDO::FETCH_ASSOC)){
                                 $data[]=$row;
                             }
                             $songFile="../music/";
                             $songfalg=true;
                             $count=0;
                             foreach ($data as $key => $value) {
                                 $songFile=$songFile.$value['singername']." - ".$value['songname'].".mp3";
                                 $songFile=iconv("utf-8","gb2312",$songFile);
                                 if(file_exists($songFile)){
                                     fopen($songFile,'a+');
                                     if(unlink($songFile)){
                                         $songfalg=false;
                                         $count++;
                                     }
                                 }
                                 $songFile="../music/";   
                             }
                             if($count==count($data)){
                                 $fanhui=(array(0=>"删除歌曲相关文件成功！"));
                             }else{
                                 $fanhui=(array(1=>"删除歌曲相关图片音频文件失败！"));
                             }
                         }else{
                              $fanhui=(array(1=>"歌曲相关图片音频文件删除失败！"));
                         }
                         return $fanhui;
       }catch(PDOException $e){
                 return (array(1=>$e->getMessage())); 
            }   
}


function search($name,$currentYe){
        try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');                         
            if($currentYe==0){
                $sql0="select count(*) Total from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%'";
                $sql="select songID,songname,singername,albumname,singerImages from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%' limit 2 offset $currentYe";                
                if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                        if($row['Total']>0){
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             if($result=$pdo->query($sql))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }    
                        }else{
                             $fanhui=array(1=>"sorry，木有找到你想要的信息。。。");
                             return $fanhui;
                        }                    
                    }                    
            }
               else{
                $sql="select songID,songname,singername,albumname,singerImages from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%' limit 2 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(3=>$data);
                 }
               }
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
}
}

function find($name,$currentYe){
        try{
        $dsn="mysql:host=localhost;dbname=web;charset=utf8";
        $pdo=new PDO($dsn,"root",'');                         
            if($currentYe==0){
                $sql0="select count(*) Total from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%'";
                $sql="select songID,songname,singername,albumname,singerImages from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%' limit 10 offset $currentYe";                
                if( $result=$pdo->query($sql0))
                    {
                        $row=$result->fetch(PDO::FETCH_ASSOC);
                        if($row['Total']>0){
                             $data[]=$row; 
                             $fanhui=array(2=>$data);
                             unset($data);
                             if($result=$pdo->query($sql))
                             {
                              while($row=$result->fetch(PDO::FETCH_ASSOC))
                                     $data[]=$row; 
                                     $fanhui[]=$data;
                             }    
                        }else{
                             $fanhui=array(1=>"sorry，木有找到你想要的信息。。。");
                             return $fanhui;
                        }                    
                    }                    
            }
               else{
                $sql="select songID,songname,singername,albumname,singerImages from web_music where songname LIKE '%$name%' or singername LIKE '%$name%' or albumname LIKE '%$name%' limit 10 offset $currentYe";                
                if($result=$pdo->query($sql))
                 {
                  while($row=$result->fetch(PDO::FETCH_ASSOC))
                          $data[]=$row; 
                          $fanhui=array(3=>$data);
                 }
               }
      return $fanhui;
    }catch (Exception $e) {
        $fanhui=array(1=>$e->getMessage());
        return $fanhui;
}
}
