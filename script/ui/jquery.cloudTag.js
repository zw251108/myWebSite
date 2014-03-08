/**
 * @fileOverview
 * @author  ZwB
 * @function
 * @param   {object}
    * @return
 * @description
 * @example
 */
(function($){
    var methods = {
        rand:function(min, max){
            return Math.floor( Math.random() * (max-min) + min );
        },
        setup:function( $target, $container, parentLeft, parentTop, parentWidth, parentHeight, absolute ){
            var width = $target.width(),
                height = $target.height(),
                initOffset = absolute ? $target.position() : $target.offset();

            parentWidth -= width;
            parentHeight -= height;
            initOffset.top += 'px';
            initOffset.left += 'px';

            $target.data({
                'x1':parentLeft,
                'y1':parentTop,
                'x2':parentLeft+parentWidth,
                'y2':parentTop+parentHeight,
                'initOffset':initOffset
            });
        },
        animate:function( $target ){
            var self = this,
                position = {};

            position.top = this.rand( $target.data('y1'), $target.data('y2') );
            position.left = this.rand( $target.data('x1'), $target.data('x2') );

//            var floats = Math.floor( Math.random()*10 );

            $target.animate(position, self.rand( 5000 , 10000 ), (function(t){return function(){self.animate(t);}})($target));
        },
        reStart:function($item){
            var l = this.length;
            if( !$item ){
                while( l-- ){
                    methods.animate( this.eq(l) );
                }
            }
            else{
                methods.animate( $item );
            }
        },
        resetPlace:function(callback){
            var l = this.length, i = l,
                temp;
            while( l-- ){
                temp = this.eq(l);
                temp.stop().animate( temp.data('initOffset'), 'slow', function(){
                    i--;
                    if( i=== 1 ){
                        callback && callback();
                    }
                } );
            }
        }
    };
    $.cloudTag = function(options){
        var opts = $.extend({}, $.cloudTag.defaults, options),
            $container = $( opts.container),
            $tags = $( opts.tags),
            i = $tags.length,
            $temp = $tags.parent(),
            offset = $container.offset(),
            left = offset.left,
            top = offset.top,
            width = $container.width(),
            height = $container.height(), absolute = false;
        if( !$temp.is( $container ) && $temp.css('position') === 'absolute' ){
            offset = $temp.offset();
            top -= offset.top;
            left -= offset.left;
            absolute = true;
        }

        while( i-- ){
            $temp = $tags.eq(i);
            methods.setup( $temp, $container, left, top, width, height, absolute );
            methods.animate( $temp );
        }
        $tags.reStart = methods.reStart;
        $tags.resetPlace = methods.resetPlace;
        return $tags;
    };
    $.cloudTag.defaults = {
        'container':'',
        'tags':'',
        'area':'parent'
    };
})(jQuery);