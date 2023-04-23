<?php 
     
        $con = mysqli_connect('localhost', 'root', '', 'photoshare');
        $sql = "SELECT text, count(*) AS count FROM `tags` GROUP BY text ORDER BY count DESC LIMIT 5";
        $result = $con->query($sql);
        
     ?>

     <h1>Top 5 Tags:</h1>
     <ol>
        <?php while($row = $result->fetch_assoc()) { ?>
        <li> <?php echo $row["text"] ?> </li>
        <?php } ?>
     </ol>