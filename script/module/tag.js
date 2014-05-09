/**
 * @module  tag 标签添加
 * @description
 *  页面中需要有 TAG_DATA 所有标签数据
 *  页面中需要有 HTML 代码：
	 <div id="Tag">
		 <input type="hidden" name="tagsId" id="tagsId"/>
		 <input type="hidden" name="tagsName" id="tagsName"/>
		 <div class="tagsArea" id="selectTags">
			 <label id="addNewTag">
				 <input type="text" class="input" id="tagName" placeholder="创建新标签" />
				 <button class="btn hidden" id="addTag" type="button" value="">添加</button>
			 </label>
		 </div>
		 <hr/>
		 <div class="tagsArea" id="allTags"></div>
	 </div>
 */
define(['jquery', 'template'], function(){
    var $cache = $([]),
        $tags = $('#Tag'),
        $tagsId = $tags.find('#tagsId'),
        $tagsName = $tags.find('#tagsName'),
        $addNewTag = $tags.find('#addNewTag'),
        tagsTmpl = $.template({
            template: 'span.tag[data-tagid=%Id%][title=%tagTips%]{%tagName%}',
            filter:{
                tagTips:function(data, i){
                    return data.tips || '';
                }
            }
        });

    $tags.on({
        reset:function(){// 重置所选择标签
            $tagsId.val('');
            $tagsName.val('');
            $tags.find('#allTags span.tag-checked').removeClass('tag-checked').end().find('#selectTags span.tag').remove();
        },
        initValue:function(e, ids, names){// 设置默认值
            var i = 0, j,
                $temp = $tags.find('#allTags');

	        ids = ids.toString().split(',');
            for(j = ids.length; i < j; i++){
                $temp.find('span.tag[data-tagid="'+ ids[i] +'"]').trigger('click');
            }
        }
    }).on('click', '#allTags span.tag', function(){// 选择标签
        var $temp = $cache.add(this),
            tagId = $temp.data('tagid'),
            tagName = $temp.html(),
            nameExpr = new RegExp('(^|,)'+ tagName +'(,|$)'),
            idExpr = new RegExp('(^|,)'+ tagId +'(,|$)');

        if( !idExpr.test($tagsId.val()) && !nameExpr.test($tagsName.val()) && !$temp.hasClass('tag-checked') ){

            $tagsId.val(function(){
                var val = this.value;
                return val? val +','+ tagId : tagId;
            });
            $tagsName.val(function(){
                var val = this.value;
                return val? val +','+ tagName : tagName;
            });
            $addNewTag.before( $temp.clone().data('target', $temp) );
            $temp.addClass('tag-checked');
        }
    }).on('click', '#selectTags span.tag', function(){// 删除已选择标签
        var $temp = $cache.add(this),
            tagId = $temp.data('tagid'),
            tagName = $temp.html(),
            nameExpr = new RegExp('(^|,)'+ tagName +'(,|$)'),
            idExpr = new RegExp('(^|,)'+ tagId +'(,|$)');

        $tagsId.val(function(){
            return this.value.replace(idExpr, ',').replace(/^,|,$/g, '');
        });
        $tagsName.val(function(){
            return this.value.replace(nameExpr, ',').replace(/^,|,$/g, '');
        });

        $temp.data('target').removeClass('tag-checked');
        $temp.remove();
    }).on({
        focus:function(){// 标签名称文本框获取焦点时显示添加标签按钮
            $cache.add(this).next().removeClass('hidden');
        },
        blur:function(){// 标签名称文本框失去焦点时隐藏添加标签按钮
            if( !this.value ){
                $cache.add(this).next().addClass('hidden');
            }
        }
    }, '#tagName').on('click', '#addTag', function(){// 点击添加标签按钮
        var $self = $cache.add(this),
            $tagName = $self.prev(),
            tagName = $tagName.val();

        if( tagName ){
            $.ajax({
                url: '../tag/addTag.php',
                type: 'post',
                data: 'tagName='+ tagName,
                success:function(data){
                    var temp;
                    if( !('error' in data) ){
                        if( 'exit' in data ){
                            $tags.find('#allTags span.tag[data-tagid="'+ data.Id +'"]').trigger('click');
                        }
                        else{
                            temp = {
                                Id: data.Id,
                                tagName: tagName,
                                tagTips: ''
                            };

                            $tagsId.val(function(){
                                var val = this.value;
                                return val? val +','+ data.Id : data.Id;
                            });
                            $tagsName.val(function(){
                                var val = this.value;
                                return val? val +','+ tagName : tagName;
                            });

                            $self.addClass('hidden');
                            $tagName.val('');
                            $( tagsTmpl([temp]).join('') ).data('target',
                                $( tagsTmpl([temp]).join('') ).appendTo( $tags.find('#allTags') ).addClass('tag-checked')
                            ).insertBefore( $addNewTag );
                        }

                        $tagName.val('').trigger('blur');
                    }
                }
            });
        }
    }).find('#allTags').html( tagsTmpl(TAG_DATA) );

	return {
		container: $tags,
		setValue: function(tagsId, tagsName){
			this.container.triggerHandler('initValue', [tagsId, tagsName]);
		},
		reset: function(){
			this.container.triggerHandler('reset');
		}
	};
});