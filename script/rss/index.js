//MODULE_CONFIG.shim.dialog = shim;
//MODULE_CONFIG.paths.dialog = 'ui/jquery.dialog';
MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
MODULE_CONFIG.shim.validator = shim;
MODULE_CONFIG.paths.validator = 'ui/jquery.validator';
MODULE_CONFIG.paths.artDialog = 'plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = 'plugin/artDialog/artDialog.plugins.min';
//MODULE_CONFIG.paths.filter = 'module/filter';
//MODULE_CONFIG.paths.tag = 'module/tag';
MODULE_CONFIG.shim.pagination = shim;
MODULE_CONFIG.paths.pagination = 'ui/jquery.pagination';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'template',
//	'tag', 'filter',
	'pagination', 'artDialog', 'artDialogPlus', 'validator'], function($, g){
	var rssTmpl = $.template({
			template: 'li.article[data-rssid=%Id%][data-tagsid=%tagsId%]' +
				'>a[href=%htmlUrl%][target=_blank][title=%name%]>h3.article_title{%name%}' +
				'^hr+dl.hidden'
			, filter: {

			}
		})
		, articleTmpl = $.template({
			template: 'dt+dd'
			, filter: {

			}
		})
		, $rssList = $('#rssList')
		, currData = RSS_LIST
		, page = 1
		, size = 20
		, count = currData.length
//		, $pagination = $.pagination({
//			container: '#Pagination',
//			pageIndex: page,
//			pageSize: size,
//			pageShow: 5,
//			count: count,
//			action: function(index){
//				$rssList.html( rssTmpl(currData, (index -1)* size, index * size) );
//
//				page = index;
//			}
//		})
		;

	$rssList.on('click', 'span', function(){

	}).html( rssTmpl(currData, 0, size) );
});