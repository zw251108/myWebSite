//---------- node 测试代码 ----------
/**
 *  创建 TCP 服务器
 * */
//var net = require('net')
//	, chatServer = net.createServer()
//	, clientList = []
//	;
//
//function broadcast(message, client){
//	var temp
//		, i = 0
//		, j = clientList.length
//		, cleanup = []
//		;
//	for(; i < j; i++){
//		temp = clientList[i];
//		if( client !== temp ){
//			// 检查 socket 的可写状态
//			if( temp.writable ){
//				temp.write(client.name +' says: '+ message);
//			}
//			else{
//				cleanup.push(i);
////				cleanup.push(temp);
////				temp.destroy();
//			}
//		}
//	}
//
//	// 删除死节点，消除垃圾索引
//	for(i = 0, j = cleanup.length; i < j; i++){
//		temp = cleanup[i];
//
//		clientList[temp].destroy();
////		clientList.splice(clientList.indexOf(cleanup[i]), 1);
//		clientList.splice(temp, 1);
//	}
//}
//
//chatServer.on('connection', function(client){
//	// 添加名称
//	client.name = client.remoteAddress +':'+ client.remotePort;
//
//	client.write('hi,'+ client.name +'\n');
//
//	clientList.push( client );
//
//	// client 发送数据是触发
//	client.on('data', function(data){
//		console.log(data);
//
//		// 每个客户端都接受信息
////		for(var i = 0, j = client.length; i < j; i++){
////			clientList[i].write(data);
////		}
//
//		broadcast(data, client);
//	});
//
//	// 记录错误
//	client.on('error', function(e){
//		console.log(e);
//	});
//
//	// 端口连接时将 client 从 clientList 中删除
//	client.on('end', function(){
//		clientList.splice(clientList.indexOf(client), 1);
//	});
//
//	// 关闭连接
////	client.end();
//});
//chatServer.listen(9000);

//---------- 使用集群来分发任务 ----------
/**
 * 创建子线程
 * */
//var cluster = require('cluster')
//	, http = require('http')
//	, numCPUs = require('os').cups().length
//	, i = 0
//	, worker
//	, workers = {}
//	, rssWarn = (50 * 1024 * 1024)
//	, heapWarn = (50 * 1024 * 1024)
//	;
//
//function createWorker(){
//	var worker = cluster.fork()
//		;
//	console.log('created worker '+ worker.pid);
//
//	workers[worker.pid] = {
//		worker: worker,
//		lastCb: new Date().getTime -1000
//	};
//
//	worker.on('message', function(m){
//		if(m.cmd === 'reportMem' ){
//			workers[m.process].lastCb = new Date().getTime();
//			if( m.memory.rss > rssWarn ){
//				console.log('worker '+ m.process +' using too mush memory');
//			}
//		}
//	});
//}
//
//if( cluster.isMaster ){
//	// 创建子进程
//	for(; i < numCPUs; i++){
////		worker = cluster.fork();
////
////		worker.on('message', function(m){
////			if( m.memory ){
////				if( m.memory.rss > rssWarn ){
////					console.log('Worker '+ m.process +' using too mush memory');
////				}
////			}
////		});
//		createWorker();
//	}
//
//	setInterval(function(){
//		var time = new Date().getTime()
//			, pid
//			;
//		for( pid in workers ) if( workers.hasOwnProperty(pid) && workers[pid].lastCb + 5000 < time ){
//			console.log('long running worker '+ pid +' killed');
//			workers[pid].worker.kill();
//			delete workers[pid];
//
//			createWorker();
//		}
//	}, 1000);
//
////	cluster.on('death', function(worker){
////		console.log('worker '+ worker.pid +' died');
////		cluster.fork();
////	});
//}
//else{
//	// 工作进程创建 http 服务器
//	http.Server(function(req, res){
//		res.writeHead(200);
//		res.end('hello world\n');
//	}).listen(8001);
//
//	setInterval(function(){
//		process.send({
//			memory: process.memoryUsage(),
//			process: process.pid
//		});
//	})
//}

//---------- 事件接口 ----------
/**
 * 事件绑定、触发
 * */
