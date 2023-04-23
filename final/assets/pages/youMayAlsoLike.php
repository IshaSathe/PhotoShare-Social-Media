<style>
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

<?php

      $con = mysqli_connect('localhost', 'root', '', 'photoshare');
      
      $id = 1001; //TEMP USER ID

      $id = $_SESSION['userdata']['userID'];
      
      $sql = "SELECT * FROM photos INNER JOIN tags ON photos.photoId = tags.photoId INNER JOIN albums ON photos.albumId = albums.albumId WHERE tags.text IN ( SELECT text FROM photos INNER JOIN tags ON photos.photoId = tags.photoId INNER JOIN albums ON photos.albumId = albums.albumId WHERE albums.userId = $id ) AND albums.userId != $id";

      $result = $con->query($sql);

    ?>

    <h1>You might also like:</h1>
    <ul>
        <?php while($row = $result->fetch_assoc()) { ?>
        <li> <img src = <?php echo $row["data"] ?> /> </li>
        <li>caption:</li>
        <li> <?php echo $row["caption"] ?> </li>
        <?php } ?>
    </ul>