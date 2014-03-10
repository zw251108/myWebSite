/**
 * @module  filter 过滤器
 * @description
 *  页面中需要有 TAG_DATA 所有标签数据
 *  页面中需要有 HTML 代码：
	<div class="filter favor_filter" id="Filter">
		<div class="filter_checked" id="checked">
			<button class="btn icon icon-filter" id="setFilter" type="button" value="">过滤</button>
			<button class="btn icon icon-reset hidden" id="filterReset" type="button" value="">重置</button>
		</div>

		<div id="filterAll" class="filter_all hidden"></div>
	</div>
    JS 模块中调用要需要实现过滤函数
    $filter.triggerHandler('setFilter', [function(filterStr){
        // 过滤操作
    }]);
 */
define(['jquery', 'template'], function($){
    var filterTag = $.template({
            template: 'label.filter_tag>input[type=checkbox][value=%Id%]{%tagName%}'
        })
	    , filterFunc = null // 过滤的回调函数
	    , filterNum = 0     // 过滤标签的选择数
	    , filterStr = ''    // 过滤字符串
	    , filterTimeout = null

	    , $filter = $('#Filter')
	    , $filterReset = $filter.find('#resetFilter')  // 重置按钮
	    , $filterAll = $filter.find('#filterAll')   // 全部标签显示区域
	    ;

	$filter.on('setFilter', function(e, filter){
		filterFunc = filter;
	}).on('click', '#setFilter', function(){
		$filterAll.slideToggle();
	}).on('click', '#resetFilter', function(){
		$filterReset.addClass('hidden');
		$filterAll.find('input:checked').trigger('click');
	}).on('click', '#filterAll input:checkbox', function(){ // 过滤选项
		var $self, $clone;

		if( this.checked ){
			if( filterNum === 0 ){
				$filterReset.removeClass('hidden');
			}

			if( filterNum < 5 ){
				filterNum++;
				filterStr += (filterStr ? ',' : '' )+ this.value;

				$self = $(this).parent();
				$clone = $self.clone();

				$filter.find('#filterChecked').append( $clone );

				$self.addClass('filter_tag-checked').data('filterTarget', $clone);
			}
			else{
				this.checked = false;

				// todo 信息
				alert('最多只能选择 5 个');
			}
		}
		else{
			filterNum--;
			filterStr = (','+ filterStr +',').replace(new RegExp(','+ this.value +','), ',').replace(/^,/, '').replace(/,$/, '');

			$(this).parent().removeClass('filter_tag-checked').data('filterTarget').remove();

			if( filterNum === 0 ){// 重设全部
				$filterReset.addClass('hidden');
			}
		}

		filterTimeout && clearTimeout( filterTimeout );
		filterTimeout = null;
		if( filterFunc ){
			filterTimeout = setTimeout(function(){
				$filterAll.slideUp();

				filterFunc( filterStr );

				filterTimeout = null;
			}, 2000);
		}
//	}).on('mousewheel', '#filterAll', function(e){
//		e.stopPropagation();
	});

	$filterAll.append( filterTag(TAG_DATA) );

    return $filter;
});