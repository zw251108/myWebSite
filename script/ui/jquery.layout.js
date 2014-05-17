// JavaScript Document
/**
 * @fileOverview    流式布局
 * @author  ZwB
 * @version 0.1
 * @function    $.layout
 * @param   {object}
 *  container   {string|object} 目标容器 jQuery 选择器|jQuery 对象
 *  items       {string|object} 目标元素 jQuery 选择器|jQuery 对象
 *  top         {number}    容器内的上边距
 *  bottom      {number}    容器内的下边距
 *  left        {number}    容器内的左边距
 *  right       {number}    容器内的右边距
 *  colSpace    {number}    元素之间的列间距
 *  rowSpace    {number}    元素之间的行间距
 * @return  {object}(jQuery)    参数 container 所对应的 jQuery 对象
 * @description
 * @example

 */
;(function($){
    var methods = {
	    sort: function(a, b){
		    var rs = a.top - b.top;

		    if( rs === 0 ){
			    rs = a.left - b.left;
		    }

		    return rs;
	    }
	    , resizeNodeL: function(left, tempArea){
		    var temp;


		    while( tempArea.parent !== null ){

			    temp = tempArea.parent;

			    if( temp.width + temp.left > left ){
				    temp.width = left;
			    }
		    }
	    }
	    , resizeNodeR: function(){}
	    , resizePoint: function(point, m, p1, tempHeight, tempWidth){console.log('resize', m)
			var	i = m
				, j = point.length
				, temp1
				, temp2
				, left = 0
				;
		    for(; i < j;){console.log('resize', 'loop', i, j);

			    temp1 = point[i++];
			    temp2 = point[i++];

			    if( temp1.left < p1.left && temp2.left > p1.left && temp1.top < p1.top + tempHeight ){

				    console.log('loop 1', temp1.top, temp1.left, temp2.top, temp2.left);

				    left = temp1.left;
				    temp2.left = p1.left;
			    }
			    else if( temp1.left === p1.left && temp2.left > p1.left && temp1.top < p1.top + tempHeight ){
				    console.log('loop 2', temp1.top, temp1.left, temp2.top, temp2.left);

				    left = temp1.left;
				    temp1.left = p1.left + tempWidth;
			    }
		    }

		    return left;
	    }
	    , log: function(obj){
		    var i = 0
			    , j = obj.length
			    ;

		    for(; i < j; i++){
			    console.log(obj[i].top, obj[i].left);
		    }
	    }
	    , layout: function( options ){
		    var opts = $.extend({}, $.layout.defaults, options)
			    , $container = opts.container
			    , $selector = opts.selector

			    , rowSpace = opts.rowSpace
			    , colSpace = opts.colSpace
			    , left = opts.left
			    , top = opts.top
			    , width
			    , height = 0

			    , $temp
			    , tempHeight
			    , tempWidth

			    , point = []
			    , p1
			    , p2
			    , pointWidth
			    , pointLeft

			    , area = [] // 封闭区域
			    , tempArea

			    , i
			    , j
			    , m
			    , n
			    ;

		    $container = (typeof $container === 'object' && $container.jQuery)? $container : $( $container );
		    $selector = (typeof $selector === 'object' && $selector.jQuery)? $selector : $( $selector );

		    // 可用区域
		    width = $container.css('position', 'relative').width() - left - opts.right;

		    // 添加容器顶部 2 个点
		    point.push({
			    top: top
			    , left: left
		    }, {
			    top: top
			    , left: left + width
		    });

		    for(i = 0, j = $selector.length; i < j; i++){console.log(i);
			    $temp = $selector.eq(i);
				tempHeight = $temp.outerHeight() + rowSpace;
			    tempWidth = $temp.outerWidth() + colSpace;

			    n = area.length;
			    if( n ){
				    // 先检查 封闭区域
//				    for(m = 0; m < n; m++){
//					    tempArea = area[m];
//					    if( tempArea.width >= tempWidth && tempArea.height >= tempHeight ){
//
//					    }
//				    }
			    }

			    m = 0;
			    n = point.length;
			    point.sort( this.sort );    // 排序点

			    this.log( point );

			    while( true ){
				    if( m < n-1 ){

					    p1 = point[m++];
					    p2 = point[m++];

					    console.log(m, n, p1.top, p1.left, p2.top, p2.left);

					    pointWidth = p2.left - p1.left;
					    if( pointWidth >= tempWidth ){
						    $temp.css({
							    position: 'absolute'
							    , top: p1.top
							    , left: p1.left
						    });

						    // 重置
						    pointLeft = this.resizePoint(point, m, p1, tempHeight, tempWidth);

						    if( pointWidth === tempWidth ){
							    p2.top += tempHeight;
						    }
						    else{
							    point.push({
								    top: p1.top
								    , left: p1.left + tempWidth
							    });

							    console.log('push 1', p1.top, p1.left + tempWidth);
						    }

						    if( height < p1.top + tempHeight ){

							    height = p1.top + tempHeight;

							    p1.left = left;

							    if( pointWidth !== tempWidth ){
								    point.push({
									    top: height
									    , left: width
								    });
								    console.log('push 2', height, width)
							    }
						    }
						    else{
							    p1.left = pointLeft || p1.left;

						        point.push({
								    top: p1.top + tempHeight
								    , left: p2.left
							    });
							    console.log('push 3', p1.top+tempHeight, p2.left);
						    }
						    p1.top += tempHeight;

						    break;
					    }
				    }
				    else{
					    // 添加
					    break;
				    }
			    }
		    }

		    $container.height( height + opts.bottom );
	    }
    };

//	$.layout = function( options ){
//		methods.layout( options );
//	};

    $.layout = function(options){

	    var opts = $.extend({}, $.layout.defaults, options)
	        , $container = opts.container
	        , $selector = opts.selector
	        , rowSpace = opts.rowSpace
	        , colSpace = opts.colSpace
//	        , func = 'css'
			, left = opts.left
		    , top = opts.top
		    , width
		    , bottom = top
		    , area = []
		    , targetArea
		    , temp
		    , $temp
		    , tempHeight
		    , tempWidth
		    , i, j, m, n
		    , sort = function(a, b){
                var rs = a.top - b.top;

                if( rs === 0 ){
                    rs = a.left - b.left;
                }
                return rs;
            }
		    ;

        $container = (typeof $container === 'object' && $container.jQuery)? $container : $( $container );
        $selector = (typeof $selector === 'object' && $selector.jQuery)? $selector : $( $selector );

        // 可用区域
	    width = $container.css('position', 'relative').width() - left - opts.right;

	    /**
	     * todo
	     * 添加计算 placeholder
	     * */

	    // 设置第一个元素
        $temp = $selector.eq(0);
        tempHeight = $temp.outerHeight() + rowSpace;
        tempWidth = $temp.outerWidth() + colSpace;

        if( tempWidth <= width ){
            $temp.css({
                position: 'absolute',
                left: left +'px',
                top: top +'px'
            });

            area.push({
	            top: top
	            , left: left + tempWidth
	            , width: width - tempWidth
	            , height: 0
	            , ext: true  // ?
            }, {
                left: left
	            , top: top + tempHeight
	            , width: tempWidth
	            , height: 0
	            , ext: true
            });

            bottom += tempHeight;

            for(i = 1, j = $selector.length; i < j; i++){

                $temp = $selector.eq(i);

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

        $container.height( bottom + opts.bottom );
    };

	$.layout.layout = function(options){
		methods.layout( options );
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

$(function(){
	var left = 0, right = 0, top = 0, bottom = 0
		, colSpace = 10
		, rowSpace = 10
		, $container = $('#container').css('position', 'relative')
		, $items = $container.find('div.case')
		, width = $container.width() - left - right
		, height = 0
		;
	var lines = [{
			x: left
			, y: top
			, w: width
		}],
		sortFunc = function(a, b){
			return a.y - b.y;
		}
		, inArray = function(target, array){
			return $.inArray(target, array);
		}
		;

	var i = 0, j = $items.length
		, $item
		, loopLines = function(ls, $item){
			var i = 0, j = ls.length
				, sortLines = ls.slice().sort(sortFunc)
				, line
				, index
				, lExtend
				, lWidth
				, rExtend
				, rWidth
				, lIndex
				, rIndex
				, m, n
				, t
				, tempWidth = $item.outerWidth() + rowSpace
				, tempHeight = $item.outerHeight() + colSpace
				, rs
				;
			for(; i < j; i++){
				line = sortLines[i];

				if( line.h && line.h < tempHeight ){    // 已为封闭区域 并且高度小于 $item 高度
					continue;
				}
				index = inArray(line, ls);

				for(lIndex = index - 1, lExtend = null; lIndex > -1; lIndex--){    // 向左扩展
					t = ls[lIndex];

					if( t.y > line.y ){
						break;
					}
					else{
						if( t.h && (t.y + t.h <= line.y || t.y + t.h - line.y < tempHeight) ){
						}
						else{
							lExtend = t;
						}
					}
				}

				lWidth = lExtend ? line.x - lExtend.x : 0;

				if( line.w + lWidth >= tempWidth ){ // line 线的宽度大于 $item 宽度

					$item.css({
						position: 'absolute'
						, left: (lExtend ? lExtend.x : line.x) + 'px'
						, top: line.y + 'px'
					});

					if( height < line.y + tempHeight ){ // 收集容器高度
						height = line.y + tempHeight;
					}

					if( lExtend ){  // 左边可扩展

						for(m = lIndex +1, n = index; m < n; m++){  // 封闭左边区域

							t = lines[m];
							if( !t.h || (t.y + t.h > line.y) ){ // 非闭合区域
								t.h = line.y - t.y;
							}
						}
					}

					if( line.w + lWidth === tempWidth ){
						line.y += tempHeight;

						if( line.h ){
							line.h -= tempHeight;
						}

						if( lExtend ){
							line.x = lExtend.x;
							line.w += line.x - lExtend.x;
						}
					}
					else{
						if( lExtend ){
							ls.splice(index, 1, {
								x: lExtend.x
								, y: line.y + tempHeight
								, w: tempWidth
								, h: line.h ? line.h - tempHeight : null
							}, {
								x: lExtend.x + tempWidth
								, y: line.y
								, w: line.w - tempWidth + (lExtend ? line.x - lExtend.x : 0)
								, h: line.h || null
							});
						}
						else{
							ls.splice(index, 1, {
								x: line.x
								, y: line.y + tempHeight
								, w: tempWidth
							}, {
								x: line.x + tempWidth
								, y: line.y
								, w: line.w - tempWidth
							});
						}
					}
					rs = true;
				}
				else{
					for(rIndex = index +1, rExtend = null; rIndex < j; rIndex++){ // 向右扩展
						t = ls[rIndex];

						if( t.y <= line.y ){
							if( !t.h ){

								rWidth = t.x + t.w - line.x - line.w;
								if( lWidth + line.w + rWidth >= tempWidth ){
									rExtend = t;
									break;
								}
							}
						}
						else{
							break;
						}
					}

					if( rExtend ){  // 右边可扩展

						$item.css({
							position: 'absolute'
							, left: (lExtend ? lExtend.x : line.x) + 'px'
							, top: line.y + 'px'
						});

						if( height < line.y + tempHeight ){
							height = line.y + tempHeight;
						}

						for(m = index +1, n = rIndex-1; m < n && m < j; m++){ // 封闭右边区域

							t = lines[m];
							if( !t.h ){ // 非闭合区域
								t.h = line.y - t.y;
							}
						}

						if( line.w + lWidth + rWidth === tempWidth ){

							line.y += tempHeight;
						}
						else{
							ls.splice(index, 1, {
								x: lExtend ? lExtend.x : line.x
								, y: line.y + tempHeight
								, w: tempWidth
							});

							ls.splice(rIndex, 1, {
								x: rExtend.x
								, y: rExtend.y
								, w: (lExtend ? lExtend.x : line.x) + tempWidth - rExtend.x
								, h: line.y - rExtend.y
							}, {
								x: (lExtend ? lExtend.x : line.x) + tempWidth
								, y: rExtend.y
								, w:  rExtend.x + rExtend.w - (lExtend ? lExtend.x : line.x) - tempWidth
							});
						}

						if( lExtend ){
							line.w += line.x - lExtend.x;

							for(m = lIndex +1, n = index; m < n; m++){  // 封闭左边区域

								t = lines[m];
								if( !t.h ){ // 非闭合区域
									t.h = line.y - t.y;
								}
							}
						}

						rs = true;
					}
				}

				if( rs ) break;
			}
			return rs;
		}
		, rs
		;
	for(; i < j; i++){
		$item = $items.eq(i);
		rs = loopLines(lines, $item);
	}
	$container.height( height + bottom );
});