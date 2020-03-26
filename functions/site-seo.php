<?php $description = ''; $keywords = '';
    if (is_home()) {
        $description = of_get_option('website_description', '');// 将引号中的内容改成你的主页description
        $keywords = of_get_option('website-keywords', '');// 将引号中的内容改成你的主页keywords
        $title = get_bloginfo('name');
    }elseif (is_page()){
        $description = of_get_option('website_description', '');// 将引号中的内容改成你的主页description
        $keywords = of_get_option('website-keywords', '');// 将引号中的内容改成你的主页keywords
        $title = get_the_title()."|".get_bloginfo('name');
    }elseif (is_single()) {
        $title = get_the_title()."|".get_bloginfo('name');
        $description1 = get_post_meta($post->ID, "description", true);
        $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));// 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
        $description = $description1 ? $description1 : $description2;// 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
        $keywords = get_post_meta($post->ID, "keywords", true);
        if($keywords == '') {
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag ) {
                $keywords = $keywords . $tag->name . ", ";
            }
            $keywords = rtrim($keywords, ', ');
        }
        }elseif (is_category()) {
            $title = single_cat_title('', false)." | ".get_bloginfo('name');
            $description = category_description();// 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
            $keywords = single_cat_title('', false);
    }elseif (is_tag()){
        $description = tag_description();// 标签的description可以到后台 - 文章 - 标签，修改标签的描述
        $keywords = single_tag_title('', false);
        $title = single_tag_title('', false)." | ".get_bloginfo('name');
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));
    $title = trim(strip_tags($title));
?>
<meta name="title" content="<?php echo $title; ?>">
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />