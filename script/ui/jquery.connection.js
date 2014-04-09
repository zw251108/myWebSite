/**
 * @fileOverview    Ajax 建立长连接
 * @author  ZwB
 * @version 0.1
 * @function    $.connection
 * @param   {object}
 *  interval    {number}    设置请求完成后与下一次的请求发出的间隔时间 单位为毫秒
 *  其余参数与 $.ajax({}) 相同
 * @return  {object}    可对长连接进行操作的 JSON 对象，可开启、关闭长连接，设置间隔时间，opts 属性为 ajax 参数
 * @description
 * @example
    var conn = $.connection({
        url:'connection.php',
        success:function(data){
            // do something
        }
    });
    conn.closeConn();
    conn.openConn();
 */
;(function($, exports){
    var conn = true, interval = 200,
        defaults = {// 默认参数
            type:'GET',
            timeout:30000,
//            dataType:'json',
            complete:function(xhr){// 注销 XMLHttpRequest 对象，判断是否关闭长连接
                var opts = this;
                if( opts.jquery ){//判断 this 为 jquery 对象
                    opts = opts.data('opts');
                }
                if( 'completeCallback' in opts ){
                    opts.completeCallback.apply(opts, arguments);
                }
                xhr = null;
                if( conn ){
//                    opts.extend = true;
                    exports.setTimeout(function(){
                        $.ajax(opts);
                    }, interval);
                }
            }
        },
        methods = {// 返回的操作函数
            openConn:function(){// 开启长连接
                if( !conn ){
                    conn = true;
                    $.ajax(this.opts);
                }
            },
            closeConn:function(){// 关闭长连接
                conn = false;
            },
            interval:function(time){// 设置间隔时间
                if( time ){
                    interval = time;
                }
            }
        };
    $.connection = function(options){
        if( options.jquery ){// options 是 jquery 对象
            options = options.context.data('opts');
        }
        if( 'interval' in options ){
            interval = options.interval;
        }
        if( 'complete' in options ){
            options.completeCallback = options.complete;
            delete options.complete;
        }

//        var opts = options.extend ? options : $.extend({}, defaults, options);
        var opts = $.extend({}, defaults, options);
        if( opts.context && opts.context.jquery ){// options 不是 jquery 对象 有 context 上下文 且为 jquery 对象
            opts.context.data('opts', opts);// 将数据保存到 context
        }
        $.ajax(opts);

        return $.extend({opts:opts}, methods);
    };
})(jQuery, window);