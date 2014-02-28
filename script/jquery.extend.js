/**
 *  基于 jQuery 的库函数扩展
 */
(function($, dom, exports){
    /**
     *  GUID（全局统一标识 Globally Unique Identifier）生成器
     * */
    $._guid = function(){
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c){
            var r = Math.random()*16|0, v = c==='x'? r : (r&0x3|0x8);
            return v.toString(16);
        }).toUpperCase();
    };

    /**
     *  检测 HTML5 支持情况
     * */
    $.html5 = {
        /**
         *  检测浏览器是否支持canvas,是否支持画布文本
         * */
        canvas:function(){
            var result = null;
            var canvas = dom.createElement('canvas');
            if( canvas.getContext ){
                result = {};
                var temp = canvas.getContext('2d');
                result.text = 'fillText' in temp;
            }
            return result;
        },
        /**
         *  检测浏览器是否支持audio,支持的格式
         * */
        audio:function(){
            var result = null;
            var audio = dom.createElement('audio');
            if( audio.canPlayType ){
                result = {};
                result.mp3 = audio.canPlayType('audio/mpeg;') !== 'no';
                result.vorbis = audio.canPlayType('audio/opgg;codecs="vorbis"') !== 'no';
                result.wav = audio.canPlayType('audio/wav;codecs="1"') !== 'no';
                result.aac = audio.canPlayType('audio/mp4;codecs="mp4a.40.2"') !== 'no';
            }
            return result;
        },
        /**
         *  检测浏览器是否支持video,支持的格式
         */
        video:function(){
            var result = null;
            var video = dom.createElement('video');
            if( video.canPlayType ){
                result = {};
                result.track = 'track' in dom.createElement('track');
                result.h264 = !!video.canPlayType('video/mp4;codecs="avc1.42E01E,mp44a.40.2"');
                result.ogg = !!video.canPlayType('video/ogg;codecs="theora,vorbis"');
                result.webM = !!video.canPlayType('video/webm;codecs="vp8,vorbis"');
            }
            return result;
        },
        /**
         *  检测浏览器是否支持本地存储
         * */
        localStorage:function(){
            return ('localStorage' in exports) && exports['localStorage'] !== null;
        },
        /**
         *  检测浏览器是否支持Web Workers
         * */
        webWorkers:function(){
            return 'Worker' in exports;
        },
        /**
         *  检测浏览器是否支持离线Web应用
         * */
        offLine:function(){
            return 'applicationCache' in exports;
        },
        postMessage:function(){
            return 'postMessage' in exports;
        },
        /**
         *  检测浏览器是否支持Web Socket
         * */
        webSocket:function(){
            return 'WebSocket' in exports;
        },
        /**
         *  检测浏览器是否支持地理位置特性
         * */
        geolocation:function(){
            return 'geolocation' in navigator;
        },
        /**
         *  检测浏览器是否支持微数据
         * */
        microdata:function(){
            return !!dom.getItems;
        },
        /**
         *  检测浏览器是否支持文件API
         * */
        fillReader:function(){
            return 'FileReader' in exports;
        },
        /**
         *  检测浏览器是否支持历史API
         * */
        history:function(){
            return !!(exports.history && exports.history.pushState && exports.history.popState);
        },
        /**
         *  检测浏览器是否支持Server-sent事件
         * */
        eventSource:function(){
            return 'EventSource' in exports;
        },
        /**
         *  检测浏览器是否支持会话存储(Session storage)
         * */
        sessionStorage:function(){
            return ('sessionStorage' in exports) && exports['sessionStorage'] !== null;
        },
        /**
         *  检测浏览器对input新属性支持情况
         * */
        input:function(){
            var result = {};
            var input = dom.createElement('input');
            result.placeholder = 'placeholder' in input;
            result.autofocus = 'autofocus' in input;
            var newType = ['search', 'number', 'range', 'color', 'tel', 'url', 'email', 'date', 'month', 'week', 'time', 'datetime', 'datetime-local'];
            var i=newType.length, temp;
            while(i--){
                temp = newType[i];
                input.setAttribute('type', temp);
                result[temp] = input.type !== 'text';
                input.setAttribute('type', 'text');
            }
            return result;
        },
        command:function(){
            return 'type' in dom.createElement('command');
        },
        datalist:function(){
            return 'options' in dom.createElement('datalist');
        },
        details:function(){
            return 'open' in dom.createElement('details');
        },
        device:function(){
            return 'type' in dom.createElement('device');
        },
        noValidate:function(){
            return 'noValidate' in dom.createElement('form');
        },
        iframe:function(){
            var result = {};
            var iframe = dom.createElement('iframe');
            result.sandbox = 'sandbox' in iframe;
            result.srcdoc = 'srcdoc' in iframe;
            return result;
        },
        metar:function(){
            return 'value' in dom.createElement('metar');
        },
        output:function(){
            return 'value' in dom.createElement('output');
        },
        progress:function(){
            return 'value' in domcument.createElement('progress');
        },
        time:function(){
            return 'valueAsDate' in dom.createElement('time')
        },
        contentEditable:function(){
            return 'isContentEditable' in dom.createElement('span');
        },
        draggable:function(){//检测浏览器是否支持拖拽
            return 'draggable' in dom.createElement('span');
        },
        svg:function(){
            return !!(dom.createElementNS && dom.createElementNS('http://www.w3.org/2000/svg', 'svg', 'svg').createSVGRect);
        },
        svgInHtml:function(){
            var e = dom.createElement('div');
            e.innerHTML = '<svg></svg>';
            return !!(exports.SVGSVGElement && e.firstChild instanceof exports.SVGSVGElement);
        },
        webSimpleDB:function(){
            return 'indexedDb' in exports;
        },
        webSQLDatabase:function(){
            return  'openDatabase' in exports;
        },
        notifications:function(){
            return 'webkitNotifications' in exports;
        }
    };
    /**
     *  HTML5 兼容方法
     *  文本框 文本域默认显示文字
     */
    $.placeholder = function(selector){
        selector = (typeof selector === 'object' && selector.jQuery) ? selector : $(selector);
        var isPwd = selector.is(':password');
        selector.on({
            focus:function(){},
            blur:function(){}
        })
    };
    $.autofocus = function(){

    };

    $.unit = {};
    $.datetime = {
        month:[
            ['january', 'jan', '一', 31, 'capricorn', '摩羯', 19],
            ['february', 'feb', '二', 28, 'aquarius', '水瓶', 18],
            ['march', 'mar', '三', 31, 'pisces', '双鱼', 20],
            ['april', 'apr', '四', 30, 'aries', '牡羊', 20],
            ['may', 'may', '五', 31, 'taurus', '金牛', 20],
            ['june', 'jun', '六', 30, 'gemini', '双子', 21],
            ['july', 'jul', '七', 31, 'cancer', '巨蟹', 22],
            ['august', 'aug', '八', 31, 'leo', '狮子', 22],
            ['september', 'sep', '九', 30, 'virgo', '处女', 22],
            ['october', 'oct', '十', 31, 'libra', '天秤', 22],
            ['november', 'nov', '十一', 30, 'scorpio', '天蝎', 21],
            ['december', 'dec', '十二', 31, 'sagittarius', '射手', 21]
        ],
        week:[
            ['sunday', 'sun', '日'],
            ['monday', 'mon', '一'],
            ['tuesday', 'tue', '二'],
            ['wednesday', 'wed', '三'],
            ['thursday', 'thu', '四'],
            ['friday', 'fri', '五'],
            ['saturday', 'sat', '六']
        ],
        /**
         *  判断是否为闰年
         * */
        isLeapYear:function(y){
            y = Number(y);
            return (y%4===0 && y%100!==0) || y%400===0;
        },
        /**
         *  将 Date 对象或时间戳输出为 yyyy-mm-dd hh:ii:ss 格式
         * */
        dateFormat:function(date){
            var rs = '', type = typeof date;
            if( (type === 'string' || type === 'number') && /\d{13}/.test(date) ){
                date = new Date( Number(date) );
            }
            if( type === 'object' && date instanceof Date ){
                date.toLocaleString()
                    .replace(/年|月/g,"-")
                    .replace(/日/g,"")
                    .replace(/(\-)(\d(?!\d))/g, '$10$2');
            }
            return rs;
        }
    };
    $.number = {
        /**
         *  数字补位填零
         * */
        fillZero:function(str, length){
            str = typeof str === 'string' ? str : ''+str;
            if( str.length >= length ){
                return str;
            }
            else{
                var temp = '';
                for(var i=length-str.length; i>0; i--){
                    temp += '0';
                }
                return temp + str;
            }
        }
    };

    $.pageConfig = {
        first:['首页'],
        last:['尾页'],
        next:['下一页', 'next'],
        prev:['上一页', 'last']
    };

    /**
     *  设置cookie
     *      cookieName  cookie变量名
     *      value       cookie值
     *      millisecond cookie过期时间(可以设置为负数来使cookie过期)
     *      path        cookie有效路径
     * */
    $.cookie = function(cookieName, value, millisecond, path){
        var argc = arguments.length, result = null;
        if( argc === 0 ){//0个参数，返回null
            result = null;
        }
        else if( argc === 1 ){//1个参数为 获取cookie变量
            var patt = new RegExp(cookieName+'=(.+);?');
            result = patt.exec( document.cookie.toString() );
            if( result ){
                result = result[1];
            }
            else result = null;
        }
        else{//2个或2个以上参数 设置cookie变量
            var cookie = cookieName + '=' + value ;
            if( millisecond ){
                var date = new Date();
                date.setTime( date.getTime() + millisecond );
                cookie = cookie + ';expires=' + date.toGMTString();
            }
            if( path ){
                cookie = cookie + ';path=' + path;
            }
            document.cookie = cookie;
        }
        return result;
    };

    /**
     *  获取get请求中的各个参数
     * */
    $.getParam = function(){
        var obj = location.search.slice(1).split(/&|=/);
        var param = {};
        for(var i= 0, j=obj.length; i<j; i++){
            param[obj[i++]] = obj[i];
        }
        return param;
    };

    /**
     *  加载第三方接口
     * */
    $.scriptLoader = function(url, obj){
        $('<script></script>', {
            async:'async',
            src:url
        }).appendTo(obj || 'body');
    };

    $.blinkTitle = function(){
        var currTitle = dom.title,
            timer = null;

        return {
            start:function(title, timeout){
                title = title || '';

                this.stop();
                timer = setInterval(function(){
                    dom.title = dom.title === currTitle ? title : currTitle;
                }, timeout || 600);
            },
            stop:function(){
                if( timer ){
                    dom.title = currTitle;
                    clearInterval( timer );
                    timer = null;
                }
            }
        };
    };

    /**
     *  UI 库函数扩展
     * */
    $.fn.extend({
        isShow:function(){
            var temp = this.css('display');
            return (temp!=='none'||temp!=='hidden');
        },
        isHide:function(){
            var temp = this.css('display');
            return (temp==='none'||temp==='hidden');
        },
//        slideLeft:function(time, callback){
//            this.css('position', 'absolute');
//
//        },
//        slideRight:function(time, callback){
//
//        },
        selfHTML:function(){return this.map(function(){return this.outerHTML;}).get().join('');}
    });
})(jQuery, document, window);