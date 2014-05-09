MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'template'], function($){
    var colorTmpl = $.template({
            template:'li[style=background:#%colorValue%]{%colorName% #%colorValue%}'
        })
	    , $cache = $([])
//	    , $modules = $('.module, .Header')
	    ;

    $('#paletteList').on('click', 'a', function(e){
        var $self = $cache.add( this),
            isDeploy = $self.data('deploy');

        e.preventDefault();

        if( isDeploy ){
            $self.next().slideToggle()
                .parents('section.section').find('span.icon').toggleClass('icon-plus icon-minus');
        }
        else{
            $.ajax({
                url: this.href,
                context: $self,
                success:function(data){
                    if( !('error' in data) ){
                        this.data('deploy', true)
                            .next().hide().html( colorTmpl(data.data) ).slideDown()
                            .parents('section.section').find('span.icon').toggleClass('icon-plus icon-minus');
                    }
                    else{// 错误
                        // todo 错误提示
                    }
                }
            });
        }
//    }).on('click', 'li', function(){
//        var color = /#([0-9a-f]{6})/.exec( this.innerHTML )[1];
//
//        $modules.css('background-color', '#'+ color);
//
//        $.cookie('color', color, 3600000, '/'); // 将颜色值存入 Cookie
    });
});