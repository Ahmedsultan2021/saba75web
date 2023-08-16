<?php
session_start();
require_once('classess.php');
$user = unserialize($_SESSION["user"]);
require_once('navbar.php');
?>


<div class="container">
    <div class="row">
        <div class="col text-center">
            <img src="profile.png" style="width: 100px;" alt="">
            <h1> welcome <?= $user->name ?> </h1> 
        
        </div>
    </div>
   <form action="handleAddpost.php" method="post" enctype="multipart/form-data" >
     
     <div class="row my-5">

         <div class="col-2"></div>
         <div class="col-8">
            <?php
      if (!empty($_GET["msg"]) && $_GET["msg"] == 'done') {
      ?>
        <div class="alert alert-success" role="alert">
          <strong>Alert</strong> successfully sign up
        </div>

      <?php
      }
      ?>
             <div class="mb-3">
                 <div class="mb-3">
                   <label for="" class="form-label">image</label>
                   <input type="file"
                     class="form-control" name="image" id="" aria-describedby="helpId" placeholder="">
                 </div>
               <label for="" class="form-label">share your ideas</label>
               <textarea class="form-control" name="content" id="" rows="3"></textarea>
             </div>
             <button type="submit" class="btn btn-primary">Submit</button>
    
         </div>
         <div class="col-2"></div>
        </div>
    </form>
</div>






<?php
require_once('footer.php')
?>