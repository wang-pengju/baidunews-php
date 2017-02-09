<?php
header("Content-type:application/json;charset=utf-8");
require_once('db.php');

if($link){
    foreach ($_POST as $key => $value) {
        $_POST[$key]=addslashes(htmlspecialchars($value));
    }
	$newsid=$_POST['id'];
	$newstitle=$_POST['newstitle'];
    $newstype=$_POST['newstype'];
    $newsimg=$_POST['newsimg'];
    $newssrc=$_POST['newssrc'];
    $newstime=$_POST['newstime'];
	

	$sql="UPDATE `news` SET `newstitle`='{$newstitle}',`newstype`='{$newstype}',`newsimg`='{$newsimg}',`newssrc`='{$newssrc}',`newstime`='{$newstime}' WHERE `id`={$newsid}";
	mysqli_query($link,"SET NAMES utf8");
    $result=mysqli_query($link,$sql);

    echo json_encode(array('success'=>$sql));	
}

mysqli_close($link);

?>