//---------- Express ----------
/**
 * Express
 * */
var sys = require('util')
	, mysql = require('mysql')
	, conn = mysql.createConnection({
		host: 'localhost'
		, port: 3306
		, user: 'root'
		, password: 'zw251108'
		, database: 'coding4fun'
		, dateStrings: true	// 强制日期类型(TIMESTAMP, DATETIME, DATE)以字符串返回，而不是一javascript Date对象返回. (默认: false)
	})
	, dbErrorCallback = function(e){	// 数据库异常回调函数
		console.log('Error: '+ e.message);
	}
	, express = require('express')
	, path = require('path')
	, url = require('url')
	, fs = require('fs')
	, logger = require('morgan')
	, cookieParser = require('cookie-parser')
	, bodyParser = require('body-parser')
	, app = express()
//	, users = [{
//		name: 'tj'
//	}, {
//		name: 'tom'
//	}]
	, mime = {
		"html" : "text/html",
		"css"  : "text/css",
		"js"   : "text/javascript",
		"json" : "application/json",
		"ico"  : "image/x-icon",
		"gif"  : "image/gif",
		"jpeg" : "image/jpeg",
		"jpg"  : "image/jpeg",
		"png"  : "image/png",
		"pdf"  : "application/pdf",
		"svg"  : "image/svg+xml",
		"swf"  : "application/x-shockwave-flash",
		"tiff" : "image/tiff",
		"txt"  : "text/plain",
		"wav"  : "audio/x-wav",
		"wma"  : "audio/x-ms-wma",
		"wmv"  : "video/x-ms-wmv",
		"xml"  : "text/xml"
	}
	, STATIC_PATH = '../'
	, STYLE_HTML = ''
	, HEADER_HTML = ''
	, FOOTER_HTML = ''
	, ERROR_MSG = {
		E0001: '信息不完整'
		, E0002: ''
		, E0003: ''
		, E0004: '所访问的内容不存在'
	}

	// 页面 HTML 代码缓存
	, cache = {}
	;

fs.readFile('template/style.html', function(e, d){
	if( e ){
		console.log('读取 style 模板异常');
		return ;
	}
	STYLE_HTML = d.toString();
	console.log('读取 style 模板完成');
});
fs.readFile('template/header.html', function(e, d){
	if( e ){
		console.log('读取 header 模板异常');
		return ;
	}
	HEADER_HTML = d.toString();
	console.log('读取 header 模板完成');
});
fs.readFile('template/footer.html', function(e, d){
	if( e ){
		console.log('读取 footer 模板异常');
		return ;
	}
	FOOTER_HTML = d.toString();
	console.log('读取 footer 模板完成');
});

app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded());
app.use(cookieParser());

/**
 * 博客模块
 *  /blog/
 *  /blog/detail.php?id=:id&_=.*
 * */
app.get('/blog/', function(req, res){
	'blog' in cache ? res.send( cache.blog ) : fs.readFile('template/blog/index.html', function(e, d){
		var page = d.toString()
			.replace(/%STYLE_HTML%/, STYLE_HTML)
			.replace(/%HEADER_HTML%/, HEADER_HTML)
			.replace(/%FOOTER_HTML%/, FOOTER_HTML)
			.replace(/%STATIC_PATH%/g, STATIC_PATH)
			.replace(/%PAGE_TITLE%/, '个人小站（开发测试中...）-博客目录')
			;

		conn.query('select Id,title,datetime,tagsId,tagsName from blog order by Id desc', function(e, rs){
			if( e ){
				dbErrorCallback( e );
			}
			else{
//				console.log(rs, JSON.stringify(rs));
				page = page.replace(/%BLOG_LIST%/, JSON.stringify(rs));

				cache.blog = page;

				res.send( page );
				res.end();
			}
		});
	});
});
app.get(/\/blog\/detail\.php/, function(req, res){
	var id = req.query.id || '';

	if( id ){
		('detail/'+ id) in cache ? res.send( cache['detail/'+ id] ) :
			conn.query('select content from blog where id=?', [id], function(e, rs){
				if( e ){
					dbErrorCallback( e );
					res.send('{error: "E0004", msg:"'+ ERROR_MSG.E0004 +'"}');
				}
				else{
					res.send( JSON.stringify(rs[0]) );
				}
				res.end();
			});
	}
	else{
		res.send('{error: "E0001", msg:"'+ ERROR_MSG.E0001 +'}');
		res.end();
	}
});

