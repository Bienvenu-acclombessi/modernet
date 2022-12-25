<?php 
try{
 //$db=new PDO('mysql:host=localhost;dbname=modernet;charset=utf8','root','');
  $db=new PDO('mysql:host=localhost;dbname=u821423679_modernetsoft;charset=utf8','u821423679_modernet','Bienvenu1');
}
catch(Exception $e)
{
  die('Erreur:'.$e->getMessage());
}
if(isset($_COOKIE['id']) AND $_COOKIE['id']!=0){
  $_SESSION['id']=$_COOKIE['id'];
}