MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'plugin/template/jquery.template';
MODULE_CONFIG.shim.validator = shim;
MODULE_CONFIG.paths.validator = 'plugin/validator/jquery.validator';
MODULE_CONFIG.paths.artDialog = 'plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = 'plugin/artDialog/artDialog.plugins.min';
MODULE_CONFIG.paths.filter = 'module/filter';
MODULE_CONFIG.paths.tag = 'module/tag';
MODULE_CONFIG.shim.pagination = shim;
MODULE_CONFIG.paths.pagination = 'plugin/pagination/jquery.pagination';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'tag', 'filter',
	'pagination', 'artDialog', 'artDialogPlus', 'validator'], function($, g, tag, $filter){
    var favorTmpl = $.template({
            template: 'li.article[data-favid=%Id%][data-tagsid=%tagsId%]' +
                '>a[href=%url%][target=_blank]>h3.article_title{%title%}' +
                '^hr+span.article_date{%datetime%}+div.tagArea{%tags%}',
            filter:{
                tags:function(data, index){
                    var ids, names,
                        temp, html = [],
                        i = 0, j;

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
        }),
	    $favorList = $('#favorList'),

	    currData = FAVOR_LIST,
	    page = 1,
        size = 20,
        count = currData.length,
	    $pagination = $.pagination({
		    container: '#Pagination',
		    pageIndex: page,
		    pageSize: size,
		    pageShow: 5,
		    count: count,
		    action: function(index){
			    $favorList.html( favorTmpl(currData, (index -1)* size, index * size) );

			    page = index;
		    }
	    }),

        add,
        $favorAddPopup = $('#favorAddPopup'),
        $favorAddForm;

    $filter.triggerHandler('setFilter', [function(filterStr){
	    var i = 0,
		    temp,
		    filterExpr;

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

    // 加载数据
    $favorList.html( favorTmpl(currData, 0, size) );

    $.validator.validType.url = {
        type:['required', '请填写收藏 url'],
	    focus: '请填写收藏 url',
        valid:[
            ['url']
        ],
        text:['请填写合法的 url'],
        right:'填写正确'
    };
    $.validator.validType.title = {
        type:['required', '请填写收藏标题'],
	    focus: '请填写收藏标题',
        valid:[
            ['length', 0, 50]
        ],
        text:['请将标题限制在 50 个字内'],
        right:'填写正确'
    };
    $favorAddForm = $.validator({
        selector: '#favorAddForm',
        normal:function(){
	        this.prev().removeClass('tips-focus tips-error tips-succ hidden').hide();
        },
        focus:function(txt){
	        var offset,
		        tips = this.prev();

	        tips.addClass('tips-focus').removeClass('tips-error tips-succ hidden').html(txt).show();

	        if( !this.data('tipsinit') ){
		        offset = this.offset();
		        offset.left -= 40;
		        offset.top -= 42;

		        tips.offset(offset);
		        this.data('tipsinit', true);
	        }
        },
        wrong:function(txt){
	        var offset,
		        tips = this.prev();

	        tips.addClass('tips-error').removeClass('tips-focus tips-succ hidden').html(txt).show();

	        if( !this.data('tipsinit') ){
		        offset = this.offset();
		        offset.left -= 40;
		        offset.top -= 42;

		        tips.offset(offset);
		        this.data('tipsinit', true);
	        }
        },
        right:function(txt){
	        var offset,
		        tips = this.prev();

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
    });

    $('#addFavor').on('click', function(){
        add = art.dialog({
            title: '添加收藏', content: $favorAddPopup.get(0), lock: true, fixed: true,
            cancelValue: '取消', cancel: function(){
		        // 表单数据重置
		        $favorAddForm.reset();

		        // 选择标签重置
		        tag.reset();
            }
        });
    });

    $favorAddPopup.on('submit', '#favorAddForm', function(e){
	    e.preventDefault();

        var temp;
        if( $favorAddForm.valid() ){
            temp = $favorAddForm.result();

            $.ajax({
                url: $favorAddForm.attr('action'),
                type: $favorAddForm.attr('method'),
                data: temp,
                success:function(data){
                    var date = new Date(), $t;

                    add.close();
                    if( !('error' in data) ){
                        $.extend(data, temp);

	                    data.datetime = date.getFullYear() +'-'+ (date.getMonth()+1) +'-'+ date.getDate()
		                    +' '+ date.getHours() +':'+ date.getMinutes() +':'+ date.getSeconds();

	                    console.log(data);
	                    FAVOR_LIST.unshift( data );
	                    count++;

	                    $t = $( favorTmpl([data]).join('') ).prependTo( $favorList);
	                    $t.queue();
	                    $t.fadeTo('slow', 0.2).fadeTo('slow', 0.8).fadeTo('slow', 0.2).fadeTo('slow', 1);

	                    // 表单数据重置
                        $favorAddForm.reset();

	                    // 所选标签重置
	                    tag.reset();
                    }
                    else{
                        // 显示错误信息
	                    art.dialog({
		                    title: 'Error', fixed: true, lock: true,
		                    content: '<div class="module module-normal module-popup msg msg-error">'+ data.msg +'</div>',
		                    cancelValue: '确定', cancel: function(){}
	                    });
                    }
                }
            });
        }
    });
});