<?php

require_once 'functions.php';

//manage signup
if(isset($_GET['signup'])){
    $response = checkSignUpForm($_POST);
    if($response['status']){

        if(newUserCreation($_POST)){

            header('location:../../?login');

        }else{
            echo "<script>alert('Something went wrong!')</script>";
        }

    }else{
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
        header("location:../../?signup");
    }
}

//manage login

if(isset($_GET['login'])){

 
     $response = checkUserLogin($_POST);
    if($response['status'])
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['userdata'] = $response['user'];
        header("location:../../?login");
    }
    else{
        echo "user is not logged in";
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
    header("location:../../?login");}
    
    
}

if(isset($_GET['logout'])){
    session_destroy();
    header('location:../../');
}

