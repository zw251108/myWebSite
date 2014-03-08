// JavaScript Document
/**
 *  流式布局
 */
(function($){
    var methods = {
    };

    $.layout = function(options){
        var opts = $.extend({}, $.layout.defaults, options),
            $selector = opts.selector,
            $container = opts.container,
            rowSpace = opts.rowSpace,
            colSpace = opts.colSpace,
//            func = 'css',
            left = opts.left,
            top = opts.top,
            width,
            bottom = top,
            area =[],
            targetArea,
            temp,
            $temp, tempHeight, tempWidth,
            i, j, m, n,
            sort = function(a, b){
                var rs = a.top - b.top;

                if( rs === 0 ){
                    rs = a.left - b.left;
                }
                return rs;
            };

        $container = (typeof $container === 'object' && $container.jQuery)? $container : $( $container );
        $selector = (typeof $selector === 'object' && $selector.jQuery)? $selector : $( $selector );

        width = $container.css('position', 'relative').width() - left - opts.right;

//        if( opts.animate ){
//            func = 'animate';
//
//            $selector.css('position', 'absolute');
//        }

        $temp = $selector.eq(0);
        tempHeight = $temp.outerHeight() + rowSpace;
        tempWidth = $temp.outerWidth() + colSpace;

        if( tempWidth < width ){
            $temp.css({
                position: 'absolute',
                left: left +'px',
                top: top +'px'
            });

            area.push({
                left: left + tempWidth,
                top: top,
                width: width - tempWidth,
                height: 0,
                ext:true
            }, {
                left: left,
                top: top + tempHeight,
                width: tempWidth,
                height: 0,
                ext:true
            });

            bottom += tempHeight;

            for(i = 1, j = $selector.length; i < j; i++){

                $temp = $selector.eq(i);

//                if( $temp.css('display') === 'none' ){
//                    continue;
//                }

                tempHeight = $temp.outerHeight() + rowSpace;
                tempWidth = $temp.outerWidth() + colSpace;

                targetArea = null;
                for(m = 0, n = area.length; m < n; m++){

                    temp = area[m];
                    if( temp.width >= tempWidth ){

                        targetArea = temp;
                        break;
                    }
                }

                if( targetArea ){
                    $temp.css({
                        position: 'absolute',
                        left: targetArea.left +'px',
                        top: targetArea.top +'px'
                    });

                    if( targetArea.width > tempWidth ){
                        area.push({
                            left: targetArea.left + tempWidth,
                            top: targetArea.top,
                            height: tempHeight,
                            width: targetArea.width - tempWidth,
                            ext: targetArea.ext
                        });
                    }

                    targetArea.top += tempHeight;
                    targetArea.width = tempWidth;

                    if( bottom < targetArea.top ){
                        bottom = targetArea.top
                    }
                }
                else{
                    $temp.css({
                        position: 'absolute',
                        left: left +'px',
                        top: bottom +'px'
                    });
                    bottom += tempHeight;

                    for(m = 0, n = area.length; m < n; m++){
                        temp = area[m];

                        if( temp.left < left + tempWidth ){

                        }
                    }
                }


                area.sort(sort);
            }
        }
        else{// 第一块 宽度超出 容器 宽度

            // todo
        }

//        if( tempWidth < width ){
//            $temp.css({
//                position: 'absolute',
//                left: left +'px',
//                top: top +'px'
//            });
//
//            area.push({
//                left: left + tempWidth,
//                top: top,
//                width: width - tempWidth,
//                height: tempHeight,
//                ext:true
//            });
//            bottom += tempHeight;
//
//            for(i = 1, j = $selector.length; i < j; i++){
//
//                $temp = $selector.eq(i).css('position', 'absolute');
//                tempHeight = $temp.outerHeight();
//                tempWidth = $temp.outerWidth();
//
//                targetArea = null;
//                for(m = 0, n = area.length; m < n; m++){
//                    temp = area[m];
//
//                    if( temp.width >= tempWidth && (!targetArea || temp.width < targetArea.width ) &&
//                        temp.height >= tempHeight && (!targetArea || temp.height < targetArea.height ) ){
//
//                        targetArea = temp;
//                    }
//                }
//
//                if( targetArea ){
//                    $temp.css({
//                        position: 'absolute',
//                        left: targetArea.left +'px',
//                        top: targetArea.top +'px'
//                    });
//
//                    if( targetArea.height > tempHeight && targetArea.width > tempWidth ){// 目标区域 完全大于 当前块
//                        area.push({
//                            left: targetArea.left + tempWidth,
//                            top: targetArea.top,
//                            height: tempHeight,
//                            width: targetArea.width - tempWidth,
//                            ext: targetArea.ext
//                        });
//                        targetArea.top += tempHeight;
//                        targetArea.height -= tempHeight;
//                    }
//                    else if( targetArea.height > tempHeight && targetArea.width === tempWidth ){// 目标区域 仅高于 当前块
//                        targetArea.top += tempHeight;
//                        targetArea.height -= tempHeight;
//                    }
//                    else if( targetArea.height === tempHeight && targetArea.width > tempWidth ){// 目标区域 仅宽于 当前块
//                        targetArea.left += tempWidth;
//                        targetArea.width -= tempWidth;
//                    }
//                    else{// 目标区域 完全等于 当前块
//                        targetArea.width = 0;
//                        targetArea.height = 0;
//                    }
//                }
//                else{// 封闭之前区域，使其高度不可变
////                    for(m = 0, n = area.length; m < n; m++){
////                        area[m].ext = false;
////                    }
//                    $temp.css({
//                        position: 'absolute',
//                        left: left +'px',
//                        top: bottom +'px'
//                    });
//
//                    area.push({
//                        left: left + tempWidth,
//                        top: bottom,
//                        width: width - tempWidth,
//                        height: tempHeight,
//                        ext:true
//                    });
//                    bottom += tempHeight;
//                }
//
//                area.sort(sort);
//            }
//        }
//        else{// 第一块 宽度超出 容器 宽度
//
//            // todo
//        }

        $container.height( bottom + opts.bottom );
    };

    $.layout.arr = [];

    $.layout.defaults = {
        container: 'body',
        selector: '',
        animate: false,
        left: 0,
        right: 0,
        bottom: 0,
        top: 0,
        colSpace: 0,
        rowSpace: 0,
        placehold: ''
    };
})(jQuery);