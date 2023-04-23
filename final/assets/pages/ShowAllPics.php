<?php


$user_email= $_SESSION['userdata']['email'];
$user_id_curr= $_SESSION['userdata']['userID'];
$fname = printFirstName($user_email);
$lname = printLastName($user_email);
global $friend_suggestions;
global $myFriends;
global $user_id;
global $photo_id;


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
<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>
<br><br>
<h3 style= "text-align:center">Your Feed</h3>
    <div style="width:40px; height:40px; margin:auto;font-size:30px;float:left;">


<?php



    $con = mysqli_connect('localhost', 'root', '', 'photoshare');

    $sql = "SELECT data, caption, photoId FROM photos";
    $result = $con->query($sql);

    
    ?>

    <ul class="select-box" id="slcCountry">
        <?php 
        while($row = $result->fetch_assoc()) { ?>
        <li><img src=<?php echo $row["data"] ?> /></li>
        <?php $photo_id_curr = $row["photoId"];  ?>
        <button class="btn btn-sm btn-primary likebtn" data-user-id='<?=$user_id_curr?>' data-user-photo='<?=$photo_id_curr?>'>Like</button>
        

        
    <form action="?addcomment" method="post">
        <h6><label for="comment">comment:</label></h6>
        <h6><input type="text" id="comment" name="comment" /></h6>
        <h6><input type="submit" value="upload" style = "height:30px;width:70px;" /></h6>
            <input type="hidden" name="photoid" value = '<?= $photo_id_curr?>' />
    </form>



    <form action="?searchComment" method="post">
    <h6><label for="searchcomment">Search comment:</label></h6>
        <h6><input type="text" id="searchcomment" name="searchcomment" /></h6>
        <h6><input type="submit" value="search comment" style = "height:30px;width:150px;" /></h6>
          
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


        <?php 
            //calculate likes
            $pId = $row["photoId"];
            $sql2 = "SELECT count(*) as num FROM likes WHERE photoId = '$pId'";
            $result2 = $con->query($sql2);
            $row2 = $result2->fetch_assoc();
        ?>
        <li>   <h6> likes:<?php echo $row2["num"] ?>  </h6>  </li>
        <li><h6>comments:</h6>
            <ul>
                <?php 
                    $sql4 = "SELECT text FROM comments WHERE photoId = '$pId'";
                    $result4 = $con->query($sql4);
                    while($row4 = $result4->fetch_assoc()) {
                ?>
                 <li><h6><?php echo $row4["text"] ?></h6></li>
                 <?php } ?>
            </ul>
        </li>
 





        
        <?php } ?>
    </ul>

    
   
</div>