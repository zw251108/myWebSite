MODULE_CONFIG.shim.dialog = shim;
MODULE_CONFIG.paths.dialog = 'ui/jquery.dialog';
MODULE_CONFIG.shim.template = shim;
MODULE_CONFIG.paths.template = 'ui/jquery.template';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'template', 'dialog'], function($, g){
    var html = $.template({
            template:'article.article>a[href=detail.php?id=%Id%]>h3.article_title{%title%}' +
                '^hr+span.article_date{%datetime%}+div.tagsArea{%tags%}',
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
        $cache = $([]),
        $blogList = $('#blogList').html( html(BLOG_LIST) ).on('getArticleContent', function(e, $item){
            $.ajax({
                url: $item.attr('href'),
                content: $item,
                success:function(data){
                    if( !('error' in data) ){
                        $('<div class="article_content">'+ data.content +'</div>').hide().insertAfter( $item
                            .data('deploy', true) ).slideDown();
                    }
                    else{// 错误
                        // todo 错误提示
                    }
                }
            });
        }).on('click', 'article > a', function(e){// 获得详细内容
            var $self = $cache.add(this),
                isDeploy = $self.data('deploy');

            if( isDeploy ){// 已获取数据
                $self.next().slideToggle();
            }
            else{
                $blogList.triggerHandler('getArticleContent', [$self]);
            }

            e.preventDefault();
        });
});