/**
 * Web 前端文档
 *  /document/
 * */
app.get('/document/', function(req, res){
	'document' in cache ? res.send( cache.document ) : fs.readFile('template/document/index.html', function(e, d){
		var page = d.toString()
			.replace(/%STYLE_HTML%/, STYLE_HTML)
			.replace(/%HEADER_HTML%/, HEADER_HTML)
			.replace(/%FOOTER_HTML%/, FOOTER_HTML)
			.replace(/%STATIC_PATH%/g, STATIC_PATH)
			.replace(/%PAGE_TITLE%/, '个人小站（开发测试中...）-Web 前端文档');

		cache.blog = page;

		res.send( page );
		res.end();
	});
});

//app.all('/user/:id/:op?', function(req, res, next){
//	req.user = users[req.params.id];
//	console.log(req.user);
//	if( req.user ){
//		next();
//	}
//	else{
//		next( new Error('can not find id: '+ req.params.id ) );
//	}
//});
////app.get('/', function(req, res){
////	res.send('hello world');
////});
//app.get(/^\/(\d+)$/, function(req, res){
//	res.send( 'reg '+ req.params[0] );
//});
//app.get('/a*', function(req, res){
//	res.send('a');
//});
//app.get('/:id(b\\d+)', function(req, res){
//	if( req.params.id ){
//		res.send( req.params.id );
//	}
//	else{
//		res.send('hello world');
//	}
//});
//app.get('/user/:id', function(req, res, next){
//	var id = req.params.id;
//	if( /^\d+$/.test( id ) ){
//		res.send( 'id: '+ id );
//	}
//	else{
//		next();
//	}
//});
//app.get('/user/:name', function(req, res){
//	var name = req.params.name;
//	res.send( 'name: '+ name );
//});
//app.get('/user/:id/edit', function(req, res){
//	res.send('edit user: '+ req.user.name);
//});
//app.get('/user/:id/getData.:format((json|xml))', function(req, res){
//	res.send('{"name":"zwb"}');
//});
//app.get('*', function(req, res){
//	res.send('<form action="/" method="post">' +
//		'<input type="hidden" name="_method" value="put"/>' +
//		'<input type="text" name="name"/>' +
//		'<input type="submit" value="提交"/>' +
//		'</form>');
//});
//
//app.put('/', function(req, res){
//	res.send('welcome, '+ req.body.name);
//});

/**
 * 访问静态资源 *.*
 * */
app.get(/.*\..*$/, function(req, res){
	console.log(req.url)
	var pathname = url.parse( req.url).pathname
		, extname = path.extname( pathname )
		, type = extname.slice(1)
		;
	fs.readFile('.'+ pathname, function(e, d){
		if( e ){
			res.writeHead(404, {'Content-Type': 'text/plain'});
			res.end();
		}
		else{
			res.writeHead(200, {'Content-Type': mime[type]});
			res.write(d, 'binary');
			res.end();
		}
	});
});

/**
 * 访问主页	/
 * */
app.get('/', function(req, res){
	'index' in cache ? res.send( cache.index ) : fs.readFile('template/index.html', function(e, d){
		var page = d.toString()
				.replace(/%STYLE_HTML%/, STYLE_HTML)
				.replace(/%HEADER_HTML%/, HEADER_HTML)
				.replace(/%FOOTER_HTML%/, FOOTER_HTML)
				.replace(/%STATIC_PATH%/g, '')
				.replace(/%PAGE_TITLE%/, '个人小站（开发测试中...）')
			;

		cache.index = page;

		res.send( page );
		res.end();
	});
});

/**
 * 404
 * */
app.get('*', function(req, res){
	console.log('请求'+ req.url);
	//		res.end();
});
app.listen(9001);