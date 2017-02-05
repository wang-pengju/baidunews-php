<?php

header("Content-type:application/json;charset=utf-8");
require_once('db.php');


if($link){

  if(@$_GET['newstype']){
    $newstype=$_GET['newstype'];
    $sql="SELECT * FROM `news` WHERE `newstype`='{$newstype}' order by id desc";
    mysqli_query($link,'SET NAMES utf8');
    $result=mysqli_query($link,$sql);
    $senddata=array();
    while($row=mysqli_fetch_assoc($result)){
      array_push($senddata,array(
        'id'=>$row['id'],
        'newstitle'=>$row['newstitle'],
        'newstype'=>$row['newstype'],
        'newsimg'=>$row['newsimg'],
        'newssrc'=>$row['newssrc'],
        'newstime'=>$row['newstime']
      ));
    }
    echo json_encode($senddata);
  }else{
    $sql='SELECT * FROM news order by id desc';
    mysqli_query($link,'SET NAMES utf8');
    $result=mysqli_query($link,$sql);
    $senddata=array();
    while($row=mysqli_fetch_assoc($result)){
      array_push($senddata,array(
        'id'=>$row['id'],
        'newstitle'=>$row['newstitle'],
        'newstype'=>$row['newstype'],
        'newsimg'=>$row['newsimg'],
        'newssrc'=>$row['newssrc'],
        'newstime'=>$row['newstime']
      ));
    }
    echo json_encode($senddata);
  }
}else{

  echo json_encode(array('success'=>'none'));
}
     
     mysqli_close($link);
?>