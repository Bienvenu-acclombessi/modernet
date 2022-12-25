<?php
session_start();
include("database.php");
?>
<?php
  $messages=$db->prepare('SELECT * FROM messagesn WHERE (id_exp=? AND id_dest=?) OR (id_exp=? AND id_dest=?) ORDER BY id ASC  ');
  $messages->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
  $nombreMessage=$messages->rowCount();
  if($nombreMessage>0){
    while($message=$messages->fetch()){
    ?>
      
             <?php if($message['id_exp']==$_SESSION['id']){ ?>

         <div class="row">
             <div class="col-6"></div>
             <div class="col-6">
             <div class="btn btn-primary user-message mb-3 overflow-hidden"><?=$message['message']?>
           <br>  <?php if($message['img']!=NULL) {?>
          <img src="img/<?=$message['img']?>" alt="" class="w-100">
          <?php } ?>
           </div>
             </div>
         </div>
         
        <?php } else {  ?>
       <div class="row">
           <div class="col-6">
           <div class="btn btn-light border-primary mb-2 overflow-hidden"><?=$message['message']?> <br>
        <?php if($message['img']!=NULL) {?>
        <img src="img/<?=$message['img']?>" alt="" class="w-100">
        <?php } ?></div>
           </div>
           <div class="col-6"></div>
       </div>
        <?php  } ?>


      <?php
    }
  }
  ?>
  <div id="fin"></div>