
<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>
<br><br>
<?php


//connect to database
$con = mysqli_connect('localhost', 'root', '', 'photoshare');

$pic_url = $_POST['pic_url'];
$caption = $_POST['caption'];
$tags = $_POST['tags'];
$album = $_POST['album'];
$tagslist = explode(" ", $tags);
$current_user_id = $_SESSION['userdata']['userID'];
$test = checkIfAlbumExists($album);
//echo $test; echo "TEST!";
if(checkIfAlbumExists($album)==0){
	$sql = "INSERT INTO `albums` (`userId`, `name`) VALUES ('$current_user_id', '$album')";
    $rs = mysqli_query($con, $sql);
}

$sql = "SELECT albumId AS albumid FROM albums WHERE name = '$album'";
$result = $con->query($sql);

$row = $result->fetch_assoc();
//echo $row["id"];
$albumiddata = $row["albumid"];

$sql = "INSERT INTO `photos` (`caption`, `albumId`, `data`) VALUES ('$caption', '$albumiddata', '$pic_url')";
$rs = mysqli_query($con, $sql);

$sql = "SELECT photoId AS id FROM photos WHERE data = '$pic_url'";
//echo $sql;
$result = $con->query($sql);
//print_r($result);
$row = $result->fetch_assoc();
//echo $row["id"];
$id = $row["id"];
//$rs = mysqli_query($con, $sql);


for($x = 0; $x < sizeof($tagslist); $x++) {
	$sql = "INSERT INTO `tags` (`photoId`,`text`) VALUES ('$id', '$tagslist[$x]')";
	$rs = mysqli_query($con, $sql);
}

if($rs) {
	echo "added!";
}

?>