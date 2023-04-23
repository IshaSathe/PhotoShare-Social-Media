<?php
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database could not be found");

//connect to database
//$con = mysqli_connect('localhost', 'root', '', 'photoshare');

$comment = $_POST['comment'];
$photo_id = $_POST['photoid'];

$current_user_id = $_SESSION['userdata']['userID'];



$rs = addComment($current_user_id,$comment,$photo_id);

echo "comment added!";
?>
<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Feed</a> </h6>
                        

