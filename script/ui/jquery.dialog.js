/**
 * @fileOverview
 * @author  ZwB
 * @version
 * @function
 * @param   {object}
 *  content   {string|object} jQuery 选择器或 jQuery 对象或 DOM 对象
 *  title       {string}        弹窗标题
 *  beforeShow  {function}      显示弹窗前的操作 this 为 content 对应的 jQuery 对象
 *  afterClose  {function}      关闭弹窗后的操作 this 为 content 对应的 jQuery 对象
 * @return  {object}(jQuery)    参数 target 所对应的 jQuery 对象
 * @description
 * @example
 */
(function($, exports, doc){
//    var methods = {
//        $bg:'',
//        $dialog:'',
//        createDialog:function(){// 创建弹窗主体
//            var $dialog;
//            if( this.$dialog ){
//                $dialog = this.$dialog;
//            }
//            else{
//                $dialog = $('<div class="dialog"></div>');
//
//                // 弹窗标题
//                $dialog.title = $('<h2 class="dialog_title"></h2>"').appendTo( $dialog );
//
//                // 弹窗内容
//                $dialog.content = $('<div class="dialog_content"></div>').appendTo( $dialog );
//
//                // 弹窗关闭按钮
//                $dialog.closeBtn = $('<span class="dialog_closeBtn"></span>').appendTo( $dialog );
//
//                $dialog.buttons = $('<div class="dialog_buttons"></div>').appendTo( $dialog );
//
//                this.$dialog = $dialog.appendTo('body');
//            }
//            return $dialog;
//        },
//        createBg:function(opacity){// 创建模态背景
//            var $bg, docElement;
//
//            if(this.$bg){
//                $bg = this.$bg;
//            }
//            else{
//                docElement = doc.documentElement;
//
//                $bg = $('<div class="overlay"></div>').prependTo('body');
//                this.winResize({data:{bg:$bg}});
//
//                this.$bg = $bg;
//
//                $(exports).on('resize', {bg:this.$bg}, this.winResize);
//            }
//            return $bg;
//        },
//        winResize:function(e){// 窗口重设大小
//            var $bg = e.data.bg;
//            if(!$bg.timeout){
//                $bg.timeout = setTimeout(function(){
//                    var docElement = doc.documentElement;
//
//                    $bg.css({
//                        width:docElement.clientWidth + 'px',
//                        height:docElement.clientHeight + 'px'
//                    });
//                }, 400);
//            }
//        }
//    };
//    var events = {
//        addButton:function(e, buttons){
//
//        },
//        title:function(e, title){
//
//        }
//    };
//    var dialog = {
//        statue:'close',  // 弹窗状态
//
//        show:function(){// 弹窗显示方法
//            this.title();
//            this.content();
//            this.button();
//            this.$bg.show();
//            this.$dialog.show();
//            this.statue = 'show';
//        },
//        close:function(){// 弹窗关闭方法
//            this.$bg.hide();
//            this.$dialog.hide();
//            this.statue = 'close';
//        },
//        title:function(text){// 填充标题
//            this.$title.empty().append( text || this._opts.title );
//        },
//        content:function(text){
//            this.$content.empty().append(  );
//        },
//        button:function(key){
//            var rs = null;
//            if( key ){
//                rs =  this.buttons[key];
//            }
//            else{
//                var btns = this._opts.buttons,
//                    $buttons = this.$dialog.buttons,
//                    temp,
//                    $temp,
//                    cache = [],
////                    $cache = $([]),
//                    buttons = {},
//                    i = 0,
//                    j = btns.length;
//
//                for(; i < j; i++){
//                    temp = btns[i];
//                    $temp = $('<input/>', temp);
//                    !temp.type && $temp.attr('type', 'button');
//                    cache.push($temp);
////                    buttons[btns[i].id || btns[i].value] = $temp;
////                    $cache = $cache.add( $temp );
//                }
//
//                $buttons.empty().append( cache );
//
//                this.buttons = cache;
//            }
//            return rs;
//        }
//    };
//    $.dialog = function(options){
//        var opts = $.extend({}, $.dialog.defaults, options),
//            temp = $.extend({}, dialog),
//            $temp,
//            $target = opts.target;
//
//        $target = (typeof $target === 'object' && $target.jQuery ) ? $target : $( $target );
//
//        temp._opts = opts;
//
//        // 创建拟态背景
//        temp.$bg = methods.createBg(opts.opacity);
//
//        // 创建弹窗主体
//        $temp = methods.createDialog();
//        opts.fixed && $temp.css('position', 'fixed');
//
//        // 弹窗题目
//        temp.$title = $temp.title;
//        // 弹窗内容
//        temp.$content = $temp.content;
//        // 弹窗主体
//        temp.$dialog = $temp;
//
//        // 弹窗关闭按钮
//        temp.$closeBtn = $temp.closeBtn.on('click', {dialog:temp}, function(e){
//            e.data.dialog.close();
//        });
//
//        $target.on(opts.eventType, {dialog:temp}, function(e){
//            e.data.dialog.show();
//        });
//
//        $target.dialog = temp;
//    };
//    $.dialog.defaults = {
//        content:'',
//
//        target:'',
//
//        title:'',
//
//        type:'',
//
//        show:null,
//        close:null,
//
//        buttons:[],
//
//        lock:true,
//        fixed:true
//    };

    var methods = {
        $overlay:null,
        $dialog:null,
        $title:null,
        $closeBtn:null,
        $buttons:null,
        init:function( opts ){
            var dialog = function(order, param){
                return this.triggerHandler(order, [param]);
            };

            dialog.show = false;

            dialog.$overlay = this.createOverlay();
            dialog.$dialog = this.createDialog();

            dialog.$title = this.title();
            dialog.$closeBtn = this.closeBtn();
            dialog.$buttons = this.buttons();

            dialog.opts = opts;

            return dialog;
        },
        createOverlay:function(){// 创建拟态层
            var $rs = this.$overlay;

            if( !$rs ){
                $rs = $('<div class="overlay"></div>')
                    .css('opacity', '0.7').prependTo('body');
                this.$overlay = $rs;

                this.winResize();
                $(exports).on('resize', {bg:$rs}, this.winResize);
            }

            return $rs;
        },
        winResize:function(e){// 窗口重设大小
            var $overlay = e ? e.data.bg : this.$overlay;

            if(!$overlay.timeout){

                $overlay.timeout = setTimeout(function(){
                    var docElement = doc.documentElement;

                    $overlay.css({
                        width:'auto',
                        height:'auto'
                    }).width(docElement.clientWidth).height(docElement.clientHeight);

                    $overlay.timeout = null;
                }, 400);
            }
        },
        createDialog:function(){
            var $rs = this.$dialog;

            if( !$rs ){
                $rs = $('<div class="dialog"></div>').appendTo('body');
                this.$dialog = $rs;
            }

            return $rs;
        },
        title:function(){// 设置 title
            var $rs = this.$title;
            if( !$rs ){
                $rs = $('<div class="dialog_title"></div>').appendTo( this.$dialog );
                this.$title = $rs;
            }
            return $rs;
        },
        closeBtn:function(){// 设置关闭按钮
            var $rs = this.$closeBtn;
            if( !$rs ){
                $rs = $('<div class="dialog_closeBtn"></div>').appendTo( this.$dialog );
            }
            return $rs;
        },
        buttons:function(){
            var $rs = this.$buttons;
            if( !$rs ){
                $rs = $('<div class="dialog_buttons"></div>').appendTo( this.$dialog );
                this.$buttons = $rs;
            }
            return $rs;
        },
        addButtons:function(buttons){
            var $buttons = this.$buttons,
                i = 0,
                j = buttons.length,
                $temp,
                temp,
                rs = {};

            for(; i<j; i++){
                temp = buttons[i];
                $temp = $('<input/>', temp).addClass('dialog_button');
                !temp.type && $temp.attr('type', 'button');
                $temp.appendTo( $buttons );
                temp.id && (rs[temp.id] = $temp);
            }

            return rs;
        }
    };

    var events = {
        show:function(e){
            var $content = e.data,
                dialog = $content.dialog,
                opts = dialog.opts,
                width = $content.width(),
                height = $content.height(),
                $temp, temp,
                titleWidth = 0,
                titleHeight = 0,
                buttonsWidth = 0,
                buttonsHeight = 0;

            dialog.$overlay.show();

            // todo 定位
            $content.css({
                marginTop: -height/2 +'px',
                marginLeft: -width/2 +'px'
            }).show();

            temp = opts.title;
            if( temp.show ){// 显示标题
                $temp = dialog.$title.html( temp.text ).show();
                temp.extClass && $temp.addClass( temp.extClass );

                titleWidth = $temp.width();
                titleHeight = $temp.height();
            }

            temp = opts.buttons;
            if( temp.length ){
                dialog.buttons  = methods.addButtons( temp );

                $temp = dialog.$buttons.show();

                buttonsWidth = $temp.width();
                buttonsHeight = $temp.height();
            }

            temp = opts.closeBtn;
            if( temp.show ){
                $temp = dialog.$closeBtn.show();
                temp.extClass && $temp.addClass( temp.extClass );
            }

            dialog.$dialog.css({
                width: Math.max(width, titleWidth, buttonsWidth) +'px',
                height: (height + titleHeight + buttonsHeight) +'px',
                marginLeft: -Math.max(width, titleWidth, buttonsWidth)/2 +'px',
                marginTop: (-height/2 - titleHeight) +'px'
            }).show();
        },
        close:function(e){
            var $content = e.data,
                dialog = $content.dialog,
                opts = dialog.opts,
                temp,
                $temp;

            $content.hide();

            dialog.$overlay.hide();
            dialog.$dialog.hide();
            dialog.$buttons.hide();

            $temp = dialog.$title.hide();
            temp = opts.title.extClass;
            if( temp ){
                $temp.removeClass( temp );
            }

            $temp = dialog.$closeBtn.hide();
            temp = opts.closeBtn.extClass;
            if( temp ){
                $temp.removeClass( temp );
            }
        },
        title:function(e, text){
            e.data.$title.empty().append(text);
        },
        buttons:function(e, key){
            return e.data.dialog.buttons[key] || null;
        },
        addButton:function(e, button, prepend){
            var func = prepend ? 'prependTo' : 'appendTo',
                $temp = e.data.dialog,
                $buttons = $temp.$buttons,
                buttons = $temp.buttons;

            $temp = $('<input/>', button)[func]( $buttons );
            if( button.id ){
                buttons[button.id] = $temp;
            }
        }
    };

    // 构造函数
    $.dialog = function(options){
        var opts = $.extend(true, {}, $.dialog.defaults, options),
            dialog = methods.init( opts ),
            $content = opts.content;

        if( !$content.jQuery ){
            $content = $( $content );

            if( !$content.length ){
                $content = $content.add('<div class="dialog_content">'+ opts.content +'</div>');
            }
        }

        if( !$content.parent().length ){
            $content.hide().appendTo( dialog.$dialog );
        }

        $content.dialog = dialog;

        opts.closeBtn.show && dialog.$closeBtn.on('click', $content, function(){

        });

        return $content.css({
            position: 'absolute',
            top:'50%',
            left:'50%',
            zIndex: 100
        }).on(events, $content);
    };

    // 默认参数
    $.dialog.defaults = {
        content:'',
        title:{
            show:false,
            text:'',
            extClass:''
        },
        closeBtn:{
            show:true,
            extClass:''
        },
        buttons:[],
        beforeShow:function(){},
        afterClose:function(){}
    };
})(jQuery, window, document);