<h6 style="margin: 0px;font-size: small;"><a href='?feed' class="text-decoration-none"> Go Back to Main Page</a> </h6>


<?php
$comment = $_POST['searchcomment'];?>
<h1> <?php echo $comment ?> </h1>

<br>
<?php
   $con = mysqli_connect('localhost', 'root', '', 'photoshare');

    $sql1="SELECT userId as id FROM comments WHERE text='$comment'";
                
    $r2 = $con->query($sql1);
    while($result = $r2->fetch_assoc()) {
        $id = $result["id"];
        $sql2="SELECT firstName as fname FROM users WHERE (userID='$id')";
        $r3 = $con->query($sql2);
        $result2 = $r3->fetch_assoc();
        echo "Comment made by: ";
        echo $result2["fname"];
        echo " ";

        $sql3="SELECT lastName as lname FROM users WHERE (userID='$id')";
        $r4 = $con->query($sql3);
        $result3 = $r4->fetch_assoc();
      
        echo $result3["lname"]; ?> <br><br><?php
       
    }

?>




                