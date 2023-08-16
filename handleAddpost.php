<?php
session_start();
require_once("classess.php");

// var_dump($_POST);
if (empty($_POST["content"])|| empty($_FILES["image"])) 
{
    header("location:home.php?erorr=empty_field");
}
else{
    $user =  unserialize($_SESSION["user"]);
    $content = htmlspecialchars( trim($_POST["content"]));
    
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
    $file_name = "images/posts/".date("YmdHis").".".$file_extension;
    $user_id = $user->id;
    move_uploaded_file($_FILES["image"]["tmp_name"],$file_name);
    
    $rslt = $user->addPost($content,$file_name,$user_id);
    header("location:profile.php?msg=done");
} 