$(document).ready(function(){
    Main.bind_new_act();
    $('.portrait_name span').click(function(){
        $(this).hide();
        $(this).next('input').show();
        $(this).next('input').focus();
        $(this).next('input').val($(this).text());
        $(this).next('input').select();
    });
    $('.portrait_name input').blur(function(){
        var name = $(this).val();
        var input = $(this);
        $.get('/user/updatename', {name:name}, function(){
            input.hide();
            input.prev('span').text(name);
            input.prev('span').show();
        }, 'json');
    });
    $('.portrait_name input').keyup(function(event){
        if(event.keyCode == 13){
            $(this).blur();
        }
    });
});

Main = {
    bind_new_act: function(){
        $('.new_act').click(function(){
            Nav.go('/activity/create');
        });
    }
};

Nav = {
    go: function(url){
        window.location = url;
    }
};
