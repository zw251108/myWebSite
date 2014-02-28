MODULE_CONFIG.paths.artDialog = 'plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = 'plugin/artDialog/artDialog.plugins.min';
MODULE_CONFIG.shim.calendar = ['calendar'];
MODULE_CONFIG.paths.calendar = 'plugin/calendar/jquery.calendar';
require(['jquery', 'global', 'artDialog', 'artDialogPlus', 'calendar'], function($, g){

	var $calendar = $.calendar({
			selector: '#calendarMain'
		})
		;

	$('.module-document').on('click', '.section_title', function(){
		$(this).parents('.section').find('dl').slideToggle()
			.end().find('.icon-CSS').toggleClass('icon-plus icon-minus');
	}).on('click', 'dt', function(){
		$(this).toggleClass('icon-arrow-r icon-arrow-d').next().slideToggle();
	});

	SyntaxHighlighter.highlight();
});