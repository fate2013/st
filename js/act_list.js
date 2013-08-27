$(document).ready(function(){
    $('.act_item').click(function(){
        var id = $(this).attr("id").substr(9);
        Nav.go('/activity/index/aid/'+id);
    });
});

