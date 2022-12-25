<?php 
try{
  $db=new PDO('mysql:host=localhost;dbname=u821423679_boutique','u821423679_Prince','Bienvenu1');
}
catch(Exception $e)
{
  die('Erreur:'.$e->getMessage());
}
if(isset($_COOKIE['id']) AND $_COOKIE['id']!=0){
  $_SESSION['id']=$_COOKIE['id'];
}