//var utils = require('util')
//	, EventEmitter = require('events').EventEmitter
//	, Server = function(){
//			console.log('init');
//		}
//	;
//
//// 将 EventEmitter 类方法添加到 Server 类中
//utils.inherits(Server, EventEmitter);
//
//var s = new Server();
//
//s.on('abc', function(a, b, c){
//	console.log('abc', a, b, c);
//});
//
//setTimeout(function(){
//	s.emit('abc', 1, 2, 3);
//}, 2000);

//---------- HTTP 服务器 ----------
/**
 * nodeJS HTTP 服务器
 */
//var http = require('http')
//	;
//
//http.createServer(function(req, res){
//	res.writeHead(200, {
//		'Content-Type': 'text/plain'
//	});
//	res.end('Hello World');
//}).listen(8124, '127.0.0.1');
//console.log('Server running at http://127.0.0.1:8124/');
//
//var opts = {
//		host: '127.0.0.1',
//		port: 8123,
//		path: '/'
//	}
//	, req = http.get(opts, function(res){
//		console.log('never get called');
//	})
//	;
//req.on('error', function(e){
//	console.log('error');
//});
//
//var server = http.createServer()
//	, handleReq = function(req, res){
//		res.writeHead(200, {});
//		res.end('hello');
//	}
//	;
//server.on('request', handleReq);
//server.listen(8125);

//---------- HTTP 客户端 ----------
/**
 * HTTP GET 请求
 * */
//var http = require('http')
//	, req = http.get({
//			host: 'www.google.com'
//			, port: 80
//			, path: '/'
//		}, function(res){
//			console.log(res);
//
//			res.setEncoding('utf8');
//			res.on('data', function(c){
//				console.log(c);
//			});
//		})
///**
// * HTTP POST 请求
// * */
//	, post = http.request({
//			host: 'www.google.com'
//			, port: 80
//			, path: '/submit'
//			, method: 'POST'
//		}, function(res){
//			res.setEncoding('utf8');
//			res.on('data', function(chunk){
//				console.log( chunk );
//			})
//		})
//	;
//post.write('data');
//post.end();

//---------- URL ----------
//var url = require('url')
//	, myUrl = 'http://zw150026.com/blog/detail.php?id=14&type=1'
//	, parsedUrl = url.parse( myUrl, true )
//	;
//console.log(parsedUrl);

//---------- querystring ----------
//var qs = require('querystring')
//	, myObj = qs.parse('a=1&b=2&c=d')
//	, myQuery = qs.encode( myObj )
//	;
//console.log( myObj, myQuery );

//---------- I/O ----------
/**
 * 文件流
 * */
//var fs = require('fs')
//	, fileHandle = fs.readFile('test.js', function(e, d){
//		console.log( d.toString() );
//
////		fs.unlink('test.js');   // 删除文件
//	})
//	;

//---------- Buffer ----------
//var a = new Buffer(5)
//	;
//console.log( a, a.toString() );
//console.log( a.write('fff'), a, a.toString() );

//---------- DNS ----------
/**
 * DNS 查询域名 IP 地址
 * */
//var dns = require('dns')
//	;
//dns.resolve('zw150026.com', 'A', function(e, r){
//	console.log('A');
//	if( e ){
//		console.log(e);
//	}
//	console.log(r);
//});
//dns.resolve('zw150026.com', 'MX', function(e, r){
//	console.log('MX');
//	if( e ){
//		console.log(e);
//	}
//	console.log(r);
//});
//dns.resolveMx('zw150026.com', function(e, r){
//	console.log('resolveMx');
//	if( e ){
//		console.log(e);
//	}
//	console.log(r);
//});
//dns.lookup('zw150026.com', 4, function(e, a){
//	console.log('lookup', a);
//});

//---------- 加密 ----------
/**
 *
 * */
