    <?php  
    
        $con = mysqli_connect('localhost', 'root', '', 'photoshare');

        $sql = "SELECT userId FROM users";
        $result = $con->query($sql);

        //loop through users
        while($row = $result->fetch_assoc()) {

            //find users comment count
            $id = $row["userId"];
            $sql2 = "SELECT count(*) AS ccount FROM comments WHERE userId = '$id'";
            $result2 = $con->query($sql2);
            $row2 = $result2->fetch_assoc();
            $commentCount = $row2["ccount"];

            
            //find users albums
            $sql3 = "SELECT albumId FROM albums WHERE userId = '$id'";
            $result3 = $con->query($sql3);

            $photoCount = 0; //counter for photos
            //loop through users albums and find num photos in each
            while($row3 = $result3->fetch_assoc()) {
                $alId = $row3["albumId"];
                $sql4 = "SELECT count(*) AS pcount FROM photos WHERE albumId = '$alId'";
                $result4 = $con->query($sql4);
                $row4 = $result4->fetch_assoc();
                $photoInAlbumCount = $row4["pcount"];
                $photoCount = $photoCount + $photoInAlbumCount;
            } 
            

            $contribtutionCount = $commentCount + $photoCount;
            //echo $contribtutionCount;

            //update user contribution column
            $sql5 = "UPDATE users SET contributions = $contribtutionCount WHERE userId = '$id'";
            $result5 = $con->query($sql5);
        }

        //get top 10 users ordered by contributions
        $sql6 = "SELECT firstName, lastName FROM users ORDER BY contributions DESC LIMIT 10";
        $result6 = $con->query($sql6);
    ?>

    <h1>Top 10 Users:</h1>
    <ol>
        <?php while($row6 = $result6->fetch_assoc()) { ?>
        <li> <?php echo $row6["firstName"], " ", $row6["lastName"] ?> </li>
        <?php } ?>
    </ol>


     <!-- TOP 10 TAGS !-->