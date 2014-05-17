MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = '../ui/jquery.template';
MODULE_CONFIG.shim.validator = shim;
MODULE_CONFIG.paths.validator = '../ui/jquery.validator';
MODULE_CONFIG.paths.artDialog = '../plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = '../plugin/artDialog/artDialog.plugins.min';
MODULE_CONFIG.paths.filter = '../module/filter';
MODULE_CONFIG.paths.tag = '../module/tag';
MODULE_CONFIG.shim.pagination = shim;
MODULE_CONFIG.paths.pagination = '../ui/jquery.pagination';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'tag', 'filter',
	'pagination', 'artDialog', 'artDialogPlus', 'validator'], function($, g, tag, $filter){
    var GUID_DATA = {}
	    , favorTmpl = $.template({
            template: 'li.article[data-guid=%guid%][data-index=%index%][data-favid=%Id%][data-tagsid=%tagsId%]' +
                '>a[href=%url%][target=_blank]>h3.article_title{%title%}' +
                '^hr+span.article_date{%datetime%}+div.tagArea{%tags%}' +
	            '+div.btn_group.hidden>button.btn.icon.icon-edit.js-edit[type=button]{编辑}' +
	            '+button.btn.icon.icon-delete.js-delete[type=button]{删除}',
            filter:{
                index: function(data, index){
	                return data.index || index;
                }
	            , guid: function( data ){
		            var guid = $._guid();

		            GUID_DATA[guid] = data;

		            return guid;
	            }
                , tags: function( data ){
                    var ids, names, temp
	                    , html = []
	                    , i = 0
	                    , j
	                    ;

                    temp = data.tagsId;
                    ids = temp ? temp.split(',') : [];
                    j = ids.length;

                    temp = data.tagsName;
                    names = temp ? temp.split(',') : [];

                    for(; i < j; i++){
                        html.push('<span class="tag" data-tagid="', ids[i], '">', names[i], '</span>');
                    }

                    return html.join('');
                }
            }
        })
	    , $favorList = $('#favorList')
	    , currData = FAVOR_LIST
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
			    $favorList.html( favorTmpl(currData, (index -1)* size, index * size) );

			    page = index;
		    }
	    })
	    , dialog
	    , $favorAddPopup = $('#favorAddPopup')
	    , $favorAddForm
	    , $favorTitle
	    , $favorUrl
	    , $favorId
	    , $favorIndex
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
		    currData = FAVOR_LIST;
	    }
	  	else{
		    filterStr = filterStr.replace(/,/g, '|');
		    filterExpr = new RegExp('(^|,)('+ filterStr +')(,|$)');

		    currData = [];
		    for(; i < count; i++){
			    temp = FAVOR_LIST[i];

			    if( filterExpr.test( temp.tagsId ) ){
				    currData.push( temp );
			    }
		    }
	    }

	    page = 1;
	    $favorList.html( favorTmpl(currData, 0, size) );

	    currData.length ? $pagination.removeClass('hidden').triggerHandler('setPage', [page, size, currData.length]) :
		    $pagination.addClass('hidden');
    }]);

	/**
	 * 表单验证
	 * */
    $.validator.validType.url = {
        type:['required', '请填写收藏 url']
	    , focus: '请填写收藏 url'
	    , valid:[
            ['url']
        ]
	    , text:['请填写合法的 url']
	    , right:'填写正确'
    };
    $.validator.validType.title = {
        type:['required', '请填写收藏标题']
	    , focus: '请填写收藏标题'
	    , valid:[
            ['length', 0, 50]
        ]
	    , text:['请将标题限制在 50 个字内']
	    , right:'填写正确'
    };
    $favorAddForm = $.validator({
        selector: '#favorAddForm'
	    , normal:function(){
	        this.prev().removeClass('tips-focus tips-error tips-succ hidden').hide();
        }
	    , focus:function(txt){
	        var offset
		        , tips = this.prev();

	        tips.addClass('tips-focus').removeClass('tips-error tips-succ hidden').html(txt).show();

	        if( !this.data('tipsinit') ){
		        offset = this.offset();
		        offset.left -= 40;
		        offset.top -= 42;

		        tips.offset(offset);
		        this.data('tipsinit', true);
	        }
        }
	    , wrong:function(txt){
	        var offset
		        , tips = this.prev();

	        tips.addClass('tips-error').removeClass('tips-focus tips-succ hidden').html(txt).show();

	        if( !this.data('tipsinit') ){
		        offset = this.offset();
		        offset.left -= 40;
		        offset.top -= 42;

		        tips.offset(offset);
		        this.data('tipsinit', true);
	        }
        }
	    , right:function(txt){
	        var offset
		        , tips = this.prev();

            tips.addClass('tips-succ').removeClass('tips-focus tips-error hidden').html(txt)
	            .delay('500').fadeOut();


	        if( !this.data('tipsinit') ){
		        offset = this.offset();
		        offset.left -= 40;
		        offset.top -= 42;

		        tips.offset(offset);
		        this.data('tipsinit', true);
	        }
        }
    }).on('submit', function(e, target){
	    e.preventDefault();

	    // 提交表单（添加 || 编辑）
	    var temp;
	    if( $favorAddForm.valid() ){
		    temp = $favorAddForm.result();

		    $.ajax({
			    url: this.action
			    , type: this.method
			    , data: temp
			    , success: function(data){
				    var date = new Date()
					    , index
					    , $t;

				    dialog.close();
				    if( !('error' in data) ){

					    if( $favorIndex.val() ){  // 编辑
//						    data.id = data.favorId;

						    /**
						     * todo 调整
						     * */
//						    $t = target.data.target;
//						    index = $t.data('index');
//
//						    $.extend(FAVOR_LIST[index], temp);
					    }
					    else{   // 添加
//		                    $.extend(data, temp);

						    $.extend(data, temp);

						    data.datetime = date.getFullYear() +'-'+ (date.getMonth()+1) +'-'+ date.getDate()
							    +' '+ date.getHours() +':'+ date.getMinutes() +':'+ date.getSeconds();

						    FAVOR_LIST.unshift( data );
						    count++;

						    $t = $( favorTmpl([data]).join('') ).prependTo( $favorList);
						    $t.queue();
						    $t.fadeTo('slow', 0.2).fadeTo('slow', 0.8).fadeTo('slow', 0.2).fadeTo('slow', 1);
					    }

					    // 表单数据重置
					    $favorAddForm.reset();

					    // 所选标签重置
					    tag.reset();
				    }
				    else{
					    // 显示错误信息
					    art.dialog({
						    title: '出现错误', fixed: true, lock: true,
						    content: '<div class="module module-normal module-popup popup-error">' +
							    '<p class="msg msg-error">'+ data.msg +'</p></div>',
						    cancelValue: '确定', cancel: function(){}
					    });
				    }
			    }
		    });
	    }
    });
	$favorTitle = $favorAddForm.find('#title');
	$favorUrl = $favorAddForm.find('#url');
	$favorId = $favorAddForm.find('#favorId');
	$favorIndex = $favorAddForm.find('#favorIndex');

	/**
	 * 列表操作
	 * */
	$favorList.on({
		mouseenter: function(){
			$(this).find('.btn_group').show();
		}
		, mouseleave: function(){
			$(this).find('.btn_group').hide();
		}
	}, 'li').on('click', '.js-edit', function(){  // 编辑按钮
		var $article = $(this).parents('li');

		$favorTitle.val( $article.find('h3.article_title').html() );
		$favorUrl.val( $article.find('a').attr('href') );
		$favorId.val( $article.data('favid') );
		$favorIndex.val( $article.data('index') );

		tag.setValue($article.data('tagsid'), '');
		dialog = art.dialog({
			title: '编辑收藏', content: $favorAddPopup.get(0), lock: true, fixed: true
			, cancelValue: '取消', cancel: function(){
				// 表单数据重置
				$favorAddForm.reset();

				// 选择标签重置
				tag.reset();
			}
		});
	}).on('click', '.js-delete', function(){  // 删除按钮

	}).html( favorTmpl(currData, 0, size) );    // 加载数据

	/**
	 * 添加按钮弹窗
	 * */
	$('#addFavor').on('click', function(){
        dialog = art.dialog({
            title: '添加收藏', content: $favorAddPopup.get(0), lock: true, fixed: true
	        , cancelValue: '取消', cancel: function(){
		        // 表单数据重置
		        $favorAddForm.reset();

		        // 选择标签重置
		        tag.reset();
            }
        });
    });
});