<?php
require_once 'assets/php/functions.php';

if(isset($_SESSION['loggedin'])){
    $friend_suggestions = getFriendSuggestions();
}

if(isset($_SESSION['loggedin'])){
    showPage('header',['page_title'=>'Photoshare - Your Feed']);
    showPage('feed');
}
elseif(isset($_GET['signup'])){//page can be accessed by http://localhost/photoshare/?signup
showPage('header',['page_title'=>'Photoshare - SignUp']);
showPage('signup');
} elseif(isset($_GET['login'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('login');
} elseif(isset($_GET['logout'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('login');
}
else{
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('login');
}

showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);