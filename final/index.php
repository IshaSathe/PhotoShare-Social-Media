<?php
require_once 'assets/php/functions.php';

if(isset($_SESSION['loggedin'])){
    $friend_suggestions = filterSuggestions();
    $myFriends = displayFriends();
}


if(isset($_SESSION['loggedin']) && isset($_GET['u'])){
    $profile = getUserByEmail($_GET['u']);
    if(!$profile){
        showPage('header',['page_title'=>'User Not Found']);

    }else{
        showPage('header',['page_title'=>'Photoshare - Profile']);    
        showPage('profile');
    }
}elseif(isset($_SESSION['loggedin']) && isset($_GET['tag'])){
   // $profile = getUserByEmail($_GET['u']);
   // if(!$profile){
     //   showPage('header',['page_title'=>'User Not Found']);

    //}else{
        showPage('header',['page_title'=>'Photoshare - Profile']);    
        showPage('tagspage');
   // }
}elseif(isset($_SESSION['loggedin']) && isset($_GET['yourtag'])){

         showPage('header',['page_title'=>'Photoshare - Profile']);    
         showPage('findYourTagsPage');
    // }
 }elseif(isset($_SESSION['loggedin']) && isset($_GET['uploadpic'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('uploadpic');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['uploadingpic'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('uploadingpic');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['addcomment'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('addcomment');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['findtag'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('findtag');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['findprofile'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('findprofile');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['ShowAllPics'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('ShowAllPics');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['searchComment'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('searchComment');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['topusers'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('topusers');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['toptags'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('toptags');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['findYourTags'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('findYourTags');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['deletealbum'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('deletealbum');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['deletealbumfunctions'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('deletealbumfunctions');
}elseif(isset($_SESSION['loggedin']) && isset($_GET['youMayAlsoLike'])){
    showPage('header',['page_title'=>'Photoshare - LogIn']);
    showPage('youMayAlsoLike');
}elseif(isset($_SESSION['loggedin'])){
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