//var crypto = require('crypto')
//	, md5 = crypto.createHash('md5')
//	, sha1 = crypto.createHash('sha1')
//	, pem = 'bar'
//	, hmac = crypto.createHmac('sha1', pem)
//	, cipher = crypto.createCipher('blowfish', pem)
//	, decipher = crypto.createDecipher('blowfish', pem)
//	, sign = crypto.createSign('RSA-SHA256')
//	, sgn
//	, verify = crypto.createVerify('RSA-SHA256')
//	, code= ''
//	, decode = ''
//	;
//md5.update('foo');
//console.log( md5.digest() );    // 一旦调用 digest() Hash 对象就已经最终确定，不能被重用
//md5 = crypto.createHash('md5');
//md5.update('foo');
//console.log( md5.digest('hex') );
//
//sha1.update('foo');
//console.log( sha1.digest() );
//sha1 = crypto.createHash('sha1');
//sha1.update('foo');
//console.log( sha1.digest('hex') );
//
//hmac.update('foo');
//console.log( hmac.digest('hex') );
//
//// 公钥加密
//code += cipher.update(new Buffer('abcd'), 'binary', 'hex');
//console.log( code );
//code += cipher.update(new Buffer('0123456789'), 'binary', 'hex');
//console.log( code );
//code += cipher.update(new Buffer('efgh'), 'binary', 'hex');
//console.log( code );
//code += cipher.final('hex');
//console.log( code );
//
//// 公钥解密
//decode += decipher.update(code, 'hex', 'ascii');
//decode += decipher.final('ascii');
//console.log( decode );
//
//// 签名
//sign.update('abcdef');
//sgn = sign.sign(pem, 'hex');
////console.log(1,  );
//
//// 验证签名
//verify.update('abcdef');
//console.log( verify.verify('bar', sgn, 'hex') );

//---------- process 模块 ----------
/**
 *
 * */
//process.on('exit', function(){  // Node 进程退出事件
//	console.log(123);
//});
//process.on('uncaughtException', function(e){    // 捕获异常
//	console.log('exception: '+ e);
//});
//
//b();    // 异常测试
//
//process.stdin.resume(); // 开始从标准输入读取内容，所以程序不会退出
//process.stdin.setEncoding('utf8');
//process.on('SIGINT', function(){
//	console.log('got sigint,press ctrl+d to exit');
//});
//process.stdin.on('data', function( chunk ){
//	process.stdout.write('data: '+ chunk);
//});
//process.stdin.on('end', function(){
//	process.stdout.write('end');
//});
//
//process.nextTick(function(){
//	console.log(111);
//});
//process.nextTick(function(){
////	b();
//	console.log(112);
//});
//process.nextTick(function(){
//	console.log(113);
//});
//
////console.log(process);
//console.log(process.version, process.installPrefix,
//	process.platform, process.title, process.pid, process.execPath);

/**
 * 子进程
 * */
//var cp = require('child_process')
//	, cat = cp.spawn('cat')
//	, child = cp.spawn('cat', [], {customFds: [0, 1, 2]})
//	;
//cp.exec('ls -l', function(e, stdout, stderr){
//	if( !e ){
//		console.log( typeof stdout );
//		console.log( stdout );
//		console.log( stdout );
//	}
//});
//cp.exec('ls', {maxBuffer: 1}, function(e, stdout, stderr){
//	console.log(e, stderr);
//});
//cp.exec('for i in {1..100000};do echo $i;done', {
//	timeout: 500,
//	killSignal: 'SIGKILL'
//}, function(e, stdout, stderr){
//	console.log(e);
//});
//cat.stdout.on('data', function(d){
//	console.log( d.toString() );
//});
//cat.on('exit', function(){
//	console.log('kthxbai');
//});
//cat.stdin.write('meow');
//cat.stdin.end();

//---------- assert ----------
/**
 *
 * */
//var assert = require('assert')
//	;
//assert.equal(1, true, 'Truthy');
//assert.notEqual(1, true, 'Truthy');
//assert.ok('this is a string', 'strings that are not empty are truthy');
//assert.ok(0, 'zero is not truthy');
//assert.strictEqual('', false);
//assert.notStrictEqual('', false);
//assert.deepEqual({
//	a: 1
//}, {
//	a: 1
//});
//assert.deepEqual({
//	a: {
//		a: 1
//	}
//}, {
//	a: {
//		a: 1
//	}
//});
//assert.notDeepEqual({
//	a: 1
//}, {
//	a: 2
//});
//assert.notDeepEqual({
//	a: {
//		a: 1
//	}
//}, {
//	a: {
//		a: 2
//	}
//});
//assert.throws(function(){
//	throw new Error('seven fingers.ten is too mainstream.');
//});
//assert.doesNotThrow(function(){
//	throw new Error('i lived in the ocean way before nemo');
//});

//---------- vm ----------
/**
 * 虚拟机
 * */
