<?php
session_start();
$token=md5(time()."DMI_RANDOM_USED_ONLY_ONCE")
$_SESSION[$token]=$token;

echo $token;

?>