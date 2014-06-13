define('XRegExp', ['../plugin/syntaxhighlighter/XRegExp'], function(){
	return {
		XRegExp:XRegExp
	};
});
define('shCore', ['XRegExp', '../plugin/syntaxhighlighter/shCore'], function(){
	return {
		SyntaxHighlighter:SyntaxHighlighter
	};
});
MODULE_CONFIG.shim.shAutoloader = ['shCore'];
MODULE_CONFIG.paths.shAutoloader = '../plugin/syntaxhighlighter/shAutoloader';

require.config(MODULE_CONFIG);
require(['jquery', 'global', 'shCore', 'shAutoloader'], function($, g, s){
	var $doc = $('#doc')
		, $curr = null
		, $temp = $([])
		;

	s = s.SyntaxHighlighter;
	s.autoloader([
		'css', '../script/plugin/syntaxhighlighter/shBrushCss.js'
	], [
		'js', 'jscript', 'javascript',	'../script/plugin/syntaxhighlighter/shBrushJScript.js'
	], [
		'xml', 'xhtml', 'xslt', 'html', '../script/plugin/syntaxhighlighter/shBrushXml.js'
	]);

	$doc.on('click', '.section_title', function(){

	    $temp.add(this)
		    .find('.icon-CSS').toggleClass('icon-plus icon-minus').end()
		    .next('dl').slideToggle();
    }).on('click', 'dt', function(){

	    if( $curr ){
		    $curr.toggleClass('icon-arrow-r icon-arrow-d');

		    if( $curr.is(this) ){
				$curr.next().slideToggle();
			    $curr = null;
			    return;
		    }
	    }

		$curr && $curr.next().hide();
	    $curr = $temp.add(this);

		g.$body.animate({
			scrollTop: this.offsetTop -80
		}, function(){
			$curr.toggleClass('icon-arrow-r icon-arrow-d').next().slideToggle();
		});
    });

	s.all();
});