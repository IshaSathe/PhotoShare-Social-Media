<?php
require_once 'config.php';
require_once 'functions.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database could not be found");


if(isset($_GET['friend'])){
 $user_id = $_POST['user_id'];
  if(friendUser($user_id)){
        $response['status']=true;
    }else{
    $response['status']=false;
     
  }
    
    echo json_encode($response);
}

if(isset($_GET['like'])){
$user_id = $_POST['user_id'];
$photo_id = $_POST['photo_id'];
   if(addToLikeTable($user_id,$photo_id)){
   
        $response['status']=true;
    }else{
            $response['status']=false;
         
        }
   
  echo json_encode($response);
}
?>