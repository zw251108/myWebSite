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
 */
define(['jquery', 'template'], function($){
    var filterTag = $.template({
            template: 'label.filter_tag>input[type=checkbox][value=%Id%]{%tagName%}'
        }),
	    filterCB = null,    // 过滤的回调函数
        filterNum = 0,
        filterStr = '',
        filterTimeout = null,
        $filter = $('#Filter'),
	    $filterAll = $filter.find('#filterAll'),
	    $filterReset = $('#filterReset');

	$filter.on('setFilter', function(e, filter){
		filterCB = filter;
	}).on('click', '#setFilter', function(){    // 显示过滤选项
        $filterAll.slideToggle();
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

                $filter.find('#checked').append( $clone );

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
            filterStr = filterStr.replace(new RegExp('(?:^|,)'+ this.value +'(?:,|$)'), '').replace(/^,/, '').replace(/,$/, '');

            $(this).parent().removeClass('filter_tag-checked').data('filterTarget').remove();

            if( filterNum === 0 ){// 重设全部
	            $filterReset.addClass('hidden');
            }
        }

        filterTimeout && clearTimeout( filterTimeout );
		filterTimeout = null;
		if( filterCB ){
			filterTimeout = setTimeout(function(){
				$filterAll.slideUp();

				filterCB( filterStr );

				filterTimeout = null;
			}, 2000);
		}
	}).on('mousewheel', '#filterAll', function(e){
		return false;
	}).on('click', '#filterReset', function(){  // 重置选项
        $filterReset.addClass('hidden');
        $filterAll.find('input:checked').trigger('click');
    });

	$filterAll.append( filterTag(TAG_DATA) );

    return $filter;
//	{
//        container: $filter,
//        filter: function(data, filterCallback){
//	        if( (!data.jquery && !$.isArray( data )) || !filterStr ) return data;
//
//	        var rs = [], temp,
//		        i = 0, j = data.length;
//
//	        for(; i < j; i++){
//		        temp = data[i];
//		        if( filterCallback(filterStr, temp, i) ){
//			        rs.push( temp );
//		        }
//	        }
//	        return rs;
//        }
//    };
});