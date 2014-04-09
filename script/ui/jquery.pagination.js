/**
 * @fileOverview    基于 jQuery 的分页插件
 * @author  ZwB
 * @version 0.3
 * @function    $.pagination
 * @param   {object}
 *  container   {string|object} jQuery 选择器|jQuery 对象
 *  count       {number}    数据总条数
 *  pageIndex   {number}    当前显示的页面码 默认为 1
 *  pageSize    {number}    每页显示条数 默认为 20
 *  pageShow    {number}    显示页码的数量
 *  paramName   {string}    页码的参数名 默认为 'page'
 *  action      {function|string}
 *  dataType    {string}    数据类型 json
 * @return  {object}(jQuery)    参数 container 所对应的 jQuery 对象
 * @description
 *  页码的 class 为 page 为 a 标签
 *  首页的 class 为 page-first
 *  末页的 class 为 page-last
 *  上一页的 class 为 page-prev
 *  下一页的 class 为 page-next
 *  当前页码 class 为 page-current
 * @example
    var $pagination = $.pagination({
        container: '#pagination',
        count: 100,
        pageIndex: 2,
        action: function(page, size){
        }
    });
 * */
;(function($){
//    var pageConfig = $.pageConfig;
    var methods = {
        setPage: function(e, index, size, count){
            var opts = e.data,
                $container = opts.container,
                pageShow = opts.pageShow,
                pageNum,
                left = Math.ceil( pageShow / 2 - 1 ),
                right,
                html = [],
                i = 0;

            count = count ? count : opts.count;
            size = size ? size : opts.pageSize;
            pageNum = Math.ceil( count / size );

            index = index < 1 ? 1 : index;
            index = index > pageNum ? pageNum : index;

            opts.pageNum = pageNum;
            opts.count = count;
            opts.pageIndex = index;
            opts.pageSize = size;

            left = index>left ? index-left+pageShow>pageNum ? pageNum-pageShow+1<=0 ? 1 : pageNum-pageShow+1 : index-left : 1;
            right = left+pageShow-1>pageNum ? pageNum : left+pageShow-1;

            html.push('<a class="page page-first" href="javascript:;">首页</a><a class="page page-prev" href="javascript:;">上一页</a>');
//            html.push( index===1 ? '<a class="first" href="javascript:;">上一页</a>' : '<a href="'+(index-1)+'" title="上一页" id="prevPage" class="page prevPage"><b>?</b>&nbsp;上一页</a>' );
//            html.push( left===1 ? '' : '<a class="page" href="'+'1" title="第1页">1</a>' );
//            html.push( left>2 ? '<b>...</b>' : '' );

            for(; left<index; left++, i++){
                html.push( '<a class="page" href="javascript:;" title="第', left, '页">', left, '</a>' );
            }

            html.push( '<a class="page page-current" href="javascript:;" title="第', index, '页">', index, '</a>' );
            i++;

            for(left=index+1 ; left<=pageNum && i!==pageShow; i++, left++){
                html.push( '<a class="page" href="javascript:;" title="第', left, '页">', left, '</a>' );
            }

            html.push('<a class="page page-next" href="javascript:;">下一页</a><a class="page page-last" href="javascript:;">尾页</a>');
//            html.push( pageNum-right>=2 ? '<b>...</b>' : '' );
//            html.push( right===pageNum ? '' : '<a class="page" href="'+pageNum+'" title="第'+pageNum+'页">'+pageNum+'</a>' );
//            html.push( index===pageNum ? '<span class="page nextPage">下一页&nbsp;<b>?</b></span>' : '<a href="'+(index+1)+'" title="下一页" id="nextPage" class="page nextPage">下一页&nbsp;<b>?</b></a>' );

            $container.html( html.join('') );
        },
        getPage: function(e){
            var opts = e.data,
                $container = opts.container,
                pageIndex;

            if( /current/.test(this.className) ){
                return;
            }
            else if( /first/.test(this.className) ){
                pageIndex = 1;
            }
            else if( /last/.test(this.className) ){
                pageIndex = opts.pageNum;
            }
            else if( /prev/.test(this.className) ){
                pageIndex = opts.pageIndex-1;
            }
            else if( /next/.test(this.className) ){
                pageIndex = opts.pageIndex+1;
            }
            else{
                pageIndex = this.innerHTML;
            }

            if( pageIndex > opts.pageNum || pageIndex < 1 || pageIndex === opts.pageIndex ) return;

            pageIndex = Number( pageIndex );
            if( opts.action ){
                if( typeof opts.action === 'function' ){
                    opts.action(pageIndex , opts.pageSize );
                }
                else{
                    location.href = opts.action +pageIndex;
                }
            }

            $container.triggerHandler('setPage', [pageIndex]);
        }
    };

    $.pagination = function(options){
        var opts = $.extend({}, $.pagination.defaults, options),
            $container = opts.container;

        $container = (typeof $container === 'object' && $container.jQuery) ? $container : $( $container );

        opts.pageNum = Math.ceil( opts.count / opts.size );
        opts.container = $container;

        $container.on('setPage', opts, methods.setPage).on('click', 'a', opts, methods.getPage);

        $container.triggerHandler('setPage', [1]);

        return $container;
    };

    $.pagination.defaults = {
        container: '',
        action: null,
        count: 0,
        pageSize: 1,
        pageIndex: 1,
        pageNum: 0,
        pageShow: 10,
        error: null

//        ,
//        dataType:'',
//        dataSource:''
    };
})(jQuery);