//var vm = require('vm')
//	, fs = require('fs')
//	, code = fs.readFileSync('db.js')
//	, script = vm.createScript( code )
//	, rs = vm.runInThisContext('1+1')
//	, e = 0
//	, v = 0
//	, context = {
//		alphabet: ''
//	}
//	;
////console.log( rs, eval(e=e+1), e, vm.runInThisContext('v=v+1') );
////console.log( rs, eval(e=e+1), e, vm.runInThisContext('v=0'), vm.runInThisContext('v=v+1') );
////console.log( vm.runInNewContext('alphabet+="a"', context) );
////console.log( vm.runInNewContext('alphabet+="b"', context) );
//console.log( code );
//console.log( script.runInNewContext({
//	console: console
//	, require: require
//}) );

//---------- CouchDB ----------
/**
 * 连接 CouchDB
 * */
//var http = require('http')
//	, qs = require('querystring')
//	, url = require('url')
//	, options = {
//		host: '127.0.0.1'
//		, port: 5984
//	}
//	, createDB = function(res, dbname){
//		var request
//			;
//
//		options.path = '/'+ dbname;
//		options.method = 'PUT';
//
//		request = http.request( options );
//		request.end();
//		request.on('response', function( response ){
//			response.on('end', function(){
//				if( response.statusCode == 201 ){
//					showDBs(res, dbname +' created');
//				}
//				else{
//					showDBs(res, dbname + ' not created');
//				}
//			});
//		});
//	}
//	, deleteDB = function(res, dbpath){
//		var request
//			;
//
//		options.path = dbpath;
//		options.method = 'DELETE';
//
//		request = http.request( options );
//		request.end();
//		request.on('response', function( response ){
//			response.on('end', function(){
//				if( response.statusCode == 200 ){
//					showDBs(res, 'delete db');
//				}
//				else{
//					showDBs(res, 'not delete db');
//				}
//			});
//		});
//	}
//	, showDBs = function(res, message){
//		var request
//			;
//
//		options.path = '/_all_dbs';
//		options.method = 'GET';
//
//		request = http.request( options );
//		request.end();
//		request.on('response', function( response ){
//			var responseBody = ''
//				;
//
//			response.on('data', function(chunk){
//				responseBody += chunk;
//			});
//			response.on('end', function(){
//				var dbname
//					, dblist = JSON.parse( responseBody )
//					, i = 0
//					, j
//					;
//				res.writeHead(200, {
//					'Content-Type': 'text/html'
//				});
//				res.write('<form method="post">');
//				res.write('new db name: <input type="text" name="dbname" />');
//				res.write('<input type="submit" value="提交" />');
//				res.write('</form>');
//
//				if( null != message ){
//					res.write('<h1>'+ message +'</h1>');
//				}
//
//				res.write('<h1>active db:</h1>');
//				res.write('<ul>');
//
//				for(j = dblist.length; i < j; i++){
//					dbname = dblist[i];
//
//					res.write('<li><a href="/'+ dbname +'">'+ dbname +'</a></li>');
//				}
//
//				res.write('</ul>');
//				res.end();
//			});
//		})
//	}
//	;
//http.createServer(function(req, res){
//	var body = ''
//		, path
//		;
//	if( req.method == 'POST' ){
//		req.on('data', function( data ){
//			body += data;
//		});
//		req.on('end', function( data ){
//			var POST = qs.parse( body )
//				, dbname = POST['dbname']
//				;
//
//			if( null != dbname ){
//				createDB(res, dbname);
//			}
//			else{
//				showDBs(res, 'bad db name, can not create');
//			}
//		});
//	}
//	else{
//		path = url.parse( req.url ).pathname;
//
//		if( path != '/' ){
//			deleteDB(res, path);
//		}
//		else{
//			showDBs( res );
//		}
//	}
//}).listen( 8080 );
//http.createServer(function(req, res){
//	var client
//		, request
//		, options = {
//			host: '127.0.0.1'
//			, port: 5984
//		}
////		client = http.createClient(5984, '127.0.0.1')
////		, request = client.request('GET', '/_all_dbs')
//		;
//
///**
// * 获取 CouchDB 的数据列表
// * */
//	options.path = '/_all_dbs';
//	options.method = 'GET';
// 	request = http.request( options );
// 	request.end();
//	request.on('response', function(response){
//		var responseBody = '';
//
//		response.on('data', function(chunk){
//			responseBody += chunk;
//		});
//
//		response.on('end', function(){
//			res.writeHead(200, {'Content-type': 'text/plain'});
//			res.write( responseBody );
//			res.end();
//		});
//	});
//
///**
// * 创建 CouchDB 数据库
// * */
////	options.path = '/dbname';
////	options.method = 'PUT';
////	request = http.request( options );
////	request.end();
////	request.on('response', function( respones ){
////		respones.on('end', function(){
////			if( respones.statusCode == 201 ){
////				console.log( 'DB success created' );
////			}
////			else{
////				console.log('could not create db');
////			}
////		})
////	});
//
///**
// * 删除 CouchDB 数据库
// * */
//	options.path = '/dbname';
//	options.method = 'DELETE';
// 	request = http.request( options );
//	request.on('response', function(response){
//		response.on('end', function(){
//			if( response.statusCode == 200 ){
//				console.log('delete db');
//			}
//			else{
//				console.log('could not delete db');
//			}
//		});
//	});
//}).listen(8080);

