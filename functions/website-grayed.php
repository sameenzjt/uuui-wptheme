<?php
//网站整体变灰
function hui_head_css() {
    $styles = "";
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}";
    if ($styles) {
        echo "<style>" . $styles . "</style>";
    }
}
add_action("wp_head", "hui_head_css");?>