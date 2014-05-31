//---------- Express ----------
/**
 * Express
 * */
var express = require('express')
	, path = require('path')
	, url = require('url')
	, fs = require('fs')
	, logger = require('morgan')
	, cookieParser = require('cookie-parser')
	, bodyParser = require('body-parser')
	, app = express()
	, users = [{
		name: 'tj'
	}, {
		name: 'tom'
	}]
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
	, staticUrl = '//192.168.0.46/truth/'
	, headerHTML
	, footerHTML
	, index
	;

//fs.readFile('template/header.html', function(e, d){
//	headerHTML = d.toString();
//});
//fs.readFile('template/footer.html', function(e, d){
//	footerHTML = d.toString();
//});

app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded());
app.use(cookieParser());

app.get(/.*\..*$/, function(req, res){
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
app.get('/', function(req, res){
	index ? res.send( index ) : fs.readFile('template/index.html', function(e, d){
		index = d.toString();//.replace(/\{staticUrl\}/g, staticUrl);
		res.send( index );
		res.end();
	});
});



//app.get('blog/', function(req, res){
//
//});

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

app.get('*', function(req, res){
	console.log('请求'+ req.url);
	//		res.end();
});
app.listen(9001);