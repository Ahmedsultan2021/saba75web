<!-- 
    1- validation
    2- filteration
 -->
 <?php

    require_once('classess.php');
if (!empty($_POST['email'] && !empty($_POST['password']) && !empty($_POST["name"]) )) {

    $email = htmlspecialchars(trim( $_POST['email'])) ;
    $password = md5(trim($_POST['password'])); 
    $name = trim($_POST['name']); 


    $rsult = user::signup($email,$password,$name);
  
}else{
    header("location:index.php?msg=empty_field");
}