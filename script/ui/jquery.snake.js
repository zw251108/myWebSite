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
(function($){
    var methods = {
        init:function(){

        }
    };

    $.snake = function(options){
        var opts = $.extend({}, $.snake.defaults, options);
    };

    $.snake.defaults = {
        container:'',
        bgImg:[]
    };
})(jQuery);