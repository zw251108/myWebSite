/**
 * @module  global 全局设置
 *  1.  控制台输出信息
 *  2.  Ajax 全局设置
 *  3.  清空 cookie color
 *  4.  加载在线统计插件
 *  5.  唯一全局对象
 *  6.  页头页脚动画 工具条
 *  7.  加载助手插件
 */
define(['jquery', 'extend', 'clippy', 'validator'], function($){

/***** START 用户信息名片 userCard *****/
//    var $userCard = $('#userCard'),
//        $userMsg = $('#userMsg'),
//        $userMsgContent = $userMsg.find('#userMsgContent'),
//        $loginForm = null,
//        temp,
//        msgInterval = null;
//
//    $userCard.on('click.toggle', '.userCard_avatar', function(){// 点击头像展开收起事件
//        var param;
//        if( !$userCard.hasClass('userCard-max') ){// 展开
//            param = {
//                width:'290px',
//                height:'220px',
//                margin:0,
//                padding:'5px',
//                'border-width':'5px'
//            };
//
//            /**   展开动作
//             * 提示信息停止跳动
//             * */
//            msgInterval && $userMsg.dequeue().stop().css('right', '85px');
//        }
//        else{// 收起
//            param = {
//                width: '60px',
//                height: '60px',
//                margin:'10px',
//                padding:0,
//                'border-width':'0'
//            };
//
//            /**   收起动作
//             * 提示信息继续跳动，提示信息内容替换 表单重置
//             * */
//            msgInterval && msgInterval();
//            $userMsgContent.html('点我进行登录或者快速注册');
//
//            $loginForm && $loginForm.reset();
//        }
//        $userCard.toggleClass('userCard-max').stop().animate(param);
//    });
//
//    if( !USER_INFO ){// 没有用户数据
//        $.validator.validType = {
//            email:{
//                type:['required', '请填写邮箱'],
//                trim:true,
//                focus:'请填写邮箱',
//                valid:[
//                    ['email']
//                ],
//                text:['请输入合法邮箱'],
//                right:'',
//                callback:function(){// 获取邮箱的相关信息
//                    var value = this.val(),
//                        success = function(data){// 对用户信息处理
//                            var msg, btnValue;
//                            if( data ){
//                                $userCard.find('.userCard_avatar').attr('src', (g.subdir? '' : '../') + data.avatar);
//                                msg = '请填写密码登录，<a href="#" class="link" target="_blank">忘记密码</a>';
//                                btnValue = '登录';
//                            }
//                            else{
//                                msg = '该邮箱尚未注册，填写密码即可注册';
//                                btnValue = '注册';
//                            }
//                            $userMsg.addClass('tips-msg');
//                            $userMsgContent.html( msg );
//                            $loginForm.find('#btnSubmit').val( btnValue );
//
//                            this.data({
//                                validValue:value,
//                                userInfo:data
//                            });
//                        };
//
//                    // 判断是否发送 ajax
//                    if( value === this.data('validValue') ){
//                        success.call(this, this.data('userInfo'));
//                    }
//                    else{
//                        $.ajax({
//                            url:(g.subdir? '' : '../') +'user/userInfo.php',
//                            type:'GET',
//                            data:'email='+ this.val(),
//                            context:this,
//                            success:success
//                        });
//                    }
//                }
//            },
//            password:{
//                type:['required', '请填写密码'],
//                focus:'请填写密码',
//                valid:[
//                    ['length', 6, 20]
//                ],
//                text:['请输入 6-20 位密码'],
//                right:''
//            }
//        };
//
//        // 表单事件绑定
//        $loginForm = $.validator({
//            selector:'#loginForm',
//            focus:function(txt){
//                this.removeClass('input-wrong input-right').addClass('input-focus')
//                    .next().html(txt).addClass('tips-focus').removeClass('hidden tips-error tips-succ');
//            },
//            normal:function(){
//                this.removeClass('input-focus input-wrong input-right')
//                    .next().html('').addClass('hidden').removeClass('tips-focus tips-error tips-succ');
////                $userMsg.removeClass('tips-msg tips-warming');
//            },
//            wrong:function(txt){
//                this.removeClass('input-focus input-right').addClass('input-wrong')
//                    .next().html(txt).addClass('tips-error').removeClass('hidden tips-focus tips-succ');
////                $userMsg.removeClass('tips-msg').addClass('tips-warming');
////                $userMsgContent.html(txt);
//            },
//            right:function(){
//                this.removeClass('input-focus input-wrong').addClass('input-right')
//                    .next().html('').addClass('tips-succ').removeClass('hidden tips-focus tips-error')
//                    .delay(3000).fadeOut();
////                $userMsg.removeClass('tips-msg tips-warming');
//            }
//        }).on('submit', function(e){// 提交表单
//            var $btnSubmit = $loginForm.find('#btnSubmit').attr('disabled', 'disabled');
//
//            $.ajax({
//                url: this.action,
//                type:'POST',
//                data:$loginForm.serialize(),
//                success:function(data){
//                    var msg,
//                        userInfo;
//                    if( !('error' in data) ){// 没有错误
//
//                        if( data.state === 'login' ){
//                            msg = '您已经登录';
//
//                            userInfo = $loginForm.find('#email').data('userInfo');
//                            temp = [];
//                            temp.push('<span class="userCard_name">');
//                            temp.push( userInfo.username );
//                            temp.push('</span><p class="userCard_description">');
//                            temp.push( userInfo.description );
//                            temp.push('</p>');
//
//                            $userCard.append( temp.join('') );
//                        }
//                        else if( data.state === 'register' ){
//                            msg = '恭喜您注册成功，赶快去<a href="#" class="link">完善资料</a>';
//                        }
//
//                        /**   登录或注册成功
//                         * 修改提示信息 提示信息3秒后小时 删除表单 显示用户信息 解绑切换登录提示信息事件
//                         * */
//                        $userMsgContent.html( msg );
//                        $userMsg.delay(3000).fadeOut();
//                        $userCard.off('click.loginMsg');
//                        $loginForm.remove();
//                    }
//                    else{
//                        $userMsgContent.html( data.msg );
//                        $userMsg.removeClass('tips-msg').addClass('tips-warming');
//                        $btnSubmit.removeAttr('disabled', 'disabled');
//                    }
//                }
//            });
//
//            e.preventDefault();
//        });
//
//        $userCard.on('click.loginMsg', '.userCard_avatar', function(){// 切换提示文字
//            $userMsgContent.html( !$userCard.hasClass('userCard-max')? '点我进行登录或者快速注册' :
//                '直接输入邮箱和密码即可完成注册');
//        });
//        $userMsgContent.html('点我进行登录或者快速注册');
//
//        // 提示信息循环跳动
//        $userMsg.queue();
//        msgInterval = function(){
//            $userMsg.animate({
//                right:'+=10px'
//            }).animate({
//                right:'-=10px'
//            }, msgInterval);
//        };
//        $userMsg.fadeIn(msgInterval);
//    }
//    else{
//        temp = [];
//        temp.push('<span class="userCard_name">', USER_INFO.username, '</span><p class="userCard_description">',
//            USER_INFO.description, '</p>');
//
//        $userCard
//            .find('#loginForm').remove()
//        .end().append( temp.join('') )
//            .find('.userCard_avatar').attr('src', (g.subdir? '' : '../') + USER_INFO.avatar);
//    }
//
//    g.user = $userCard;// 添加到全局
/** END **/

/***** START 全局设置 *****/
	// 兼容 console
	if( !('console' in window) || !('log' in console) || (typeof console.log !== 'function') ){
		window.console = {
			logStack:[],
			log:function(value){
				this.logStack.push(value);
			}
		}
	}
	else{
		// 自娱自乐。。。
		console.log(
			'      __    __   __ __ __   __         __         __ __ __\n'  +
			'    /  /  /  / /   __ __/ /  /       /  /       /   __   /\n'  +
			'   /  /__/  / /  /__     /  /       /  /       /  /  /  /\n'   +
			'  /   __   / /   __/    /  /       /  /       /  /  /  /\n'    +
			' /  /  /  / /  /__ __  /  /__ __  /  /__ __  /  /__/  /\n'     +
			'/__/  /__/ /__ __ __/ /__ __ __/ /__ __ __/ /__ __ __/\n'      +
			'\n\n 有什么疑问吗？直接给我留言吧 :)');
	}

	/**
	 * ajax 全局设置
	 * */
	$.ajaxSetup({
		dataType:'json',    // 数据交换类型 json
		cache:false,    // 取消缓存
		xhr:function(){ // 解决IE7 ajax XMLHttpRequest对象问题
			return window.XMLHttpRequest?
				new XMLHttpRequest():
				window.ActiveXObject?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest();
		},
		error:function(xhr, textStatus, errorThrown){   // 统一错误处理函数
		}
	});

	/**
	 * 检测 Cookie 若存在则设置为过期
	 * */
	var color = $.cookie('color');
	if( color ){
		$.cookie('color', color, -1, '/');
	}

	/**
	 *  todo 发布时 取消注释
	 * 第三方脚本 统计访问量
	 * */
//    $.scriptLoader('//s95.cnzz.com/stat.php?id=5338533', '#statistics');
////    $.scriptLoader('//hm.baidu.com/hm.js?43d9fdfb3acde34b080704dfe509db66', 'head');

	/**
	 *  定义全局变量
	 * */
	var g =  window.GLOBAL || {},

		scroll = $.Callbacks(),
		resize = $.Callbacks(),
		doc = document.documentElement;

	g.doc = doc;
	g.body = document.body;


	resize.add(function(){
		g.WIDTH = doc.clientWidth;
		g.HEIGHT = doc.clientHeight;
	});
	// 设置屏幕宽高
	resize.fire();

	g.scroll = scroll;
	g.resize = resize;
	g.$win = $(window).on({
		resize: function(){
			g.resize.fire();
		},
		scroll: function(){
			g.scroll.fire();
		}
	});

	/**
	 *  todo 发布时 改为下边注释的部分
	 * */
	// 是否为子目录
	g.subdir = (location.pathname === '/truth/');
//    g.subdir = location.pathname === '/';

	window.GLOBAL = g;// 释放到全局
/***** END *****/

/***** START 工具条 todo *****/
	// 延迟 将 header 隐藏
//    setTimeout(function(){
//        $('body').animate({
//            'paddingTop': 0
//        }).find('header').animate({
//            height: 0
//        }).find('.module-header').addClass('hidden');
//    }, 1800);

	var $tools = $('#header')
		, $backTop = $tools.find('#backTop')
		, $menu = $tools.find('#menu')
		, $headerMenu = $tools.find('#headerMenu')
		;
	g.scroll.add(function(){
		if( $backTop.is(':hidden') && (g.body.scrollTop || g.doc.scrollTop) > 0 ){
			$backTop.stop().fadeIn();
		}
		else if( (g.body.scrollTop || g.doc.scrollTop) === 0 ){
			$backTop.stop().fadeOut();
		}
	});

	// 工具条
	$backTop.on('click', function(){
		$('body').animate({
			scrollTop: 0
		}, 'slow');
	});
	$menu.on('click', function(){
		$headerMenu.stop().slideToggle();
	});
/***** END *****/

/***** START 助手插件 *****/
	var helper = clippy,
		$helper,
		$temp = $([]);

	helper.BASE_PATH = (g.subdir? '' : '../') +'script/plugin/clippy/';
	helper.load('Links', function(agent){
		agent.show();
		agent.play('Greeting');
		agent.animations();

		$helper = $('#clippy-content').data('agent', agent).on({
			speak:function(e, word){
				var agent = $helper.data('agent');
				agent.stop();
				agent.speak(word);
			},
			play:function(e, act){
				$helper.data('agent').play(act);
			}
		}).on('click', '#reBack', function(){
				$helper.triggerHandler('speak', ['Hi，欢迎光临，<br/>您可以<ul>'+
					'<li>给博主 <a id="leftMsg" class="link" href="javascript:;">留言</a></li>'+
					'<li>跟我 <a id="chat" class="link" href="javascript:;">聊天</a></li>'+
					'<li>需要 <a id="moreHelp" class="link" href="javascript:;">帮助</a></li></ul>']);
			}).on('click', '#leftMsg', function(){
				$helper.triggerHandler('speak', ['<form id="msgForm" action="'+ (g.subdir? '' : '../') +
					'message/saveMsg.php"><input type="text" id="from" class="" name="from" placeholder="您的邮箱" />' +
					'<textarea id="content" class="" name="content" placeholder="说点什么呢"></textarea>' +
					'<input type="submit" value="提交" /></form>']);
			}).on('submit', '#msgForm', function(e){
				e.preventDefault();

				var $form = $temp.add(this);
				$.ajax({
					url: this.action,
					data: $form.serialize(),
					dataType: 'json',
					before:function(){
						$form.find(':submit').attr('disabled', 'disabled');
					},
					success:function(data){
						var speak, play;
						if( !('error' in data) ){
							speak = '您的信息已保存，继续<a id="leftMsg" class="link" href="javascript:;">留言</a>？，' +
								'<a id="reBack" class="link" href="javascript:;">返回列表</a>';
							play = 'SendMail';
						}
						else{
							speak = '系统貌似有点小状况，您稍后<a id="leftMsg" class="link" href="javascript:;">再试一下</a>吧！'+
								'<a id="reBack" class="link" href="javascript:;">返回列表</a>';
							play = 'Wave';
						}
						$helper.triggerHandler('speak', [speak]);
						$helper.triggerHandler('play', [play]);
					}
				});
			}).on('click.moreHelp', '#moreHelp', function(){
				$helper.triggerHandler('speak', ['需要哪方面的帮助，请告诉我：<br />' +
					'<form id="helpKeyword"><input type="text" id="helpKeyword" />' +
					'<input type="submit" value="查询" /></form>']);
				$helper.triggerHandler('play', ['CheckingSomething']);
			}).on('submit.submitKeyword', 'form#helpKeyword', function(e){
				e.preventDefault();

				$helper.triggerHandler('speak', ['谢谢你的参与，但是我没有说帮你解决啊。。。'+
					'<a id="moreHelp" class="link" href="#">更多帮助</a>，'+
					'<a id="reBack" class="link" href="javascript:;">返回列表</a>']);
				$helper.triggerHandler('Searching');
			}).on('click.chat', '#chat', function(){
				$helper.triggerHandler('speak', ['天气真好啊！<br /><form id="chatForm"><textarea id="chatContent">'+
					'</textarea><input type="submit" value="发送" /></form>']);
				$helper.triggerHandler('EmptyTrash');
			}).on('submit.chat', 'form#chatForm', function(e){
				e.preventDefault();

				$helper.triggerHandler('speak', ['其实你说什么我一点也不关心。。。'+
					'<a id="chat" class="link" href="#">继续聊吧</a>，'+
					'<a id="reBack" class="link" href="javascript:;">返回列表</a>']);
				$helper.triggerHandler('play', ['Pleased']);
			});

		$helper.triggerHandler('speak', ['Hi，欢迎光临，<br/>您可以<ul>'+
			'<li>给博主 <a id="leftMsg" class="link" href="javascript:;">留言</a></li>'+
			'<li>跟我 <a id="chat" class="link" href="javascript:;">聊天</a></li>'+
			'<li>需要 <a id="moreHelp" class="link" href="javascript:;">帮助</a></li></ul>']);

		g.helper = $helper;// 添加到全局
	});
/***** END *****/

	return g;
});