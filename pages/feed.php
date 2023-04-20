<?php


$user_email= $_SESSION['userdata']['email'];
$fname = printFirstName($user_email);
$lname = printLastName($user_email);
global $friend_suggestions;

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
                        <h6 style="margin: 0px;font-size: small;"><?=$user['firstName']?> <?=$user['lastName']?></h6>
                    </div>
                    <div>&nbsp;&nbsp;</div>
                    <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-primary followbtn" data-user-id='<?=$suser['id']?>' >Add as friend</button>
    
                    </div>
            </div>
    </div>
        <?php
}
?>