</main>

    <footer>
        <div class="row">
            <div class="col-lg-4 footer-about-us">
                <p>关于我们</p>
                <p style="font-size: 14px;color: rgb(170, 169, 169);"><?php echo of_get_option('footer-about-us', ''); ?></p>
            </div>
            <div class="col-lg-5 footer-about-us hide-768px" style="padding: 0px 60px;">
                <div class="row">
                    <div class="col-4">
                        <p>热门频道</p>
                        <ul style="list-style: none; padding: 0px; font-size: 14px;">
                            <li><a href="#">文章专题</a></li>
                            <li><a href="#">热门话题</a></li>
                            <li><a href="#">设计大赛</a></li>
                            <li><a href="#">免费教程</a></li>
                            <li><a href="#">设计导航</a></li>
                            <li><a href="#">设计课程</a></li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <p>热门频道</p>
                        <ul style="list-style: none; padding: 0px; font-size: 14px;">
                            <li><a href="#">主编推荐</a></li>
                            <li><a href="#">Banner设计</a></li>
                            <li><a href="#">海报设计</a></li>
                            <li><a href="#">Logo设计</a></li>
                            <li><a href="#">插画绘画</a></li>
                            <li><a href="#">字体设计</a></li>
                        </ul>
                    </div>
                    <div class="col-4">
                            <p>热门频道</p>
                            <ul style="list-style: none; padding: 0px; font-size: 14px;">
                                <li><a href="#">联系我们</a></li>
                                <li><a href="#">广告投放</a></li>
                                <li><a href="#">入驻优创</a></li>
                                <li><a href="#">作者投稿</a></li>
                                <li><a href="#">友链申请</a></li>
                                <li><a href="#">意见反馈</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 mx-auto text-center hide-768px" style="margin: 0px auto;padding-left: 60px; color: #fff;font-size: 12px;">
                
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('weixin_qr_uploader', ''); ?>' width='100%'>">
                            <div class="weixin mx-auto"></div>
                            <p>微信</p>
                        </a>
                    </div>
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('weibo_qr_uploader', ''); ?>' width='100%'>">
                            <div class="weibo mx-auto"></div>
                            <p>微博</p>
                        </a>
                    </div>
                    <div style="margin: 0px auto; float: left; padding: 0px 10px;">
                        <a href="javascript:void(0);" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="<img src='<?php echo of_get_option('toutiao_qr_uploader', ''); ?>' width='100%'>">
                            <div class="toutiao mx-auto"></div>
                            <p>头条</p>
                        </a>
                    </div>
            </div>
            <div class="col-lg-12 hide-768px">
                <p style="color: #fff;" class="friend-link">
                    <span>友情链接：</span>
                    <a href="#">申请优设友链</a><a href="#">hao123上网导航</a><a href="#">设计师网址导航</a>
                    <a href="#">psd素材</a><a href="#">优优教程 </a><a href="#">腾讯CDC</a><a href="#">设计导航</a>
                    <a href="#">优设导航</a><a href="#">图片素材</a><a href="#">UI设计培训</a><a href="#">红动中国设计网 </a>   
                    <a href="#">网页模板</a><a href="#">360安全网址导航</a><a href="#">优设</a><a href="#">在线设计</a>
                    <a href="#">WordPress主题定制 </a><a href="#">Nav80网址导航</a><a href="#">网页设计</a><a href="#">视觉同盟</a>
                    <a href="#">腾讯ISUX</a><a href="#">iconfont</a><a href="#">设计达人 </a><a href="#">腾讯TGideas</a><a href="#">PConline创意设计</a>
                    <a href="#">uiiiuiii</a><a href="#">优优网</a><a href="#">U站</a><a href="#">灵感网站</a>
                    <a href="#">ps下载</a><a href="#">正版图片</a><a href="#">c4d教程</a><a href="#">免费软件教程</a> 
                </p>
            </div>

        </div>
        <div class="text-center">
            <span style="background-color: #000; font-size: 10px; padding: 6px 30px;border-radius:4px;color: rgb(170, 169, 169);">
                Copyright © 2019 <?php bloginfo('name'); ?> &nbsp; 
                <span class="hide-768px"><?php echo of_get_option('icp-bei', ''); ?> &nbsp; <?php echo of_get_option('gongwang-bei', ''); ?></span>
            </span>
        </div>
        
    </footer>
    <div class="back_top hide-768px"></div>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.bundle.min.js 用于弹窗、提示、下拉菜单，包含了 popper.min.js -->
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--<script>
        $(".ds").mouseover(function()  //鼠标悬停执行函数
        {
            $(this).removeClass().addClass("col-2 ui-div ui-hover-bg"); //把class清空。再重新赋一个值给它！
        });
        $(".ds").mouseout(function() //鼠标移除执行函数
        {
            $(this).removeClass().addClass("col-2 ui-div"); //把class清空。再重新赋一个值给它！
        });
    </script>-->
    <script>/* 返回顶部，按钮默认不可见，当滚动页面到一定高度后，按钮出现（低于500px不显示），500毫秒动画 */
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
    </script>
    <script type="text/javascript">/* 更改文章内容字体大小 */
        $(function(){
            $("span").click(function(){
                var thisEle = $(".post-content").css("font-size"); 
                var textFontSize = parseFloat(thisEle , 10);
                var unit = thisEle.slice(-2); //获取单位
                var cName = $(this).attr("class");
                if(cName == "bigger"){
                    if( textFontSize <= 22 ){
                        textFontSize += 1;
                    }
                }else if(cName == "smaller"){
                    if( textFontSize >= 12  ){
                        textFontSize -= 1;
                    }
                }else{
                    textFontSize = $(this).text();
                }
                $(".post-content").css("font-size",  textFontSize + unit);
            });
        });
    </script>
    <script type="text/javascript">/* 工具栏上滑至顶部后固定位置 */
        window.onload=
        function(){
            var oDiv = document.getElementById("fixed-tool"),
            H = 0,
            Y = oDiv
            while (Y) {H += Y.offsetTop; Y = Y.offsetParent}
            window.onscroll = function()
            {
                var s = document.body.scrollTop || document.documentElement.scrollTop
                if(s>H) {
                    oDiv.style = "position:fixed;top:20px;"
                } else {
                    oDiv.style = ""
                }
            }
        }
    </script>
    <script>/* 二维码弹出框 */
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({html : true });   
        });
    </script>

<?php wp_footer(); ?>
</body>
</html>
