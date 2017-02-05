<?php
header("Content-type:application/json;charset=utf-8");

require_once('db.php');

if($link){
   //插入新闻
   $newstitle=htmlspecialchars($_POST['newstitle']);
   $newstype=htmlspecialchars($_POST['newstype']);
   $newsimg=htmlspecialchars($_POST['newsimg']);
   $newssrc=htmlspecialchars($_POST['newssrc']);
   $newstime=htmlspecialchars($_POST['newstime']);   

   $sql="INSERT INTO `news` (`newstitle`,`newstype`,`newsimg`,`newssrc`,`newstime`) VAlUES ('{$newstitle}','{$newstype}','{$newsimg}','{$newssrc}','{$newstime}')";
   mysqli_query($link,"SET NAMES utf8");
   $result=mysqli_query($link,$sql);

   echo json_encode(array('success'=>'ok'));
}

?>