/**
 * @fileOverview    HTML 模板引擎
 * @author  ZwB
 * @version 0.2
 * @function
 * @param   {object}
 *  template    {string}    模板字符串   符合 emmet 编写规则 其中 %key% 为动态插入数据
 *  filter      {object}    数据过滤操作 key 对应数据处理函数
 * @return  {function}      构造模板 HTML 代码函数
 * @description
 * @example
    var html = $.template({
        template: 'span{%sex%}',
        filter:{
            sex: function(data, i){
                return data[key] === 1?'男':'女';
            }
        }
    });
    html([{sex:1}]); // <span>男</span>
 */
;(function(p, jqPath){
	if( typeof exports === 'object' && typeof module === 'object' ){
		p( require( jqPath || 'jquery' ) );
	}
	else if( typeof define === 'function' && define.amd ){
		define([ jqPath || 'jquery' ], p);
	}
	else{
		p();
	}
})(function($){
	$ = $ || jQuery;

    var elemExpr = /(\w*)((?:#[\w%]*)?)((?:\.[\w\-%]*)*)((?:\[[\w\-%]*=.*?\])*)((?:\{.*?\})?)/
	    , keyListExpr = /%\w*?%/g
	    , keyExpr = /%(.*)%/
	    ;

    var methods = {
        specialTag: {    // 特别标签
            input: ''
	        , img: ''
	        , br: ''
	        , hr: ''
        }
	    , attrDefault: {    // 属性默认值
		    disabled: 'disabled'
		    , checked: 'checked'

	    }
	    , createElement: function(rs, front, end){   // 构建元素
            var html = []
	            , temp
	            , tag = rs[1] // || 'div'
	            ;

		    // 添加标签
            tag && html.push('<', tag);

		    // 添加 id 属性
            temp = rs[2];
		    html.push(temp?' id="'+ /#(.*)/.exec(temp)[1] +'"':'');

		    // 添加 class 属性
            temp = rs[3];
            html.push(temp?' class="'+ temp.split('.').slice(1).join(' ')+'"':'');

		    // 添加属性
            temp = rs[4];
            if( temp ){
                temp = temp.replace(/\[/g, ' ');
                temp = temp.replace(/=(.*?)\]/g, '="$1"');
                html.push(temp);
            }

		    // 判断标签是否闭合
            if( tag in this.specialTag ){
                html.push('/>');
                temp = /\{(.*)\}/.exec( rs[5] );
                html.push(temp?temp[1]:'');
                temp = html.join('');
                front.push( temp );

                end.unshift('');
            }
            else{
                html.push('>');
                temp = /\{(.*)\}/.exec( rs[5] );
                html.push(temp?temp[1]:'');
                temp = html.join('');
                front.push( temp );

                end.unshift('</'+ tag +'>');
            }
        }
	    , operator: function(template, front, end){  // 处理操作符
            var tempArr = template.split('')
	            , operate = tempArr.shift()
	            , temp
	            ;

            switch( operate ){
            case '>':
                template = tempArr.join('');
                break;
            case '+':
                temp = end.shift();
                front.push( temp );
                template = tempArr.join('');
                break;
            case '^':
                temp = end.shift();
                front.push( temp );
                operate = tempArr.shift();
                if( operate !== '^' ){
                    temp = end.shift();
                    front.push( temp );
                }
                tempArr.unshift( operate );
                template = tempArr.join('');
                break;
            default:
                break;
            }

            return template;
        }
	    , handleData: function(template, data, filter, keyList, index){  // 处理数据
            var i = 0
	            , j = keyList ? keyList.length : 0
	            , tempData
	            , temp
	            , key
	            ;

            for(; i<j; i++ ){
                temp = keyList[i];
                key = keyExpr.exec(temp)[1];
                tempData =  key in data ? data[key] : '';

                if( filter && (key in filter) ){
                    tempData = filter[key](data, index);
                }
                template = template.replace(temp, tempData);
            }
            return template;
        }
    };

    $.template = function(options){
        var opts = $.extend({}, $.template.defaults, options)
	        , template = opts.template
	        , filter = opts.filter
	        , front = []
	        , end = []
	        , rs
	        , keyList;

        while( template ){
            rs = elemExpr.exec( template );

            if( rs.join('') !== '' ){
                methods.createElement(rs, front, end);
                template = template.replace(rs[0], '');
            }
            template = methods.operator(template, front, end);
        }
        front = front.concat( end );
        template = front.join('');

        keyList = template.match( keyListExpr );

        return function(data, start, end){
	        data = $.isArray( data ) ? data : [].push( data );

            var i = end
	            , j = data.length
	            , temp = []
	            ;

            j = (i > 0 && i < j)? i : j;
            i = start > 0 ? start : 0;
            for(; i<j; i++ ){
	            temp.push( methods.handleData(template, data[i], filter, keyList, i) );
            }

            return temp;
        };
    };
    $.template.defaults = {
        template: ''
	    , filter: {}
    };
}, '');