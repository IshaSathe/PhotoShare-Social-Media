<?php
$user_id = $_SESSION['userdata']['userID'];
?>

    <h1>Upload Pic</h1>
    <form action="?uploadingpic" method="post">
        <label for="album">album:</label>
        <input type="text" id="album" name="album" />
        <br />
        <label for="pic_url">pic url:</label>
        <input type="text" id="pic_url" name="pic_url" />
        <br />
        <label for="caption">caption:</label>
        <input type="text" id="caption" name="caption" />
        <br />
        <label for="tags">tags (space sperated):</label>
        <input type="text" id="tags" name="tags" />
        <br />
        <input type="submit" value="upload" />
    </form>
