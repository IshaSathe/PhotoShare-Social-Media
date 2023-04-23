<?php



//require_once 'functions.php';

global $friend_suggestions;
global $myFriends;
global $navuser;
$navuser = getUserByEmail($_GET['u']);
$fname = $navuser['user']['firstName'];
$lname = $navuser['user']['lastName'];
$email = $navuser['user']['email'];
$hometown = $navuser['user']['hometown'];
$userid = $navuser['user']['userID'];


?>

<style type="text/css">

    #nav_bar{

        height: 50px;
        background-color: #d9a7ed;
        color: white;
    }

    #searchbox{
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 4px;
        font-size: 14px;
        float: right;
        margin-top: 10px; 
    }
    ul li {
            list-style: none;
        }

            ul li img {
                left: 10px;
                margin-top: 10px;
                width: 500px;
                height: 500px;
            }

    </style>

<div id="nav_bar">
    <div style="width: 800px;margin:auto;font-size:30px;">
   

           
           <img src="assets/images/icon.jfif" alt="" height="45" style="float: right;">

           
    
           <input type="text" id="searchbox" placeholder="Search for people" style="float: center;">
           <img src="assets/images/photoshare.png" alt="" height="45" style="float: left;">
     
</div>
</div>

<a href="assets/php/actions.php?logout">
    <span style="font-size:15px;float: right;margin:10px;color:black;background:white;">Logout</span>
    
</a>
<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>

<h3> <?php echo $fname; echo " "?><?php echo $lname;?></h3>
<br>
<h5><?php echo"email: "; echo $email;?></h5>
<br>
<h5><?php echo "hometown: "; echo $hometown;?></h5>

<br>
<br>

<div style="width:40px; height:40px; margin:auto;font-size:30px;float:left;">


<?php
$con = mysqli_connect('localhost', 'root', '', 'photoshare');
$userid = $navuser['user']['userID'];

$sql = "SELECT albumId FROM albums WHERE userId = '$userid'";
$r = mysqli_query($con,$sql);

$result = [];
while ($array = mysqli_fetch_array($r)) {
    $result[] = $array['albumId'];
}


if($result != null){
for($x = 0; $x < sizeof($result); $x++) {
    $sql = "SELECT data, caption, photoId FROM photos WHERE albumId=$result[$x]";
    $r = $con->query($sql);



    ?>

    <ul class="select-box" id="slcCountry">
        <?php while($row = $r->fetch_assoc()) { ?>
        <li><img src=<?php echo $row["data"] ?> /></li>
        <h6><li><?php echo $row["caption"] ?></li></h6>
        <h6><li>tags:</li></h6>

        <?php
            $idphoto = $row["photoId"];
            $sql = "SELECT text FROM tags WHERE photoId = '$idphoto'";
            $r1 = $con->query($sql);
            while($rowtags = $r1->fetch_assoc()) 
            {
                echo " "; 
                ?>

                <h6> <a href='?tag=<?=$rowtags["text"] ?>' class="text-decoration-none"><?php echo $rowtags["text"] ?></a> </h6>
                <?php
            }
            ?>
        <?php } ?>
    </ul>

    <?php } ?>
    <?php } ?>
</div>



