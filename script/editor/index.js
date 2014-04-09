MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
MODULE_CONFIG.shim.dialog = shim;
MODULE_CONFIG.paths.dialog = 'ui/jquery.dialog';
MODULE_CONFIG.shim.layout = shim;
MODULE_CONFIG.paths.layout = 'ui/jquery.layout';
MODULE_CONFIG.paths.filter = 'module/filter';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'filter', 'template', 'layout'], function($, g, $filter){
    var editorTmpl = $.template({
            template:'a[href=edit.php?id=%Id%]' +
                '>article.article.editor_article[data-tagsid=%tagsId%]' +
                '>h3.article_title{%name%}' +
                '+img.article_preview[src=%preview%][width=%width%][height=%height%][alt=%alt%]',
            filter:{
                alt:function(data, index){
                    return data.preview ? data.name : '没有预览图片';
                }
            }
        })
	    , $editorList = $('#editorList')
	    , page = 1
	    , size = 20
	    , currData = EDITOR_LIST
	    , count = currData.length
	    , pageCount = Math.ceil( count / size )
	    , space = parseInt( $editorList.css('marginLeft') )
	    , layout = function(){
		    $.layout({
			    container: $editorList,
			    selector: 'article',
			    left: space -10,
			    top: space -10,
			    colSpace: space,
			    rowSpace: space
		    });
	    }
	    , scrollTimeout = null;


	// 设置过滤回调函数
	$filter.triggerHandler('setFilter', [function(filterStr){
		var i = 0,
			temp,
			filterExpr;

		if( !filterStr ){
			currData = EDITOR_LIST;
		}
		else{
			filterStr = filterStr.replace(/,/g, '|');
			filterExpr = new RegExp('(^|,)('+ filterStr +')(,|$)');

			currData = [];
			for(; i < count; i++){
				temp = EDITOR_LIST[i];

				if( filterExpr.test( temp.tagsId ) ){
					currData.push( temp );
				}
			}
		}

		pageCount = Math.ceil( currData.length / size );
		page = 1;
		$editorList.html( editorTmpl(currData, 0, size) );
		layout();
	}]);

	// 加载数据
	$editorList.html( editorTmpl(currData, 0, size) );

	layout();

//	if( $editorList.width() > 290 ){
//		layout = function(){
//			$.layout({
//				container: $editorList,
//				selector: 'article',
//				left: space -10,
//				top: space -10,
//				colSpace: space,
//				rowSpace: space
//			});
//		};
//
//		layout();
//		g.resize.add(layout);
//	}
//	else{
//		layout = function(){};
//		g.resize.add(function(){
//			if( $editorList.width() > 290 ){
//				$('#minArt').remove();
//			}
//			else{
//				$('head').append('<style id="minArt">.editor_article{width:270px;margin-left:0;}</style>');
//			}
//		});
//		$('head').append('<style id="minArt">.editor_article{width:270px;margin-left:0;}</style>');
//	}

	g.resize.add(layout);
	g.scroll.add(function(){
		var doc = g.doc,
			body = g.body,
			height = g.HEIGHT;

		if( page < pageCount && height + (body.scrollTop || doc.scrollTop) >= doc.scrollHeight ){

			scrollTimeout && clearInterval( scrollTimeout );
			scrollTimeout = setTimeout(function(){

				page++;
				$editorList.append( editorTmpl(currData, (page -1)* size, page * size ) );
				layout();

				scrollTimeout = null;
			}, 500);
		}
	});
});