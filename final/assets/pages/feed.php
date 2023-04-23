<?php


$user_email= $_SESSION['userdata']['email'];
$user_id_curr= $_SESSION['userdata']['userID'];
$fname = printFirstName($user_email);
$lname = printLastName($user_email);
global $friend_suggestions;
global $myFriends;
global $user_id;
global $photo_id;
global $user_id_1;
$findcomment = findComment('cute!');

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
    
            h3 {
                
                font-family: brush script mt, cursive;
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

<h3> Welcome, <?php echo $fname; echo " "; echo $lname; echo "!"?></h3>
<br>
<br>


<form action="?findtag" method="post">
        <h6><label for="findtag">Find tag:</label></h6>
        <h6><input type="text" id="findtag" name="findtag" /></h6>
        <h6><input type="submit" value="find tag" style = "height:30px;width:70px;" /></h6>
            
    </form>

    <form action="?findprofile" method="post">
        <h6><label for="findprofile">Find user with email:</label></h6>
        <h6><input type="text" id="findprofile" name="findprofile" /></h6>
        <h6><input type="submit" value="find profile" style = "height:30px;width:100px;" /></h6>
            
    </form>

    <form action="?findYourTags" method="post">
        <h6><label for="findyourtag">Find Your tag:</label></h6>
        <h6><input type="text" id="findyourtag" name="findyourtag" /></h6>
        <h6><input type="submit" value="find tag" style = "height:30px;width:70px;" /></h6>
            
    </form>

    


<br><br>


    <h6 style="float: left;">Add new friends here!</h6>
<br>
<br>

<?php
foreach($friend_suggestions as $user){
    ?>
    
    <div class="d-flex justify-content-between" style="background-color:#d9a7ed;width:300px">
            <div class="d-flex align-items-center p-2">
                <div>&nbsp;&nbsp;</div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 style="margin: 0px;font-size: small;"><a href='?u=<?=$user['email']?>' class="text-decoration-none"><?=$user['firstName']?> <?=$user['lastName']?></a></h6>
                    </div>
                    <div>&nbsp;&nbsp;</div>
                    <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-primary friendbtn" data-user-id='<?=$user['userID']?>' >Add as friend</button>
    
                    </div>
            </div>
    </div>
    <?php
        
}?>

<br>
<br>
<br>
<h6 style="float: left;">Your friends:</h6>
<br>
<br>
<?php
foreach($myFriends as $user){
    ?>
    <div class="d-flex justify-content-between" style="background-color:#d9a7ed;width:300px">
            <div class="d-flex align-items-center p-2">
                <div>&nbsp;&nbsp;</div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 style="margin: 0px;font-size: small;"><a href='?u=<?=$user['email']?>' class="text-decoration-none"><?=$user['firstName']?> <?=$user['lastName']?></a> </h6>
                        <br>
                        <h6 style="margin: 0px;font-size: small; background-color:white"><?=$user['email']?> </h6>
                    </div>
                    <div>&nbsp;&nbsp;</div>
                   
            </div>
    </div>
        <?php
}
?>





<br><br>

    <button onclick="window.location.href='?ShowAllPics';" value="upload a pic">Show Feed</button>
    <br><br>
    <button onclick="window.location.href='?uploadpic';" value="upload a pic">upload a pic</button>
    <br><br>
    <button onclick="window.location.href='?topusers';" value="Show top users">show top users</button>
    <br><br>
    <button onclick="window.location.href='?toptags';" value="Show top tags">show top tags</button>
    <br><br>
    <button onclick="window.location.href='?deletealbum';" value="Delete Album">Delete album</button>
    <br><br>
    <button onclick="window.location.href='?youMayAlsoLike';" value="suggested posts">See suggested posts</button>
    

<?php
/*

    
<h3 style= "text-align:center">Your Feed</h3>
    <div style="width:40px; height:40px; margin:auto;font-size:30px;float:left;">
    $con = mysqli_connect('localhost', 'root', '', 'photoshare');

    $sql = "SELECT data, caption, photoId FROM photos";
    $result = $con->query($sql);

    
    ?>

    <ul class="select-box" id="slcCountry">
        <?php while($row = $result->fetch_assoc()) { ?>
        <li><img src=<?php echo $row["data"] ?> /></li>
        <?php $photo_id_curr = $row["photoId"];  ?>
        <button class="btn btn-sm btn-primary likebtn" data-user-id='<?=$user_id_curr?>' data-user-photo='<?=$photo_id_curr?>'>Like</button>
        

        
    <form action="?addcomment" method="post">
        <h6><label for="comment">comment:</label></h6>
        <h6><input type="text" id="comment" name="comment" /></h6>
        <h6><input type="submit" value="upload" style = "height:30px;width:70px;" /></h6>
            <input type="hidden" name="photoid" value = '<?= $photo_id_curr?>' />
    </form>

        <li><h6>caption: <?php echo $row["caption"] ?> </h6></li>
        <li><h6> tags: </h6>


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
 
        </li>
        <?php } */
    
 
   





