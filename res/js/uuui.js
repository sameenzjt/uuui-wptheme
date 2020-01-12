/**  返回顶部，按钮默认不可见，当滚动页面到一定高度后，按钮出现（低于500px不显示），500毫秒动画  */
(function(t) {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500)
            $('.back_top').show();
        else
            $('.back_top').hide();

    });
    $('.back_top').click(function() {
        $('html, body').animate({scrollTop: 0}, 500);
    });
})(jQuery);

/**  bootstrap弹出框  */
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({html : true });   
})(jQuery);