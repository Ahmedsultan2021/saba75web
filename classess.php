<?php

class user{
    public $id;
    public $name;
    public $email;
    protected $password;
    public $role = "user";


    public function __construct($id,$name,$email,$password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    static function login($email,$password){
        $user = null;
        require_once('config.php');
        $qry = "SELECT * FROM USERS WHERE email = '$email' AND password = '$password' ";
        $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
        $rsult = mysqli_query($cn,$qry);
        if ($data = mysqli_fetch_assoc($rsult)) {
           switch ($data["role"]) {
            case 'user':
                $user = new user($data["id"],$data["name"],$data["email"],$data["password"]);
                break;
            case 'admin':
                $user = new admin($data["id"],$data["name"],$data["email"],$data["password"]);
                break;
           } 
        }
        mysqli_close($cn);
        return $user;

    }

    static function signup($email,$password,$name){

        var_dump($name,$password,$email);
        require_once('config.php');
        // $qry = "SELECT * FROM USERS WHERE email = '$email' AND password = '$password' ";
        $qry = "INSERT INTO USERS (name,email,password) VALUES('$name','$email','$password')";
        $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
        try {
            $rsult = mysqli_query($cn,$qry);
            mysqli_close($cn);
            return $rsult;
            header("location:index.php?msg=done");
        } catch (\Throwable $th) {
            mysqli_close($cn);
            header("location:signup.php?msg=e_a_exist");
        }
    }
    function addPost($content,$image,$user_id){
        require_once('config.php');
        $qry = "INSERT INTO posts(`content`,`image`,`users_id`) VALUES('$content','$image',$user_id)";
        $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
        $rslt = mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $rslt;

}
function DeletePost($post_id){

    require_once('config.php');
    $qry = "DELETE FROM posts where id = $post_id";
    $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
    $rslt = mysqli_query($cn,$qry);
    mysqli_close($cn);
    return $rslt;

}
function updatePost($content,$image){
    require_once('config.php');
    $qry = "UPDATE POSTS SET content = '$content' AND image = '$image'  ";
    $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
    $rslt = mysqli_query($cn,$qry);
    mysqli_close($cn);
    return $rslt;

}
function showMyPosts($user_id){

    require_once('config.php');
    // $qry = " SELECT posts.content,posts.image,users.name FROM POSTS,USERS join users on(users.id = posts.user_id) order by created_at desc  LIMIT 10 ";
    $qry = "select * from posts where users_id = $users_id ";
    $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
    $rslt = mysqli_query($cn,$qry);
    mysqli_close($cn);
    return $rslt;

}
static function showAllPosts(){

    require_once('config.php');
    $qry = "SELECT * FROM POSTS ORDER BY created_at desc limit 10";
    $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
    $rslt = mysqli_query($cn,$qry);
    $data = mysqli_fetch_all($rslt);
    mysqli_close($cn);
    return $rslt;

}
 function showrecientPosts(){

    require_once('config.php');
    $qry = "SELECT posts.content,posts.image,posts.created_at,users.name FROM POSTS  join users on(users.id = posts.users_id) ORDER BY created_at desc limit 3";
    $cn = mysqli_connect(BD_host,BD_user_name,BD_user_password,DB_name);
    $rslt = mysqli_query($cn,$qry);
    $data = mysqli_fetch_all($rslt);
    mysqli_close($cn);
    return $rslt;

}

function addcomment(){

}

function Deletecomment(){

}
function updatecomment(){

}

}

class admin extends user {
    public $role = "admin";
    function deleteUser(){
        
    }
    function showAllUsers(){

    }
}