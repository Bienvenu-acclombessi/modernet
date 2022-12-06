<?php 
try{
 $db=new PDO('mysql:host=localhost;dbname=modernet;charset=utf8','root','');
  //$db=new PDO('mysql:host=localhost;dbname=u361762779_BRINKFinance;charset=utf8','u361762779_BRINKFinance','Abdoulayeezechiel1#');

}
catch(Exception $e)
{
  die('Erreur:'.$e->getMessage());
}
if(isset($_COOKIE['id']) AND $_COOKIE['id']!=0){
  $_SESSION['id']=$_COOKIE['id'];
}