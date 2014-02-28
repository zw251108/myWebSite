MODULE_CONFIG.shim.shBrushCss = ['shCore'];
MODULE_CONFIG.paths.shBrushCss = 'plugin/syntaxhighlighter/shBrushCss';
MODULE_CONFIG.shim.shBrushJScript = ['shCore'];
MODULE_CONFIG.paths.shBrushJScript = 'plugin/syntaxhighlighter/shBrushJScript';
MODULE_CONFIG.shim.shBrushXml = ['shCore'];
MODULE_CONFIG.paths.shBrushXml = 'plugin/syntaxhighlighter/shBrushXml';
define('shCore', ['plugin/syntaxhighlighter/shCore'], function(){
    return {
        SyntaxHighlighter:SyntaxHighlighter
    };
});
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'shCore', 'shBrushCss', 'shBrushJScript', 'shBrushXml'], function($, g, s){
    $('.module-document').on('click', '.section_title', function(){
        $(this).parents('.section').find('dl').slideToggle()
            .end().find('.icon-CSS').toggleClass('icon-plus icon-minus');
    }).on('click', 'dt', function(){
        $(this).toggleClass('icon-arrow-r icon-arrow-d').next().slideToggle();
    });

    SyntaxHighlighter.highlight();
});