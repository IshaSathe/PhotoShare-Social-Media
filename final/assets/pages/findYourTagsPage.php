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

<?php
$currentTag = $_GET['yourtag'];


?>

<br>

<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>
<br><br>

<h2> View all images associated with Tag " <?php echo $currentTag;?> "</h2>

<div style="width:40px; height:40px; margin:auto;font-size:30px;float:left;">
<?php


    $current_user = $_SESSION['userdata']['userID'];
    $con = mysqli_connect('localhost', 'root', '', 'photoshare');

    $sql = "SELECT photoId FROM tags WHERE text = '$currentTag'";
    $result = $con->query($sql);

    
    ?>

    <ul class="select-box" id="slcCountry">
        <?php while($row = $result->fetch_assoc()) { ?>
        


        <?php 
            $idphoto = $row["photoId"];
            $sql = "SELECT data,caption,albumId FROM photos WHERE photoId = '$idphoto'";
            $r1 = $con->query($sql);
            while($rowphotos = $r1->fetch_assoc()) 
            { //echo "hi";
                $iduser = $rowphotos["albumId"];
                $sql1 = "SELECT userId FROM albums WHERE albumId = '$iduser'";
                $r2 = $con->query($sql1);
                while($selecttags = $r2->fetch_assoc()) 
                { //echo $selecttags["userId"];
                    if($selecttags["userId"] == $current_user){
                ?>
                <li><img src=<?php echo $rowphotos["data"] ?> /></li>
                <li><?php echo $rowphotos["caption"] ?></li>

                <?php
                }
            }
            }
            ?>
 
        </li>
        <?php } ?>
    </ul>
 
   
</div>
