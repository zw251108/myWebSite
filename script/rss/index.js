//MODULE_CONFIG.shim.dialog = shim;
//MODULE_CONFIG.paths.dialog = 'ui/jquery.dialog';
MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
MODULE_CONFIG.shim.validator = shim;
MODULE_CONFIG.paths.validator = 'ui/jquery.validator';
MODULE_CONFIG.paths.artDialog = 'plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = 'plugin/artDialog/artDialog.plugins.min';
MODULE_CONFIG.paths.filter = 'module/filter';
MODULE_CONFIG.paths.tag = 'module/tag';
MODULE_CONFIG.shim.pagination = shim;
MODULE_CONFIG.paths.pagination = 'ui/jquery.pagination';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'tag', 'filter', 'template',
	'pagination', 'artDialog', 'artDialogPlus', 'validator'], function($, g, tag, $filter){
	var rssTmpl = $.template({
			template: 'li.rss_item[data-rssid=%Id%][data-tagsid=%tagsId%]' +
				'>a[href=%htmlUrl%][data-rssfeed=%xmlUrl%][target=_blank][title=%name%]>h3.rssItem_title{%name%}' +
				'^hr+ul.rss_articleList.hidden+div.tagArea{%tags%}' +
				'+div.btn_group.btn_group-item.hidden>button.btn.icon.icon-edit.js-edit[type=button]{编辑}' +
				'+button.btn.icon.icon-delete.js-delete[type=button]{删除}'
			, filter: {

			}
		})
		, articleTmpl = $.template({
			template: 'li.article>a.link[href=%link%][target=_blank]>h4.article_title{%title%}' +
				'^div.article_content{%description%}+div.btn_group.btn_group-article.hidden' +
				'>button.btn.icon.icon-favor.js-edit[type=button]{收藏}'
			, filter: {

			}
		})
		, currData = RSS_LIST
		, page = 1
		, size = 20
		, count = currData.length
		, $pagination = $.pagination({
			container: '#Pagination',
			pageIndex: page,
			pageSize: size,
			pageShow: 5,
			count: count,
			action: function(index){
				$rssList.html( rssTmpl(currData, (index -1)* size, index * size) );

				page = index;
			}
		})
		, $rssList = $('#rssList')
		;

	/**
	 * 设置过滤器回调函数
	 * */
	$filter.triggerHandler('setFilter', [function(filterStr){
		var i = 0
			, temp
			, filterExpr
			;

		if( !filterStr ){
			currData = RSS_LIST;
		}
		else{
			filterStr = filterStr.replace(/,/g, '|');
			filterExpr = new RegExp('(^|,)('+ filterStr +')(,|$)');

			currData = [];
			for(; i < count; i++){
				temp = RSS_LIST[i];

				if( filterExpr.test( temp.tagsId ) ){
					currData.push( temp );
				}
			}
		}

		page = 1;
		$rssList.html( rssTmpl(currData, 0, size) );

		currData.length ? $pagination.removeClass('hidden').triggerHandler('setPage', [page, size, currData.length]) :
			$pagination.addClass('hidden');
	}]);

	$rssList.on({
		getRssContentList: function(e, $item){
			$.ajax({
				url: 'getFeed.php'
				, data: 'feed='+ $item.data('rssfeed')
				, context: $item
				, success: function(data){
					this.data('deploy', true).nextAll('.rss_articleList').html( articleTmpl( data.data).join('') ).slideDown();
				}
			});
		}
	}).on({
		mouseenter: function(){
			$(this).find('.btn_group-item').show();
		}
		, mouseleave: function(){
			$(this).find('.btn_group-item').hide();
		}
	}, '.rss_item').on({
		mouseenter: function(){
			$(this).find('.btn_group-article').show();
		}
		, mouseleave: function(){
			$(this).find('.btn_group-article').hide();
		}
	}, '.article').on('click', '.rss_item > a', function(e){
		e.preventDefault();

		var $self = $(this);

		if( $self.data('deploy') ){
			$self.nextAll('.rss_articleList').slideToggle();
		}
		else{
			$rssList.triggerHandler('getRssContentList', [$self]);
		}
	}).html( rssTmpl(currData, 0, size) );
//	$rssList.html( rssTmpl(currData, 0, size) ).on('click', '.article > a', function(e){
//		e.preventDefault();
//
//		var $self = $(this);
//
//		if( $self.data('deploy') ){
//			$self.nextAll('div').find('ul').slideToggle();
//		}
//		else{
//			$.ajax({
//				url: 'getFeed.php'
//				, data: 'feed='+ $self.parent().data('rssfeed')
//				, context: $self
//				, success: function(data){
//					this.data('deploy', true).nextAll('div').find('ul').html( articleTmpl( data.data).join('') ).slideDown();
//				}
//			});
//		}
//	}).html( rssTmpl(currData, 0, size) );
});