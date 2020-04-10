/**  返回顶部，按钮默认不可见，当滚动页面到一定高度后，按钮出现（低于500px不显示），500毫秒动画  */
(function(t) {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500)
            $('.back_top').show();
        else
            $('.back_top').hide();

    });
    $('.back_top').click(function() {
        $('html, body').animate({scrollTop: 0}, 500, 'swing');
    });
})(jQuery);


//搜索框显示与隐藏
$(document).ready(function(){
    var search_form = document.getElementById("search-form");
    var search_form_show = document.getElementById("kl");
    var search_form_hidden = document.getElementById("jk");
    search_form_show.onclick = function () {
        search_form.style.display = "block";
    }
    search_form_hidden.onclick = function () {
        search_form.style.display = "none";
    } 
});


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


//评论表单的按钮样式
$(function(){
    //表单样式
    $("#commentform").addClass('');
    //按钮样式
    $("#commentform #submit").addClass('btn btn-block');
    //评论必填项*样式
    $(".required").addClass('text-danger');
    //评论输入项p样式
    $(".comment-form-author, .comment-form-email, .comment-form-url").addClass('form-group float-left col-lg-6 col-md-6 col-sm-12');
    //评论输入项input样式
    $(".comment-form-author input, .comment-form-email input, .comment-form-url input").addClass('form-control');
    //评论复选框p样式
    $(".comment-form-cookies-consent").addClass('custom-control custom-checkbox float-left col-12');
    //评论复选框input样式
    $("#wp-comment-cookies-consent").addClass('custom-control-input');
    //评论复选框input样式
    $(".comment-form-cookies-consent label").addClass('custom-control-label');
});


