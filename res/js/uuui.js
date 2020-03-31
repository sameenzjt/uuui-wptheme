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
});


//网站footer微信二维码 css控制二维码隐藏和出现
$("#weixin-show-qr").qrcode({
    text: _wechat_url, //设置二维码内容
    //render: "table", //设置渲染方式 
    width: 128, //设置宽度,默认生成的二维码大小是 256×256
    height: 128, //设置高度 
    typeNumber: -1, //计算模式 
    background: "#ffffff", //背景颜色 
    foreground: "#000000" //前景颜色 
});
$('.show_weixin').click(function(){
    $('.wechat-show-qr').toggle();
    $('.weixin-show-qr').toggle();
    $('.show_weixin_popup_foot').toggle();
});




window.onload=function(){//网页DOM加载完成时执行

    var oDiv = document.getElementById("fixed-tool"),
    H = -80,
    Y = oDiv
    while (Y) {H += Y.offsetTop; Y = Y.offsetParent}
    window.onscroll = function(){
        var s = document.body.scrollTop || document.documentElement.scrollTop
        if(s>H) {
            oDiv.style = "position:fixed;top:80px;"
        } else {
            oDiv.style = ""
        }
    }
    //首页第一个栏目第二行显示/隐藏
    function index_lanmu_soft(){
        $(document).ready(function(){
            $(".look_more_soft").click(function(){
                $(".hide,.show").toggle(500);
            });
        });
    }

    index_lanmu_soft();
};