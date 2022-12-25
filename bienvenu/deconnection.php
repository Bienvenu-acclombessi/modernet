<?php

session_start();

$_SESSION ==array();
setcookie('id',0, time() + 7*24*3600, null, null,false, true);
       
session_destroy();
header("Location: login.php");
?>