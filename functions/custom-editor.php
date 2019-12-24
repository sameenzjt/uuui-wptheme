<?php
//编辑器添加按钮
function appthemes_add_quicktags() {
    ?>
    <script type="text/javascript">
        QTags.addButton( '键盘输入元素', '键盘输入元素', '\n<kbd>', '</kbd>\n' ); 
        QTags.addButton( '引用', '引用', '\n<blockquote class="blockquote">', '</blockquote>\n' );
        QTags.addButton( '引用来源', '引用来源', '\n<footer class="blockquote-footer">', '</footer>\n' );
        QTags.addButton( '首字母大写', '首字母大写', '\n<span class="text-capitalize">', '</span>\n' );
        QTags.addButton( '高亮', '高亮', '<mark>', '</mark>' ); 
    </script>
    <?php
    }
    add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );
    ?>