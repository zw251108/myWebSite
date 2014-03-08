/**
 *  内容切换
 */
(function($){
    /**
     *  私有方法
     * */
    var methods = {

    };
    $.tab = function(options){
        if( !options.title || !options.content ) return null;
        var opts = $.extend({}, options, $.tab.defaults),
            $container = $(opts.container),
            $title = $(opts.title),
            $content = $(opts.content);

        if( $title.length ){// 有没有标题

        }

        if( $content.length ){// 有没有内容

        }


        var rs = {};
        return rs
    };

    $.tab.defaults = {
        container:'',   // 容器的 selector
        title:'',       // 标题的 selector
        content:'',     // 内容的 selector
        animate:'',     // 是否有动画效果 slide, fade
        animateTime:'', // 动画时间
        pause:'',       // 停顿时间
        hoverPause:'',  // 鼠标悬停停止动画
        autoTab:'',     // 是否自动切换
        preload:null,   // 预加载
//        preloadImg:'',  // 预加载时显示效果

        prevButton:'',  // 是否显示上一个按钮
        nextButton:'',  // 是否显示下一个按钮
        beforeTab:null, // 切换前触发事件
        afterTab:null   // 切换后触发事件
    };
})(jQuery);