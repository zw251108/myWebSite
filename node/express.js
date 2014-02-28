//---------- 使用 Express 开发 Web 应用 ----------

/**
* Web 服务器
*
* Express 增加了两样 http 模块所没有的功能：
*  根据 HTTP 请求的不同方法进行过滤
*  根据特定的 URL 进行过滤
*/
var express = require('express')
	, partials = require('express-partials')    // 模板
	, http = require('http')
	, path = require('path')
	, app = express()
	, tweets = []
	;

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
app.use(partials());

// 中间件 错误处理
app.use(function(err, req, res, next){
	console.error(err.stack);
	res.send(500, 'Something broke');
});
//app.use(express.bodyParser());  // express.bodyParset() 中间件，把 POST 数据转换成 JavaScript 对象

//app.use(express.json);
app.use(express.urlencoded());

app.use(express.methodOverride());
app.use(express.cookieParser('cookie'));
app.use(express.session());
app.use(app.router);

console.log(__dirname, path.join(__dirname, 'views'));

// 为匹配第一个参数所指定 URL 的 get 请求指定回调函数
app.get('/', function(req, res){
	res.render('index', {
		locals: {
			layout: 'index',
			title: 'hi',
			header: 'welcome',
			tweets: tweets,
			style: '//192.168.0.46/truth/style/style.css'
		}
	});

//	res.send('welcome');
});

app.get('/tweets', function(req, res){
	res.send( tweets );
});

function acceptsHtml(header){
	var accepts = header.split(',')
		, i = 0
		, j = accepts.length
		;
	for(; i < j; i++){
		if( accepts[i] === 'text/html' ){
			return true;
		}
	}
	return false;
}
app.post('/send/:a', function(req, res){
	var msg = {
		status: 'ok'
	};

	console.log(req.params, req.param, req.param('tweet'), req.body, req.query);
	if( req.body && req.body.tweet ){
		tweets.push( req.body.tweet );

		msg.message = 'tweet received';

//		if( acceptsHtml(req.headers['accept']) ){
//			res.redirect('/', 302);
//			return;
//		}
	}
	else{
		msg.message = 'no tweet received';
	}

	res.send( msg );
});


app.listen(3000);