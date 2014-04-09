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
        init:function(opts){
            var container = $(opts.container);

            return container
        }
    };
    $.tips = function(options){
        var opts = $.extend({}, $.tips.defaults, options);
    };
    $.tips.defaults = {
        container:'',
        eventType:'click'
    };
})(jQuery);