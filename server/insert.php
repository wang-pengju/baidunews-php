<?php
header("Content-type:application/json;charset=utf-8");

require_once('db.php');
session_start();
if($link){
    
   if($_POST['newstoken']==$_SESSION['token']){
   //插入新闻
      foreach ($_POST as $key => $value) {
         $_POST[$key]=addslashes(htmlspecialchars($value));
      };
      $newstitle=$_POST['newstitle'];
      $newstype=$_POST['newstype'];
      $newsimg=$_POST['newsimg'];
      $newssrc=$_POST['newssrc'];
      $newstime=$_POST['newstime'];   
      
      $sql="INSERT INTO `news` (`newstitle`,`newstype`,`newsimg`,`newssrc`,`newstime`) VAlUES ('{$newstitle}','{$newstype}','{$newsimg}','{$newssrc}','{$newstime}')";
      mysqli_query($link,"SET NAMES utf8");
      $result=mysqli_query($link,$sql);
      
      echo json_encode(array('success'=>'ok'));
   
   }; 

}

?>