MODULE_CONFIG.baseUrl = 'script';
MODULE_CONFIG.shim.layout = shim;
MODULE_CONFIG.paths.layout = 'ui/jquery.layout';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'layout'], function($, g){

/**
 * 天气模块
 * */
	var $weather = $('#weather');
//var a = {
//	"l": "二月十二"
//	, "c": "101070201"
//	, "n": "大连"
//	, "en": "dalian"
//	, "t": "3"
//	, "w": "北风 3级"
//	, "h": 49
//	, "s": "晴"
//	, "d1": {
//		"l": "0"
//		, "h": "4"
//		, "s": "晴"
//		, "w": "西北风"
//	}
//	, "d2": {
//		"l": "1",
//		"h": "6",
//		"s": "晴"
//	}
//	, "d3": {
//		"l": "2"
//		, "h": "9"
//		, "s": "晴"
//	}
//	, "w1": "西北风"
//	, "i": {
//		"cityid": "101070201"
//		, "cy": {
//			"level": null
//			, "label": "寒冷"
//			, "description": "天气寒冷，建议着厚羽绒服、毛皮大衣加厚毛衣等隆冬服装。年老体弱者尤其要注意保暖防冻。"
//		}
//		, "xc": {
//			"level": null
//			, "label": "较适宜"
//			, "description": "较适宜洗车，未来持续两天无雨，但考虑风力较大，擦洗一新的汽车会蒙上灰尘。"
//		}
//		, "uv": {
//			"level": null
//			, "label": "弱"
//			, "description": "紫外线强度较弱，建议出门前涂擦SPF在12-15之间、PA+的防晒护肤品。"
//		}
//		, "aq": {
//			"level": "67,33,85"
//			, "label": "良"
//			, "description": "除少数对某些污染物特别容易过敏的人群外，其他人群可以正常进行室外活动"
//		}
//		, "pl": {
//			"level": null
//			, "label": "优"
//			, "description": "气象条件非常有利于空气污染物稀释、扩散和清除，可在室外正常活动。"
//		}
//	}
//};
	$.ajax({
		url: 'weather/getWeather.php',
		dataType:'json',
		success: function(data){
			data = data.weatherinfo;

			var weather = data.weather1;
			if( /雪/.test( weather ) ){
				weather = 'Snow';
			}
			else if( /雷/.test( weather ) ){
				weather = 'Thunder';
			}
			else if( /雨/.test( weather ) ){
				weather = 'Rain';
			}
			else if( /云/.test( weather ) ){
				weather = 'Cloud';
			}
			else{
				weather = 'Sun';
			}

			$weather.css('background-image', 'url("image/metro/Weather-'+ weather +'.png")')
				.attr('title', data.city +' '+ data.weather1 +' '+ data.temp1 +' '+ data.wind1
					+'\n'+ data.index_d
					+'\n舒适指数：'+ data.index_co
					+'\n晨练指数：'+ data.index_cl
					+'\n晾晒指数：'+ data.index_ls
					+'\n洗车指数：'+ data.index_xc
					+'\n旅游指数：'+ data.index_tr
					+'\n感冒指数：'+ data.index_ag)
				.find('div.module_info').html( data.city +' '+ data.weather1 +' '+ data.temp1);
		}
	});

/**
 * 时间模块
 * */
    var $watch = $('#watch')
		, $hourHand
		, $minuteHand
		, $secondHand
		, setTime
		;

    if( !g.ie ){
        var prefix,
	        temp = document.createElement('div').style;

        if( '-webkit-transform' in temp ){
            prefix = '-webkit-';
        }
        else if( '-moz-transform' in temp ){
            prefix = '-moz-';
        }
        else if( '-ms-transform' in temp ){
            prefix = '-ms-';
        }
        else if( '-o-transform' in temp ){
            prefix = '-o-';
        }

        $hourHand = $watch.find('#hourHand');
        $minuteHand = $watch.find('#minuteHand');
        $secondHand = $watch.find('#secondHand');
        setTime = function(){
            var time = new Date(),
                d = time.getHours(),
                m = time.getMinutes();
            $hourHand.get(0).style[prefix +'transform'] = 'rotate('+ ((d >11 ? d -12 : d)*30 + Math.floor( m /12 )*6) +'deg)';
            $minuteHand.get(0).style[prefix +'transform'] = 'rotate('+ m *6 +'deg)';
            $secondHand.get(0).style[prefix +'transform'] = 'rotate('+ time.getSeconds()*6 +'deg)';
        };
    }
    else{
        $watch.empty().addClass('watch_wrap-info');
        setTime = function(){
            var time = new Date();

            $watch.html( time.toLocaleTimeString() );
        };
    }

    $watch.removeClass('hidden');
    setTime();
    setInterval(setTime, 1000);

//	$('.module-metro').css('height', function(){
//		return this.clientWidth;
//	});
//
//	$.layout({
//		container:'.Container'
//		, selector: '.module-metro'
//		, top: 80
//		, colSpace: 10
//		, rowSpace: 10
//	});
});