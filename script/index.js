MODULE_CONFIG.baseUrl = 'script';
require.config(MODULE_CONFIG);
require(['jquery', 'global'], function($, g){

/**
 * 天气模块
 * */
	var $weather = $('#weather');

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
});