/**
 * 使用 felix-couchdb
 * */
//var couchdb = require('felix-couchdb')
//	, dbHost = '127.0.0.1'
//	, dbPort = 5984
//	, dbName = 'users'
//	, client = couchdb.createClient(dbPort, dbHost)
//	, db = client.db( dbName )
//	, user = {
//		name: {
//			first: 'jhon'
//			, last: 'doe'
//		}
//	}
//	;
//// 创建表
//db.exists(function(err, exists){
//	if( !exists ){
//		db.create();
//		console.log('db '+ dbName +' created');
//	}
//	else{
//		console.log('db '+ dbName +' exists');
//	}
//});
//// 创建文档
//db.saveDoc('jdoe', user, function(err, doc){
//	if( err ){
//		console.log( JSON.stringify( err ) );
//	}
//	else{
//		console.log('Saved user');
//	}
//});
//// 取回一条记录
//db.getDoc('jdoe', function(err, doc){
//	console.log( doc )
//});
//
//// 更新记录
//db.getDoc('jdoe', function(err, doc){
//	console.log( doc );
//
//	doc.name.first = 'Johonny';
//	doc.email = 'jdoe@johndoe.com';
//
//	db.saveDoc('jdoe', doc);
//
//	db.getDoc('jdoe', function(err, revisedUser){
//		console.log( revisedUser );
//	});
//});
//
//// 删除数据
//db.getDoc('jdoe', function(err, doc){
//	console.log(doc);
//	db.removeDoc(doc._id, doc._rev);
//});

//---------- Redis ----------
/**
 * Redis
 * */

//---------- MongoDB ----------
/**
 * MongoDB 驱动
 * */
//var mongo = require('mongodb')
//	, host = 'localhost'
//	, port = mongo.Connection.DEFAULT_PORT
//	, server = new mongo.Server(host, port, {auto_reconnect: true})
//	, db = new mongo.Db('node-mongo-examples', server, {safe: true})
//	;
//
//db.open(function(err, db){
//	if( err ){
//		console.log(err);
//		return;
//	}
//	db.collection('users', {safe: true}, function(err, collection){
//		collection.insert({
//			username: 'bilbo'
//			, firstname: 'shilbo'
//		}, function(err, docs){
//			console.log( docs );
//			db.close();
//		});
//	})
//});

/**
 * Mongoose 库 驱动 MongoDB
 * */
//var mongoose = require('mongoose')
//	, Schema = mongoose.Schema
//	, ObjectId = Schema.ObjectId
//	, AuthorSchema = new Schema({
//		name: {
//			first: String
//			, last: String
//			, full: String
//		}
//		, contact: {
//			email: String
//			, twitter: String
//			, google: String
//		}
//		, photo: String
//	})
//	, CommentSchema = new Schema({
//		commenter: String
//		, body: String
//		, posted: Date
//	})
//	, ArticleSchema = new Schema({
//		author: ObjectId
//		, title: String
//		, contents: String
//		, published: Date
//		, comments: [CommentSchema]
//	})
//	, Author = mongoose.model('Author', AuthorSchema)
//	, Article = mongoose.model('Article', ArticleSchema)
//	;
//
//mongoose.connect('mongodb://localhost:27017/upandrunning', function(err){
//	if( err ){
//		console.log('could not connect to mongo');
//	}
//});
//
//Author.save(function(err){
//	if( err ){
//		console.log('could not save author');
//	}
//});
//Author.find(function(err, doc){
//	console.log(doc);
//});

