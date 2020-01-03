//引入对应方法, 需要注意的是这里引用了4个方法, 那么在底部也需要window.wp.回调这4个方法
//这4个方法的来源是functions.php里的wp_register_script时array()里传入, 需要注意一一对应
(function (blocks, element, editor, i18n) {
    var el = element.createElement; //用于输出HTML
    var RichText = editor.RichText; //用于获取文本输入块

    blocks.registerBlockType('gutenberg-examples/example-03-editable', {
        title: '测试模块', //标题
        icon: 'universal-access-alt', //图标
        category: 'layout', //对应栏目
        attributes: { //模块的属性
            content: {
                type: 'array',
                source: 'children',
                selector: 'p',
            },
        },
        //编辑时
        edit: function (props) {
            //获取模块输入的值
            var content = props.attributes.content;
            //点击输入框时用的方法
            function onChangeContent(newContent) {
                //将输入框里的内容输出到模块属性里
                props.setAttributes({ content: newContent });
            }
            //返回HTML
            //el的方法格式为: el( 对象, 属性, 值 ); 可以相互嵌套
            //例如:
            // el(
            //     'div',
            //     {
            //         className: 'demo-class',
            //     },
            //     'DEMO数据'
            // );
            // 输出为: <div class="demo-class">DEMO数据</div>
            return el(
                RichText,
                {
                    tagName: 'p',
                    className: props.className,
                    onChange: onChangeContent,
                    value: content,
                }
            );
        },
        //保存时
        save: function (props) {
            //保存时返回的HTML
            return el(RichText.Content, {
                tagName: 'p', value: props.attributes.content,
            });
        },
    });
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.editor,
    window.wp.i18n
));