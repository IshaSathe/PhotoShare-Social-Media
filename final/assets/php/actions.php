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
if(isset($_GET['profile'])){
    $response = getUserByEmail($_POST);
    if($response['status'])
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['userdata'] = $response['user'];
        
        header("location:../../?profile");
    }
    else{
        echo "user is not logged in";
        $_SESSION['error']=$response;
        $_SESSION['formdata']=$_POST;
    header("location:../../?profile");}
   
   
}

if(isset($_GET['tagspage'])){
  //  $response = getUserByEmail($_POST);
    //if($response['status'])
    //{
        $_SESSION['loggedin'] = true;
        $_SESSION['userdata'] = $response['user'];
        
        header("location:../../?tagspage");
   
   
}

if(isset($_GET['findYourTagsPage'])){
 
          $_SESSION['loggedin'] = true;
          $_SESSION['userdata'] = $response['user'];
          
          header("location:../../?findYourTagsPage");
     
     
  }

  if(isset($_GET['findYourTags'])){
 
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?findYourTags");


}


if(isset($_GET['uploadpic'])){
   
        $_SESSION['loggedin'] = true;
        $_SESSION['userdata'] = $response['user'];
        
        header("location:../../?uploadpic");
      
}

if(isset($_GET['uploadingpic'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?uploadingpic");
  
}

if(isset($_GET['addcomment'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?addcomment");
  
}

if(isset($_GET['findtag'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?findtag");
  
}

if(isset($_GET['findprofile'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?findprofile");
  
}

if(isset($_GET['ShowAllPics'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?ShowAllPics");
  
}

if(isset($_GET['searchComment'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?searchComment");
  
}

if(isset($_GET['topusers'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?topusers");
  
}

if(isset($_GET['toptags'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?toptags");
  
}

if(isset($_GET['deletealbum'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?deletealbum");
  
}

if(isset($_GET['deletealbumfunctions'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?deletealbum");
  
}

if(isset($_GET['youMayAlsoLike'])){
   
    $_SESSION['loggedin'] = true;
    $_SESSION['userdata'] = $response['user'];
    
    header("location:../../?deletealbum");
  
}


if(isset($_GET['logout'])){
    session_destroy();
    header('location:../../');
}

