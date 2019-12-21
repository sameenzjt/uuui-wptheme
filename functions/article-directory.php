<?php
function article_index($content) {
   /**
    * 名称：文章目录插件
    * 作者：露兜
    * 博客：https://www.ludou.org/
    * 最后修改：2015年3月20日
    */

   $matches = array();
   $ul_li = '';

   $r = "/<h3>([^<]+)<\/h3>/im";

   if(is_singular() && preg_match_all($r, $content, $matches)) {
      foreach($matches[1] as $num => $title) {
         $title = trim(strip_tags($title));
         $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
         $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
      }

      $content = "\n<div id="article-index">
                     <strong>文章目录</strong>
                     <ul id="index-ul">\n" . $ul_li . "</ul>
                  </div>\n" . $content;
   }

   return $content;
}

add_filter( 'the_content', 'article_index' );

?>