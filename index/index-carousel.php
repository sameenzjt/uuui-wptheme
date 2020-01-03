<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- 指示符 -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
        
    </ul>

    <!-- 轮播图片 -->
    <div class="carousel-inner border-radius-4">
        <div class="carousel-item active">
            <img src="<?php echo of_get_option('index_arousel_1_img',''); ?>" width="100%" height="100%">
            <div class="carousel-caption">
                <p><?php echo of_get_option('index_arousel_1_text',''); ?></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?php echo of_get_option('index_arousel_2_img',''); ?>" width="100%" height="100%">
            <div class="carousel-caption">
                <p><?php echo of_get_option('index_arousel_2_text',''); ?></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?php echo of_get_option('index_arousel_3_img',''); ?>" width="100%" height="100%">
            <div class="carousel-caption">
                <p><?php echo of_get_option('index_arousel_3_text',''); ?></p>
            </div>
        </div>
    </div>

    <!-- 左右切换按钮 -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <i class="iconfont icon-zuoyou" style="font-weight: 900;font-size:22px"></i>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <i class="iconfont icon-zuoyou1" style="font-weight: 900;font-size:22px"></i>
    </a>

</div>