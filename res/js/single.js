window.onload=function(){

    function single_nav_toggle(){
        $(window).scroll(function() {
            if ($(window).scrollTop() > 500){
                $('.site-title, .nav-link, .nav-login').hide();
                $('.single-title').show();
            }else{
                $('.single-title').hide();
                $('.site-title, .nav-link, .nav-login').show();
            }
        })
    }


    
    single_nav_toggle();
}