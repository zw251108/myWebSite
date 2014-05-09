MODULE_CONFIG.shim.colorPicker = shim;
MODULE_CONFIG.paths.colorPicker = 'plugin/farbtastic/farbtastic';
MODULE_CONFIG.shim.tree = shim;
MODULE_CONFIG.paths.tree = 'plugin/zTree/jquery.ztree.all-3.5.min';
MODULE_CONFIG.shim.validator = shim;
MODULE_CONFIG.paths.validator = 'ui/jquery.validator';
MODULE_CONFIG.paths.artDialog = 'plugin/artDialog/artDialog.min';
MODULE_CONFIG.shim.artDialogPlus = ['artDialog'];
MODULE_CONFIG.paths.artDialogPlus = 'plugin/artDialog/artDialog.plugins.min';
MODULE_CONFIG.paths.codeMirror = 'plugin/codeMirror/codemirror';
MODULE_CONFIG.shim.codeMirrorJs = ['codeMirror'];
MODULE_CONFIG.paths.codeMirrorJs = 'plugin/codeMirror/javascript';
MODULE_CONFIG.shim.codeMirrorCss = ['codeMirror'];
MODULE_CONFIG.paths.codeMirrorCss = 'plugin/codeMirror/css';
MODULE_CONFIG.shim.codeMirrorHtml = ['codeMirror'];
MODULE_CONFIG.paths.codeMirrorHtml = 'plugin/codeMirror/htmlmixed';
MODULE_CONFIG.shim.codeMirrorXml = ['codeMirror'];
MODULE_CONFIG.paths.codeMirrorXml = 'plugin/codeMirror/xml';
MODULE_CONFIG.shim.codeMirrorEmmet = ['codeMirror'];
MODULE_CONFIG.paths.codeMirrorEmmet = 'plugin/codeMirror/emmet';
MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
MODULE_CONFIG.paths.tag = 'module/tag';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'tag', 'artDialog', 'artDialogPlus', 'validator', 'colorPicker', 'tree', 'codeMirror',
	'codeMirrorJs', 'codeMirrorCss', 'codeMirrorHtml', 'codeMirrorXml', 'codeMirrorEmmet'], function($, g, tag){
    var $cache = $([]),
	    $body = $('body'),

	    $codeForm = $('#code'),

	    currentShow = 0,
        js = $codeForm.find('#JS')[0],
        css = $codeForm.find('#CSS')[0],
        html = $codeForm.find('#HTML')[0],
        $result = $codeForm.find('#result'),

        $editorContent = $codeForm.find('#editorContent'),

        $incFileHidden = $codeForm.find('#incFileHidden'),
	    $incFile = $('#selectedFile'),

	    $fullScreenBtn = $('#fullScreen'),

	    $editorSavePopup = $('#editorSavePopup'),
	    $editorSaveForm,

        t, temp, i, j, rs;

    if( !$.isEmptyObject( EDITOR_DETAIL ) ){
        currentShow = 3;
        $codeForm.find('#codeTabs li').eq(0).removeClass('current').end().eq(-1).addClass('current');
        $editorContent.css('marginLeft', '-300%');

        js.value = EDITOR_DETAIL.js ? EDITOR_DETAIL.js.replace(/&acute;/g, '\'') : '';
        css.value = EDITOR_DETAIL.css ? EDITOR_DETAIL.css.replace(/&acute;/g, '\'') : '';
        html.value = EDITOR_DETAIL.html ? EDITOR_DETAIL.html.replace(/&acute;/g, '\'') : '';

        temp = EDITOR_DETAIL.includeFile;
        if( temp ){
            $incFileHidden.val( temp );

            temp = temp.split(',');
            rs = [];
            for( i = 0, j = temp.length; i < j; i++ ){
                t = temp[i];

	            rs.push('<li class="level2"><span class="button chk checkbox_true_',
		            (/jquery-([\d\.]*)\.min\.js$/.test(t) ? 'disable': 'full'),
		            '"></span><input type="hidden" value="',
		            t, '"/><a class="level2"><span class="button ico_docu"></span><span>',
		            /\/([^\/]*)$/.exec(t)[1], '</span></a></li>');
            }
	        $incFile.html( rs.join('') );
        }
    }

    js = CodeMirror.fromTextArea(js, {
	    mode: 'text/javascript',
        lineNumbers: true,
        matchBrackets: true,
        indentUnit: 4,
        tabSize: 4,
//        profile: 'javascript',
        extraKeys: {
            Enter:'newlineAndIndentContinueComment'
        }
    });
    css = CodeMirror.fromTextArea(css, {
	    mode: 'text/css',
        lineNumbers: true,
        indentUnit: 4,
        tabSize: 4
    });
    html = CodeMirror.fromTextArea(html, {
        mode: 'text/html',
        lineNumbers : true,
        indentUnit: 4,
        tabSize: 4,
        profile: 'xhtml'
        /* define Emmet output profile */
    });

	tag.setValue(EDITOR_DETAIL.tagsId || '', EDITOR_DETAIL.tagsName || '');

	$.validator.validType.title = {
		type:['required', '请输入 UI 标题'],
		focus: '请输入 UI 标题',
		valid:[
			['length', 0, 50]
		],
		text:['请将标题限制在 50 个字内'],
		right:'填写正确'
	};
	$editorSaveForm = $.validator({
		selector: '#editorSaveForm',
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

    /**
     * btn 功能按钮 保存
     * btn 功能按钮 运行
     * 标签切换
     * */
    $codeForm.on('click.save', '#save', function(){
        js.save();
        css.save();
        html.save();

        art.dialog({
            id:'save', title:'保存', content:$editorSavePopup.get(0), lock:true, fixed:true,
            okValue:'我负全责', ok:function(){
                var dialog = this
	                , ok = $(this.dom.buttons[0]).find(':button').eq(0)
	                , cancel = ok.next()
	                , title
	                , content = '<div class="module module-normal module-popup'
	                , status = 'error'
	                ;

                $.ajax({
                    url: $editorSaveForm.attr('action')
	                , data: $editorSaveForm.serialize() +'&'+ $codeForm.serialize()
	                , type: $editorSaveForm.attr('method')
	                , dataType: 'json'
	                , success: function(data){
                        if( 'succ' in data ){
	                        title = '恭喜';
	                        content += ' popup-success"><p class="msg msg-success">恭喜你，你成功了！</p></div>';

	                        status = data.id;
                        }
                        else if( 'error' in data ){
	                        title = '出现错误';
	                        content += ' popup-error"><p class="msg msg-error">'+ data.msg +'</p></div>';
                        }
                        else{
	                        title = '不知道什么状况';
	                        content += ' popup-error"><p class="msg msg-error">产生了一些未知异常，不过我估计是你的问题！</p></div>';
                        }
                    }
	                , error: function(){
	                    title = '唉。。。';
	                    content += ' popup-error"><p class="msg msg-error">连接服务器失败，唉，你那可悲的网络，我也不说啥了。。</p>';
                    }
	                , complete: function(){
		                dialog.title( title );
		                dialog.content( content );
                        ok.remove();
                        cancel.remove();

                        if( status !== 'error' && $('#id').val() === '0' ){
                            location.href = location.href.replace(/id=(\d*)$/, 'id='+ status);
                        }
                        else{
                            dialog.time(3000);
                        }
	                }
                });
                return false;
            },
            cancelValue: '我不太确定', cancel: function(){}
        });
    }).on('click', '#run', function(e){
        e.preventDefault();

        if( !$result.hasClass('j-addE') ){  // 绑定加载事件
            $result.on('load', function(){

	            this.contentWindow.__addHJC($incFileHidden.val().split(','), css.getValue(), js.getValue(),
		            html.getValue());

            }).addClass('j-addE');
        }
        $result.attr('src', 'result.php');

        currentShow = 3;
        $editorContent.css('marginLeft', '-300%');
        $codeForm.find('#codeTabs li.current').removeClass('current').end().find('#codeTabs li:eq(3)').addClass('current');
    }).on('click', '#codeTabs li', function(){
        var $temp = $cache.add(this),
            i = $temp.index();

        if( currentShow !== i ){
            $editorContent.animate({
                marginLeft: (-i *100) +'%'
            });

            $temp.addClass('current').siblings().removeClass('current');

            currentShow = i;
        }
    });

	/**
	 * btn 功能按钮 显示文件目录
	 * */
    $('#showFileList').on('click', function(){
        var self = this;
        art.dialog({
            id:'showFileList', title:'项目文件列表'
	        , content:$('#directory').get(0)
//	        , follow:self
	        , initialize:function(){
                if( !/getList/.test( self.className ) ){
                    $.ajax({
                        url:'fileList.php',
                        type:'post',
                        dataType:'json',
                        success:function(data){
                            $.fn.zTree.init($('#tree'), {
                                callback: {
                                    onCheck: function(e, treeId, treeNode){
                                        var rs, name, temp;

                                        if( treeNode.checked &&
	                                        !$incFile.find('input:hidden[value$="'+ treeNode.name +'"]').length ){
                                            rs = name = treeNode.name;

                                            temp = treeNode.getParentNode();


                                            while( temp ){
                                                rs = temp.name +'/'+ rs;
                                                temp = temp.getParentNode();
                                            }
                                            rs = '../'+ rs;
                                            if( /\//.test( name ) ){
                                                name = /\/(.*)/.exec( name )[1];
                                            }

                                            $incFileHidden.val(function(){
                                                return this.value +','+ rs;
                                            });
	                                        $incFile.append('<li class="level2">' +
		                                        '<span class="button chk checkbox_true_full"></span>' +
		                                        '<input type="hidden" value="'+ rs +'"/>' +
		                                        '<a class="level2"><span class="button ico_docu"></span>' +
		                                        '<span>'+ name +'</span></a></li>');
                                        }
                                    }
                                },
                                check: {
                                    enable: true,
                                    chkStyle: 'checkbox'
                                }
                            }, data);
                        }
                    });
                    self.className += ' getList';
                }
            }
	        , cancelValue:'关闭', cancel:function(){}
        });
    });
	$incFile.on('click', 'li:gt(0)', function(){
		var $self = $cache.add(this),
			val = $self.find('input:hidden').val();

		$incFileHidden.val(function(){
			return this.value.replace(','+ val, '');
		});
		$self.fadeIn().delay(1000).remove();
	});

	/**
	 * btn 功能按钮 全屏展示运行结果
	 * */
	$fullScreenBtn.on('click', function(){
		if( !$fullScreenBtn.data('fullScreen') ){
			$body.addClass('overHidden');
			$fullScreenBtn.toggleClass('editor_fullScreenBtn icon-fullScreen icon-fullScreenClose').text('返回').data('fullScreen', true);
			$result.addClass('editor_rs-fullScreen');
		}
		else{
			$body.removeClass('overHidden');
			$fullScreenBtn.toggleClass('editor_fullScreenBtn icon-fullScreen icon-fullScreenClose').text('全屏显示').data('fullScreen', false);
			$result.removeClass('editor_rs-fullScreen');
		}
	});

    /**
     * btn 功能按钮 颜色选择器
     * */
    $('#picker').farbtastic('#color');
    $('#showColorPicker').on('click', function(){
        art.dialog({
            id:'colorPicker', title:'选择颜色', content:$('#colorPicker').get(0), follow:this,
            cancelValue:'关闭', cancel:function(){}
        });
    });

//	// 添加窗口改变大小事件
//	g.resize.add(function(){
//		var height = g.HEIGHT -332;
//
//		$('#editorContainer').height( height );
//		$codeForm.find('.editor_area, .CodeMirror').height( height );
//	});
////	g.$win.triggerHandler('resize');
//	g.win.resize.fire();
});