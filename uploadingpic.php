<?php

//connect to database
$con = mysqli_connect('localhost', 'root', '', 'photoshare');

$pic_url = $_POST['pic_url'];
$caption = $_POST['caption'];
$tags = $_POST['tags'];
$tagslist = explode(" ", $tags);

$sql = "INSERT INTO `photos` (`caption`, `albumId`, `data`) VALUES ('$caption', 1, '$pic_url')";
$rs = mysqli_query($con, $sql);

$sql = "SELECT photoId AS id FROM photos WHERE data = '$pic_url'";
echo $sql;
$result = $con->query($sql);
print_r($result);
$row = $result->fetch_assoc();
echo $row["id"];
$id = $row["id"];
//$rs = mysqli_query($con, $sql);

for($x = 0; $x < sizeof($tagslist); $x++) {
	$sql = "INSERT INTO `tags` (`photoId`,`text`) VALUES ('$id', '$tagslist[$x]')";
	$rs = mysqli_query($con, $sql);
}

if($rs) {
	echo "added";
}

?>