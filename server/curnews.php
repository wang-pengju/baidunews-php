<?php

header("Content-type:application/json;charset=utf-8");
require_once('db.php');

if($link){
   $newsid=$_GET['newsid'];
   mysqli_query($link,"SET NAMES utf8");
   $sql="SELECT * FROM `news` WHERE `id`={$newsid}";

   $result=mysqli_query($link,$sql);
   $senddata=array();
   while($row=mysqli_fetch_assoc($result)){
      array_push($senddata,array(
        'id'=>htmlspecialchars_decode($row['id']),
        'newstitle'=>htmlspecialchars_decode($row['newstitle']),
        'newstype'=>htmlspecialchars_decode($row['newstype']), 
        'newsimg'=>htmlspecialchars_decode($row['newsimg']),
        'newssrc'=>htmlspecialchars_decode($row['newssrc']),
        'newstime'=>htmlspecialchars_decode($row['newstime'])
      ));
   }
   echo json_encode($senddata);
}

mysqli_close($link);

?>