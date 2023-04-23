//freind the user
$(".friendbtn").click(function () {
   var user_id_data = $(this).data('userId');
   var current = this;
  $(current).attr('disabled', true);


    $.ajax({
       url: 'assets/php/ajax.php?friend',
       method: 'post',
        dataType: 'json',
        data:{ user_id: user_id_data },
        success: function(response){
            if(response.status){
             //   $(current).attr('disabled', true);
                $(current).attr('userId', 0);
                $(current).html('Added as friend')
            } else {
                $(current).attr('disabled', false);
               alert('something is wrong,try again after some time');
            }
        }

    });

});

$(".likebtn").click(function () {
    var user_id_data = $(this).data('userId');
    var photo_id_data = $(this).data('userPhoto');
    var current = this;
    


  //  $(this).text(user_id);
    $.ajax({
        url: 'assets/php/ajax.php?like',
        method: 'post',
        dataType: 'json',
        data: {user_id: user_id_data, photo_id: photo_id_data},
        success: function(response){
            if(response.status){
                $(current).attr('disabled', true);
                $(current).attr('userId', 0);
                $(current).attr('photoId', 0);
                $(current).html('liked')
            }else{
                alert('something is wrong');
            }
        }

    });

});