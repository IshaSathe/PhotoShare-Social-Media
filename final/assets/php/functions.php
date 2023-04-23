<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database could not be found");

function showPage($page,$data=""){
    include("assets/pages/$page.php");
}

function catchError($field){
    if(isset($_SESSION['error'])){
        $error =$_SESSION['error'];
        if(isset($error['field']) && $field==$error['field']){
            ?>
            <div class="alert alert-danger" role="alert">
               <?=$error['msg']?>
            </div>
            <?php
        }
    }
}

function addComment($useridcomment,$commenttext,$photoidcomment){

    global $db;
    $query = "INSERT INTO comments(userId,text,photoId) VALUES($useridcomment,'$commenttext',$photoidcomment)";

    return mysqli_query($db,$query);

}

//display friends

function addToLikeTable($userid,$photoid){

    global $db;
    $query = "INSERT INTO likes(userId,photoId) VALUES($userid,$photoid)";

    return mysqli_query($db,$query);

}



function displayFriends(){
    global $db;
    $current_user = $_SESSION['userdata']['userID'];

    $query = "SELECT * FROM users WHERE userID IN (SELECT friendUserId FROM Friends WHERE userId = '$current_user')";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

//function for adding new friends

function friendUser($user_id){
    global $db;
    $current_user_id = $_SESSION['userdata']['userID'];
    $query = "INSERT INTO friends(friendUserId,userId) VALUES($user_id,$current_user_id)";

   return mysqli_query($db,$query);
//  $run = mysqli_query($db,$query);
 // return mysqli_fetch_all($run,true);
}

//for getting friend suggestions

function getFriendSuggestions(){
    global $db;
    $current_user = $_SESSION['userdata']['email'];

    $query = "SELECT * FROM users WHERE email!='$current_user' LIMIT 7";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_all($run,true);
}

function filterSuggestions(){
    $list = getFriendSuggestions();
    $filtered_list = array();
     
    foreach($list as $user){
        if(checkIfFriends($user['userID'])==0){
            $filtered_list[] =$user;
        }
    }

    return $filtered_list;
}

function getAllPosts(){
    global $db;
    $con = mysqli_connect('localhost', 'root', '', 'photoshare');
    $sql = "SELECT data FROM photos";
    $r = mysqli_query($con,$sql);

    $result = [];
    while ($array = mysqli_fetch_array($r)) {
        $result[] = $array['data'];
    }
    echo json_encode($result);
    return $result;
 
}

function getAllPostsOfUserById($id){
    global $db;

    
    $con = mysqli_connect('localhost', 'root', '', 'photoshare');
  /*  $query = "SELECT count(*) as row FROM albums WHERE userId = '$id'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];   */

    $sql = "SELECT albumId FROM albums WHERE userId = '$id'";
    $r = mysqli_query($con,$sql);

    $result = [];
    while ($array = mysqli_fetch_array($r)) {
        $result[] = $array['albumId'];
    }
  //  echo json_encode($result);

//    for($x = 0; $x < sizeof($result); $x++) {
        $sql = "SELECT data FROM photos WHERE albumId = 3";
        $r = mysqli_query($con,$sql);
  //  }

    $result1 = [];
    while ($array = mysqli_fetch_array($r)) {
        $result1[] = $array['data'];
    }
    echo json_encode($result1);
 
}

function checkIfAlbumExists($name){
    global $db;
    
    $query = "SELECT count(*) as row FROM albums WHERE name = '$name'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];   
}

function checkIfFriends($user_id){
    global $db;
    $current_user = $_SESSION['userdata']['userID'];
    $query = "SELECT count(*) as row FROM friends WHERE friendUserId = '$user_id' && userId = '$current_user'";
    $run = mysqli_query($db,$query);
    return mysqli_fetch_assoc($run)['row'];

}

function showData($field){
    if(isset($_SESSION['formdata'])){
        $formdata =$_SESSION['formdata'];
        return $formdata[$field];
    }

}

function checkIfOldUser($email){
    global $db;

    $query="SELECT count(*) as row FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

function printFirstName($email){
    global $db;

    $query="SELECT firstName as fname FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['fname'];
}

function printID(){

    $current_user = $_SESSION['userdata']['userID'];

    return $current_user;
}

function printLastName($email){
    global $db;

    $query="SELECT lastName as lname FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['lname'];
}


//validate sign up form
function checkSignUpForm($form){
    $error_msg = array();
    $error_msg['status'] = true;

    if(!$form['password']){
        $error_msg['msg']="Please enter your password!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'password';
    }

    if(!$form['DOB']){
        $error_msg['msg']="Please enter your DOB!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'DOB';
    }

    if(!$form['email']){
        $error_msg['msg']="Please enter your email!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'email';
    }

    if(!$form['lastName']){
        $error_msg['msg']="Please enter your last name!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'lastName';
    }

    if(!$form['firstName']){
        $error_msg['msg']="Please enter your first name!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'firstName';
    }

    if(checkIfOldUser($form['email'])){
        $error_msg['msg']="An account with this email already exists!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'email';
    }

    return $error_msg;
}

function checkLoginForm($form){
    $error_msg = array();
    $error_msg['status'] = true;
    $blank=false;

    if(!$form['userpassword']){
        $error_msg['msg']="Please enter your password!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'userpassword';
        $blank=true;
    }

    if(!$form['useremail']){
        $error_msg['msg']="Please enter your email!";
        $error_msg['status'] = false;
        $error_msg['field'] = 'useremail';
        $blank=true;
    }

    if(!$blank && !(checkUserLogin($form)['status'])){
        $error_msg['msg'] = "Invalid credentials.";
        $error_msg['status']=false;
        $error_msg['field']='checkUserLogin';

    }else{
        $error_msg['user']=checkUserLogin($form)['user'];
    }

    return $error_msg;
}


function checkUserLogin($form){
    global $db;
    $useremail = $form['useremail'];
    $password = md5($form['userpassword']);

    $query = "SELECT * FROM users WHERE (email='$useremail') && (password='$password')";
    $run = mysqli_query($db,$query);
    $data['user'] =mysqli_fetch_assoc($run)??array();
    
    if(count($data['user'])>0){
        $data['status']=true;

    }else{
        $data['status']=false;
    }
    
    return $data;

}

function getUserByEmail($email){
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $run = mysqli_query($db,$query);
    $data['user'] =mysqli_fetch_assoc($run)??array();
    
    if(count($data['user'])>0){
        $data['status']=true;

    }else{
        $data['status']=false;
    }
    
    return $data;
}


function newUserCreation($data){
    global $db;
    $firstName = mysqli_real_escape_string($db,$data['firstName']);
    $lastName = mysqli_real_escape_string($db,$data['lastName']);
    $gender=$data['gender'];
    $email = mysqli_real_escape_string($db,$data['email']);
    $hometown = mysqli_real_escape_string($db,$data['hometown']);
    $DOB = $data['DOB'];
    $password = mysqli_real_escape_string($db,$data['password']);
    $password=md5($password);

    $query = "INSERT INTO users(firstName,lastName,gender,email,password,hometown,DOB) VALUES ('$firstName','$lastName',$gender,'$email','$password','$hometown','$DOB')";
    return mysqli_query($db,$query);
}

function findComment($comment){
    global $db;

    $query="SELECT userId as id FROM comments WHERE text='$comment'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['id'];

}

function findCommentFNameById($id){
    global $db;

    $query="SELECT firstName as fname FROM users WHERE (userID='$id')";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['fname'];
}

function findCommentLNameById($id){
    global $db;

    $query="SELECT lastName as lname FROM users WHERE (userID='$id')";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['lname'];
}

function findMostCommonTag()
{
    global $db;
    $con = mysqli_connect('localhost', 'root', '', 'photoshare');   
   $sql = "SELECT COUNT(text) AS value FROM tags GROUP BY text ORDER BY value DESC LIMIT 1";
    //return mysqli_query($db,$query);
   // $query = "SELECT TOP 1 FROM tags GROUP BY 'text' ORDER BY 'text'"; 


$result = $con->query($sql);

$row = $result->fetch_assoc();

$hiiii = $row["value"];

$sql = "SELECT text AS value FROM tags HAVING (COUNT(text) = '$hiiii') LIMIT 1";

  
$result1 = $con->query($sql);

$row1 = $result->fetch_assoc();  

return $row1["value"];
}
?>