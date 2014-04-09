/**
 * @fileOverview    下拉框
 * @author  ZwB
 * @version 0.1
 * @function
 * @param   {object}
 * @return
 * @description
 * @example
 */
;(function($){
    $.dropBox = function(options){
        var opts = $.extend({}, $.dropBox.defaults, options),
            $target = opts.target;

        $target = $target.jQuery ? $target : $($target);
        if( $target.is('select') ){//

        }
        else if( $target.is(':text') || $target.is('textarea') ){

        }
    };
    $.dropBox.defaults = {
        target:''
    };
})(jQuery);