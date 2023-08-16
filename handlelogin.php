<!-- 
    1- validation
    2- filteration
 -->
<?php
session_start();
require_once('classess.php');

if (!empty($_POST['email'] && !empty($_POST['password']) )) {
    echo '10/10';

    $email = htmlspecialchars(trim( $_POST['email'])) ;
    $password = md5(trim($_POST['password'])); 
    $user = user::login($email,$password);






    if (!empty($user)) {
        $_SESSION["user"] = serialize($user);
        header("location:home.php");
    }else{

        header("location:index.php?msg=w_e_p");
    }

}else{
    header("location:index.php?msg=empty_field");
}