//---------- MySQL ----------
/**
 * NodeDB
 * */

/**
 * Sequelize
 * */

//---------- PostgreSQL ----------
/**
 * pg 模块
 * */

//---------- 连接池 ----------
/**
 * generic-pool
 * */
//var poolModule = require('generic-pool')
//	, mysql = require('mysql')
//	, connectParam = {
//		hostname: 'localhost'
//		, pot: '3306'
//		, user: 'root'
//		, password: 'zw251108'
//		, database: 'coding4fun'
//	}
//	, pool = poolModule.Pool({
//		name: 'mysql'
//		, create: function( callback ){
////			var db = new mysql;
//			var client = mysql.createConnection( connectParam );
//		}
//		, destroy: function( client ){
//			client.end();
//		}
//		, max: 10
//		, idleTimeoutMilles: 3000
//		, log: true
//	})
//	;
//pool.acquire(function(error, client){
//	if( error ){
//		return console.log('failed to connect');
//	}
//
//	// 调用
//	client.query('', function(){
//
//		pool.release( client );
//	});
//
//});

//---------- 消息队列协议 ----------
/**
 * RabbitMQ
 * */

//---------- Express ----------
/**
 * Express
 * */
//var express = require('express')
////	, app = express.createServer()
//	, app = express()
//	, users = [{
//		name: 'tj'
//	}, {
//		name: 'tom'
//	}]
//	;
//
//app.use( express.limit('1mb') );    // limit 把请求正文大小限制在 1MB 以内
//app.use( express.bodyParser() );    // bodyParser 解析从 Web 浏览器发送来的请求正文，把表单变量转换成 express 使用的对象
//app.use( express.methodOverride() );    // methodOverride 允许表单提交隐藏的 _method 变量，并把 get 方法替换掉，然后调用相应的 RESTful 方法
//
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
//
//app.listen(9001);

//---------- Socket.IO ----------
/**
 * Socket.IO
 * */
//var http = require('http')
//	, server = http.createServer()
//	, io = require('socket.io')
//	, socket
//	;
//
//server.on('request', function(req, res){
//	res.writeHead(200, {
//		'Content-Type': 'text/plain'
//	});
//	res.send('Hello world');
//});
//server.listen(80);
//
//socket = io.listen( server );
//
////socket.on('connection', function(client){
////	console.log('client connected')
////});
//
//// 命名空间
//socket.of('/upandrunning').on('connection', function( client ){
//	console.log('client connected');
//	client.send('welcome client');
//});
//socket.of('/weather').on('connection', function( client ){
//	console.log('get weather');
//	client.send('weather is fine');
//});

/**
 * Express + Socket.IO
 * */
var io = require('socket.io')
	, express = require('express')
	, app = express()
	, store = new express.session.MemoryStore
	, utils = require('connect').utils
	, Session = require('connect').middleware.session.Session
	, sio
	;

app.configure(function(){
	app.use( express.cookieParser() );
	app.use( express.session({
		secret: 'secretKey'
		, key: 'express.sid'
		, store: store
	}) );
	app.use(function(req, res){
		var sess = req.session;
		res.render('socket.jade', {
			email: sess.email || ''
		});
	});
});

app.listen(8080);

sio.listen( app );

sio.configure(function(){
	sio.set('authorization', function(data, accept){
		var cookies = utils.parseCookie( data.headers.cookie );

		data.sessionID = cookies['express.sid'];
		data.sessionStore = store;

		store.get(data.sessionID, function(err, session){
			if( err || !session ){
				return accept('invalid session', false);
			}

			data.session = new Session(data, session);
			return accept(null, true);
		});
	});

	sio.socket.on('connection', function( socket ){
		var session = socket.handshake.session;

		socket.join(socket.handshake.sessionId);
		socket.on('emailupdate', function( data){
			session.email = data.email;
			session.save();

			sio.sockets.in( socket.handshake.sessionId).emit('emailchanged', {
				email: data.email
			})
		})

	})
});