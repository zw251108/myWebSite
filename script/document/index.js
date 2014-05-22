MODULE_CONFIG.shim.shBrushCss = ['shCore'];
MODULE_CONFIG.paths.shBrushCss = '../plugin/syntaxhighlighter/shBrushCss';
MODULE_CONFIG.shim.shBrushJScript = ['shCore'];
MODULE_CONFIG.paths.shBrushJScript = '../plugin/syntaxhighlighter/shBrushJScript';
MODULE_CONFIG.shim.shBrushXml = ['shCore'];
MODULE_CONFIG.paths.shBrushXml = '../plugin/syntaxhighlighter/shBrushXml';
define('shCore', ['../plugin/syntaxhighlighter/shCore'], function(){
    return {
        SyntaxHighlighter:SyntaxHighlighter
    };
});
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'shCore', 'shBrushCss', 'shBrushJScript', 'shBrushXml'], function($, g, s){
	var $doc = $('#doc')
		, $curr = null
		, $temp = $([])
		;

    $doc.on('click', '.section_title', function(){

	    $temp.add(this)
		    .find('.icon-CSS').toggleClass('icon-plus icon-minus').end()
		    .next('dl').slideToggle();
    }).on('click', 'dt', function(){

	    if( $curr ){
		    $curr.toggleClass('icon-arrow-r icon-arrow-d').next().slideToggle();

		    if( $curr.is(this) ){
			    $curr = null;
			    return;
		    }
	    }

	    $curr = $temp.add(this);

	    $curr.toggleClass('icon-arrow-r icon-arrow-d').next().slideToggle(function(){
		    // todo
		    g.$body.animate({
			    scrollTop: this.offsetTop -120
		    });
	    });
    });

    SyntaxHighlighter.highlight();
});