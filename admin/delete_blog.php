
<?php
session_start();
require('security.php');
require('database.php');

if(isset($_GET['id_blog'])){
    $del = $db->prepare('DELETE FROM blogs WHERE id_blog=?');
    $del->execute([$_GET['id_blog']]);

}
header('location: blog.php');