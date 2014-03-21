/**
 * @fileOverview    基于 jQuery 的 timeLine 插件
 * @author  ZwB
 * @version 0.1
 * @function    $.timeLine
 * @param   {object}
 *  container   {string|object}    输出时间轴的目标容器 jQuery 选择器|jQuery 对象
 *  showLine    {boolean}   是否显示中轴线
 *  dateFormat  {function}  对 data 数组中的 date 进行格式处理的函数
 *                  默认处理 yyyy-mm-dd hh:ii:ss 格式字符串或 13位数字的时间戳
 *                  可以自定义
 *                  传入参数: 数据中的 json 属性
 *                  返回 Date 对象
 *  changePlace {function}  时间点事件模板函数
 *                  可用传入的参数来自定义动画效果
 *                  调用方式为 call，this 为该时间点的 jQuery 对象
 *                  传出参数: json 数据，json数据中 date 属性对应的 Date 对象，
 *                      this 应设置的 top 值，
 *                      this 与中轴线的偏移量，
 *                      this 所属的方位 为 left 或 right
 *                  返回 该时间点事件内容的高度
 *  coordinateTmpl  {function}  坐标模板函数
 *  order       {boolean}   排序参数 true为正序(过去时间在前) false为倒序  目前该功能尚未实现
 *  startDate   {object}(Date)  显示截取时间段的开始时间 参数类型 Date 对象
 *  endDate     {object}(Date)  显示截取时间段的结束时间 参数类型 Date 对象
 *  coordinate  {boolean}   是否显示时间坐标
 *  interval    {string|number} 设置间隔区间 参数类型：字符串，year/month/week/day/hour(同时前面可以加数字，如：2month,为以2个月为间隔)；数字，分隔的周期(为毫秒数)
 *  sort        {function}  基于数据的排序规则，若数据为无序，则需定义，来执行排序
 *  colWidth    {number}    左右时间点事件之间的距离，即为与中轴线的偏移量的 2倍
 *  lineHeight  {number}    时间点事件上下的间距
 *  left        {number}    左边时间点事件的基础高度
 *  right       {number}    右边时间点事件的基础高度
 *  marginBottom    {number}    底部的外边距
 *  data        {object}(Array) 时间点事件的数据 为 json 数组，json数据中必须有 date 属性为排序基础 默认为 yyyy-mm-dd hh:ii:ss 格式字符串或 13位数字的时间戳
 * @return  {object}(jQuery)    参数 container 所对应的 jQuery 对象
 * @description
 * @example
    var $timeLine = $.timeLine({
        container:'#container',
        interval:'month',
        data:[
            {date:'2013-01-12 12:11:12', title:'2013-01-12 12:11:12', content:'2012-11-12 12:11:12'},
            {date:'2012-11-12 12:11:13', title:'2012-11-12 12:11:13', content:'2012-11-12 12:11:13'}
        ]
    });
 */
