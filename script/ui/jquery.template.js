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
        template:'span{%sex%}',
        filter:{
            sex:function(data, i){
                return data[key] === 1?'男':'女';
            }
        }
    });
    html([{sex:1}]); // <span>男</span>
 */
(function($){
    var elemExpr = /(\w*)((?:#[\w%]*)?)((?:\.[\w\-%]*)*)((?:\[[\w\-%]*=.*?\])*)((?:\{.*?\})?)/,
        keyListExpr = /%\w*?%/g,
        keyExpr = /%(.*)%/;

    var methods = {
        specialTag:{
            input:'',
            img:'',
            br:'',
            hr:''
        },
        createElement:function(rs, front, end){
            var html = ['<'],
                temp,
                tag = rs[1] || 'div';

            html.push(tag);

            temp = rs[2];
            html.push(temp?' id="'+ /#(.*)/.exec(temp)[1] +'"':'');

            temp = rs[3];
            html.push(temp?' class="'+ temp.split('.').slice(1).join(' ')+'"':'');

            temp = rs[4];
            if( temp ){
                temp = temp.replace(/\[/g, ' ');
                temp = temp.replace(/=(.*?)\]/g, '="$1"');
                html.push(temp);
            }

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
        },
        operator:function(template, front, end){
            var tempArr = template.split(''),
                operate = tempArr.shift(), temp;
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
        },
        handleData:function(template, data, filter, keyList, index){// 处理数据
            var i = 0, j = keyList ? keyList.length : 0,
                tempData, temp, key;

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
        var opts = $.extend({}, $.template.defaults, options),
            template = opts.template,
            filter = opts.filter,
            front = [], end = [],
            rs, keyList;

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
            var i = end,
                j = data.length;

            front = [];
            j = (i > 0 && i < j)? i : j;
            i = start > 0 ? start : 0;
            for(; i<j; i++ ){
                front.push( methods.handleData(template, data[i], filter, keyList, i) );
            }

            return front;
        };
    };
    $.template.defaults = {
        template:'',
        filter:null
    };
})(jQuery);