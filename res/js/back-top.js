$(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500)
            $('.back_top').show();
        else
            $('.back_top').hide();

    });
    $('.back_top').click(function() {
        $('html, body').animate({scrollTop: 0}, 500);
    });
});