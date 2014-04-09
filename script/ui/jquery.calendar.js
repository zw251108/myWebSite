/**
 * @fileOverview
 * @author  ZwB
 * @version
 * @function
 * @param   {object}
 * @return
 * @description
 * @example
 */
;(function($){
    var methods = {
	    monthDays: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
	    /**
	     * 判断是否为闰年
	     * */
	    , isLeapYear:function(y){
		    y = Number(y);
		    return (y%4===0 && y%100!==0) || y%400===0;
	    }
	    , init: function(y, m, d, w){
		    var content = '<div class="calendar_head">' +
				    '<button id="calendarPY" title="上一年">&lt;&lt;</button>' +
				    '<button id="calendarPM" title="上一月">&lt;</button>' +
				    '<button id="selectYear">'+ y +' 年</button>' +
				    '<button id="selectMonth">'+ m +' 月</button>' +
				    '<button id="calendarNM" title="下一月">&gt;</button>' +
				    '<button id="calendarNY" title="下一年">&gt;&gt;</button>' +
			    '</div>'
			    , i = 1
			    , j = this.monthDays[m -1]
			    ;

		    j = (m === 2 && this.isLeapYear( y )) ? j +1 : j;

		    if( w !== 0 ){
			    content += w === 0 ? '' : '<ul class="week">';
			    for(; i < w; i++ ){
				    content += '<li class="day"></li>';
			    }
		    }

		    for(; i <= j; i++){

		    }

		    return content;
	    }
	    , bindEvent: function(){

	    }
    };

    $.calendar = function(options){
        var opts = $.extend({}, $.calendar.defaults, options)
	        , $container = opts.selector
	        , date = new Date()
		    , y = parseInt(opts.year, 10)
		    , m = parseInt(opts.month, 10)
		    , d = parseInt(opts.day, 10)
	        , content = ''
	        , temp
	        ;

	    $container = (typeof $container === 'object' && $container.jQuery)? $container : $( $container );

	    // 验证年月日为当前日期或以前日期
	    temp = date.getFullYear();
	    y = y < temp ? y : temp;
	    temp = date.getMonth() +1;
	    m = m < temp ? m : temp;
	    temp = date.getDate();
	    d = d < temp ? d : temp;
	    date = new Date(y, m, d);

	    content += methods.init( y, m, d, date.getDay() );

	    $container.append( content );

	    return $container;
    };

    $.calendar.defaults = {
	    selector: ''    // 目标容器
	    , year: ''      // 设置年份
	    , month: ''     // 设置月份
	    , day: ''       // 设置日期
	    , firstDay: 7   // 每星期的以哪天开始
    };
})(jQuery);