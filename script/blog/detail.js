require.config(MODULE_CONFIG);
require(['jquery', 'global'], function($, g){
    var temp = BLOG_DETAIL.tags || '';

    if(temp){
        temp = '<span class="tag">' +
            temp.split(',').join('</span><span class="tag">') + '</span>';
    }

    $('#articleTags').html(temp);
});