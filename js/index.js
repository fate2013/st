$(document).ready(function(){
    Main.bind_new_act();
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