(function($){
    var fillZero = function(num){return $.number.fillZero(num, 2);};

    /**
     *  公有方法
     * */
    var methods = {
        init:function(opts){
            var $container = opts.container;
            $container = (typeof $container === 'object' && $container.jQuery)? $container : $( $container );
            var temp = opts.data,
                target = $('<div>'+(opts.showLine?'<div class="timeLine_line"></div>':'')+'</div>').css({
                    'position':'absolute',
                    'left':'50%'
                }).appendTo($container);
            opts.data = [];

            $container.data({
                opts:opts,
                target:target,
                area:{
                    indexArray:[]
                },
                datetime:{
                    indexArray:[]
                }
            });

            $container.addEvent = this.addEvent;
            $container.refresh = this.refresh;
            $container.order = this.order;
            $container.interval = this.interval;
            $container.setStartEnd = this.setStartEnd;
            $container.clearData = this.clearData;

            $container.addEvent(temp);

            return $container;
        },
        addEvent:function(data){
            if( !$.isArray( data ) && data.date ){
                data = [data];
            }
            var opts = this.data('opts');
            opts.data = data = data.concat(opts.data);

            if( opts.start || opts.end ){
                this.setStartEnd(opts.start, opts.end);
            }

            if( opts.coordinate && opts.interval ){
                this.interval(opts.interval);
            }

            methods.placement(this, data);
        },
        refresh:function(){
            methods.placement(this, this.data('opts').data);
        },
        order:function(){// 正序 倒序 未实现

        },
        interval:function(i){// 设置间隔 未实现

        },
        setStartEnd:function(start, end){// 设置显示区间

        },
        clearData:function(){
            this.data('opts').data = [];
            var datetime = this.data('datetime'),
                area = this.data('area'),
                temp, i;

            if( area.indexArray.length ){

            }
            temp = datetime.indexArray;
            i = temp.length;
            while( i-- ){
                datetime[temp[i]].remove();
                delete datetime[temp[i]];
            }
            datetime.indexArray = [];
        },
        placement:function($container, data){// 定位数据
            var i = 0,
                j = data.length,
                target = $container.data('target'),
                opts = $container.data('opts'),
                area = $container.data('area'),
                datetime = $container.data('datetime'),
                changePlace = opts.changePlace,
                dateFormat = opts.dateFormat,
                colWidth = opts.colWidth/2,
                lineHeight = opts.lineHeight,
                left = opts.left, right = opts.right,
                temp, tempDate, key,
                flag;

            if( area.indexArray.length === 0 ){
                for(; i<j; i++){
                    temp = data[i];
                    tempDate = temp.date;//dateFormat(temp.date);

                    if( !('_datetimeKey' in temp) ){
                        temp._datetimeKey = $._guid();
                    }
                    key = 'datetime_'+ temp._datetimeKey;
                    flag = (left <= right);

                    if( !(key in datetime) ){
                        datetime.indexArray.push(key);
                        datetime[key] = $('<div id="'+key+'" class="timeLine_event"></div>')
                            .css({
                                'position':'absolute',
                                'top':(left>right?left:right)+'px'
                            }).appendTo(target);
                    }
                    key = datetime[key];
                    if( flag ){
                        if( right - left < lineHeight ){
                            right += lineHeight;
                        }
                        left += changePlace.call(key, temp, tempDate, left, colWidth, 'left') + lineHeight;
                    }
                    else{
                        if( left - right < lineHeight ){
                            left += lineHeight;
                        }
                        right +=  changePlace.call(key, temp, tempDate, right, colWidth, 'right') + lineHeight;
                    }
                    key.data('timeLine_position', (flag?'left':right));
                }
                temp = left > right ? left : right;
                $container.height(opts.marginBottom + temp);
            }
            if( opts.showLine ) $container.find('.timeLine_line').height(temp-lineHeight);
        },
        endAll:function(){// 设置最终结束

        }
    };

    $.timeLine = function(options){
        var opts = $.extend({}, $.timeLine.defaults, options);
        return methods.init(opts);
    };

    // 默认参数
    $.timeLine.defaults = {
        container:'',
        showLine:'true',
        dateFormat:function(datetime){
            var date = null;
            if( /^\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}$/.test(datetime) ){// 验证日期格式 yyyy-MM-dd hh:mm:ss
                date = datetime.split(/:|\s|\-/);
                date = new Date(date[0], date[1], date[2], date[3], date[4], date[5]);
            }
            else if( /^\d{13}$/.test(datetime) ){// 验证日期为 13位数字的时间戳
                date = new Date( Number(datetime) );
            }
            return date;
        },
        changePlace:function(data, date, top, left, pos){
            if( !this.data('timeLine_position') ){//<span class="timeLine_event_del"></span>
                this.html('<h3 class="timeLine_event_title">'+data.title+'</h3><span class="timeLine_event_time">'+date+'</span><div class="timeLine_event_content">'+data.content+'</div>')
            }
            if( this.data('timeLine_position') !== pos ){
                this.removeClass('timeLine_event-left timeLine_event-right')
                    .addClass(pos==='left'?'timeLine_event-left':'timeLine_event-right');
            }
            if( top !== this.offset.top || left !== this.offset.left ){
                this.animate({
                    'top':top+'px',
                    'left':(pos==='left'?(-this.width()-left):left)+'px',
                    'opacity':1
                });
            }
            return this.height();
        },
        coordinateTmpl:function(date){
            var temp = fillZero( date.getMonth()+1 );
            return '<div class="timeLine_date" id="area_'+date.getFullYear()+temp+'">'+date.getFullYear()+'年'+temp+'月</div>';
        },
        order:true,
        sort:null,
        interval:'month',
        coordinate:true,
        startDate:null,
        endDate:null,
        colWidth:80,
        lineHeight:20,
        marginBottom:0,
        left:0,
        right:30,
        data:[]
    };
})(jQuery);