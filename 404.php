<!DOCTYPE html>
<!-- saved from url=(0043)http://v.bootstrapmb.com/2019/12/udqqi6937/ -->
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo of_get_option('404_title', ''); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/res/css/style_404.css">
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_1581944_l232uhdlrt.css">
</head>
<body>
    <nav>
        <div class="menu">
            <p class="website_name"><?php bloginfo('name'); ?></p>
            <div class="menu_links">
                <a href="#" class="link">about</a>
                <a href="#" class="link">projects</a>
                <a href="#" class="link">contacts</a>
            </div>
            <div class="menu_icon">
                <span class="icon"></span>
            </div>
        </div>
    </nav>

    <section class="wrapper">
        <div class="container">
            <div id="scene" class="scene" data-hover-only="false" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                <div class="circle" data-depth="1.2" style="transform: translate3d(-100.7px, 35.9px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                </div>
                <div class="one" data-depth="0.9" style="transform: translate3d(-75.5px, 26.9px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>
                <div class="two" data-depth="0.60" style="transform: translate3d(-50.4px, 17.9px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>
                <div class="three" data-depth="0.40" style="transform: translate3d(-33.6px, 12px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>
                <p class="p404" data-depth="0.50" style="transform: translate3d(-42px, 14.9px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">404</p>
                <p class="p404" data-depth="0.10" style="transform: translate3d(-8.4px, 3px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">404</p>
            </div>
            <div class="text">
                <article>
                    <p><?php echo of_get_option('404_description', ''); ?></p>
                    <button onclick="javascript:history.back(-1);">返回上一页</button>
                </article>
        </div>
    </div>
</section>

    <!-- partial -->
    <script src="https://cdn.staticfile.org/parallax/3.1.0/parallax.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        var scene=document.getElementById("scene");var parallax=new Parallax(scene);
    </script>
</body>
</html>

<?php
//WordPress 实现自动记录死链地址（防重复）
if(is_404 && strpos($_SERVER['HTTP_USER_AGENT'],'Baiduspider') !== false){
	$file = @file("badlink.txt");//badlink.txt
	$check = true;
	if(is_array($file) && !empty($file))
	foreach($file as &$f){
		if($f == home_url($_SERVER['REQUEST_URI'])."\n")
		$check = false;
	}
	if($check){
		$fp	=	fopen("badlink.txt","a");//badlink.txt 就是在网站根目录的记录死链的文件
		flock	($fp, LOCK_EX) ;
		fwrite	($fp, home_url($_SERVER['REQUEST_URI'])."\n");
		flock	($fp, LOCK_UN);
		fclose	($fp);
	}
}
?>