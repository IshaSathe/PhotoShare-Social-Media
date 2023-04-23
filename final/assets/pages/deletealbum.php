<?php
$user_id = $_SESSION['userdata']['userID'];
?>

    <h1>Delete album</h1>
    <form action="?deletealbumfunctions" method="post">
        <label for="deletealbum">Which album do you want to delete?:</label>
        <input type="text" id="deletealbum" name="deletealbum" />
        <br />
        
        <br />
        <input type="submit" value="upload" />
    </form>