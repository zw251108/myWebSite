var GLOBAL = {ie:true},
    e = "abbr,article,aside,audio,canvas,datalist,details,figure,footer,header,hgroup,mark,menu,nav,output,progress,section,time,video".split(","),
    i = e.length;
while(i--){
    document.createElement(e[i]);
}
// todo 针对 CSS 提供兼容性修补
//(function($){
//})(jQuery);