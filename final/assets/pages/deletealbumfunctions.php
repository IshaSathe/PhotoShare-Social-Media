<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>
<br><br>
<?php


//connect to database
$con = mysqli_connect('localhost', 'root', '', 'photoshare');
$albumname = $_POST['deletealbum'];

$sql = "SELECT albumId AS albumid FROM albums WHERE name='$albumname'";

$result = $con->query($sql);

$row = $result->fetch_assoc();

$albumiddata = $row["albumid"];

//check if album belongs to user

$sql = "SELECT userId AS userid FROM albums WHERE name='$albumname'";

$result5 = $con->query($sql);

$row5 = $result5->fetch_assoc();

$userdata = $row5["userid"];

$current_user = $_SESSION['userdata']['userID'];


if($userdata == $current_user){

$sql = "DELETE FROM albums WHERE name='$albumname'";
$rs = mysqli_query($con, $sql);

$sql = "SELECT photoId AS photoid FROM photos WHERE albumId='$albumiddata'";

$result1 = $con->query($sql);

$row1 = $result1->fetch_assoc();

$photoiddata = $row1["photoid"];

$sql = "DELETE FROM photos WHERE albumId='$albumiddata'";
$rs = mysqli_query($con, $sql);

$sql = "DELETE FROM likes WHERE photoId='$photoiddata'";
$rs = mysqli_query($con, $sql);

$sql = "DELETE FROM comments WHERE photoId='$photoiddata'";
$rs = mysqli_query($con, $sql);

}