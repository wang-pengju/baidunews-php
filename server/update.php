<?php
header("Content-type:application/json;charset=utf-8");
require_once('db.php');

if($link){
	$newsid=htmlspecialchars($_POST['id']);
	$newstitle=htmlspecialchars($_POST['newstitle']);
    $newstype=htmlspecialchars($_POST['newstype']);
    $newsimg=htmlspecialchars($_POST['newsimg']);
    $newssrc=htmlspecialchars($_POST['newssrc']);
    $newstime=htmlspecialchars($_POST['newstime']);
	

	$sql="UPDATE `news` SET `newstitle`='{$newstitle}',`newstype`='{$newstype}',`newsimg`='{$newsimg}',`newssrc`='{$newssrc}',`newstime`='{$newstime}' WHERE `id`={$newsid}";
	mysqli_query($link,"SET NAMES utf8");
    $result=mysqli_query($link,$sql);

    echo json_encode(array('success'=>$sql));	
}

mysqli_close();

?>