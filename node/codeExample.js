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
//	                                         console.log( clientList.length );
//	// client 发送数据是触发
//	client.on('data', function(data){
//		console.log(data);
//
//		// 每个客户端都接受信息
//		for(var i = 0, j = client.length; i < j; i++){
//			clientList[i].write(data);
//		}
//
////		broadcast(data, client);
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
//var io = require('socket.io')
//	, express = require('express')
//	, app = express()
//	, store = new express.session.MemoryStore
//	, utils = require('connect').utils
//	, Session = require('connect').middleware.session.Session
//	, sio
//	;
//
//app.configure(function(){
//	app.use( express.cookieParser() );
//	app.use( express.session({
//		secret: 'secretKey'
//		, key: 'express.sid'
//		, store: store
//	}) );
//	app.use(function(req, res){
//		var sess = req.session;
//		res.render('socket.jade', {
//			email: sess.email || ''
//		});
//	});
//});
//
//app.listen(8080);
//
//sio.listen( app );
//
//sio.configure(function(){
//	sio.set('authorization', function(data, accept){
//		var cookies = utils.parseCookie( data.headers.cookie );
//
//		data.sessionID = cookies['express.sid'];
//		data.sessionStore = store;
//
//		store.get(data.sessionID, function(err, session){
//			if( err || !session ){
//				return accept('invalid session', false);
//			}
//
//			data.session = new Session(data, session);
//			return accept(null, true);
//		});
//	});
//
//	sio.socket.on('connection', function( socket ){
//		var session = socket.handshake.session;
//
//		socket.join(socket.handshake.sessionId);
//		socket.on('emailupdate', function( data){
//			session.email = data.email;
//			session.save();
//
//			sio.sockets.in( socket.handshake.sessionId).emit('emailchanged', {
//				email: data.email
//			})
//		})
//
//	})
//});

/**
 * node-segment 中文分词库
 * */
// 载入模块
var Segment = require('node-segment').Segment;

// 创建实例
var segment = new Segment();

//// 使用默认的识别模块及字典
segment.useDefault();

//segment.use('ForeignTokenizer');

console.log(+(new Date()));

// 开始分词

//var slice = segment.doSegment('<p>爱，福雷,呵呵，我的个人网站终于上线了，按照程序员的潜规则，第一个输出就应该是 Hello world。</p>\
//	\
//	<p>其实呢，这个网站已经策划好久了，自从我毕业后进入互联网行业，就一直想做一个个人网站，不过无奈当时的各方面能力都不够，所以一直在学习而没有实践。不过一直以来，最头痛的还是设计的问题，那时候的网站大都要找个人来好好设计一下，做得花哨一些，而技术我可以学，也能学会，但是设计就没有保证了。</p>\
//	<p>后来 Metro Style 出来，看了突然顿悟简单才是美啊，然后网站就大体设计成这样了，除了一些细微的数值调整，界面应该不会什么改变了。总体上从去年 10 月份之后，工作上也不太紧张就开始正式进入编码阶段了。不过进度很缓慢，每天都有新的想法出现，然后就把之前的一些成果给否定了。这种状况持续了有一段时间，还好这是我个人的项目，如果是公司的话，我大概早就不干了吧。其实，这个过程也挺好，让我认识到了，自己的很多的问题，过程中又学习了很多新东西。</p>\
//	<p>说起来，现在要建立个人网站通常都会使用类似 WordPress 的网站模板。不过，我个人是很讨厌框架、模板一类的东西的。同时，就目前来说我也从来没有经历过一个完整的项目，从架构设计到代码实现再到细节处理。所以，我决定从头开始，这个网站的代码完全是由自己来写，即使借鉴了别人的代码，也绝不是复制粘贴，而是一个一个字母重新敲下来的。不过，目前还是有使用一些非常复杂的 JS 插件，但我保证，以后有时间，一定会尝试自己开发一个。</p>\
//	\
//	<p>总之，这个网站目前只具备最基本的功能，可以发表文章，回复功能也没有。不过还有一些之前没有正式开发阶段时，因为好玩写的一些小功能，比如：<a href="http://zw150026.com/palette/" class="link" target="_blank">调色板</a>，还有一路走过来，在前端开发方面学习的总结<a href="http://zw150026.com/document/" class="link" target="_blank">文档</a>，这个文档参考了很多人所写的博客，而且年代久远了，所以都不记得参考了谁的文章。不过，这个前端文档主要还是给我自己看的。如果其它能顺便帮到其别人话，当然很荣幸；如果帮不到别人，那也没办法了，我的水平也是就这样了。</p>\
//	\
//	<p>最后，这个网站的主题就是自娱自乐，不过更是希望这个网站能代表我的水平。目前，我的开发计划是以半个月到一个月为一个迭代周期来开发一个功能模块，不过具体时间的话还要看工作忙不忙了；具体的模块功能的话，虽然会有一个计划列表，但是总体上来说我也是一个很随意的人，而且这又是个人项目，所以还是以我的兴趣为主，随时有个想法就尽快把它实现了，呵呵。</p>\
//	\
//	<p>Just Coding For Fun。</p>');

var slice = segment.doSegment('加班背后的无奈与原因\
	\
在V众投上曾经有一个问题叫：IT研发人员就一定总加班吗？ 从问答来看看来大家对加班这事还是比较无奈和矛盾的：一方面现实让IT人必须加班；另一方面除了少数工作狂人，大家其实并不喜欢这事。\
\
而为什么加班极为普遍，其原因很多，比如：\
\
人为的行政上原因。这可以进一步划分为两类场景：一类是，在有的公司里，不加班被等价于工作不努力。所以不管需不需要，那怕磨洋工也先加了再说。一类是，在有的公司里，利润和工作时间成比例关系，所以潜在的公司会推动多加班。后一类是恶意促使员工加班，不过指望自省来解决问题是不可能的。\
商业原因。这说的是，很多时候程序员会直接收到到某个日程，但日程本身不太合理，这样就只能加班来赶。日程本身很多时候是根据产品上市时间这类商业因素定的，而确定产品上市时间时，企划人员可能根本不太清楚开发工作本身究竟需要多少工作量，其中偏差就只能靠程序员的加班来弥补。\
技术原因。这里的技术说的是估算技术和需求开发技术。有的时候即使是项目组自己做估算，决定日程，但由于需求自身的不清晰，或者估算方法的不恰当，也还会出现无法搞定承诺日程的情形---这也得加班。\
市场的原因。竞争过于激烈，需要高频率推出各种产品。\
　　……\
	\
不同的原因总是可以通过不同的手段来解决，但也确实都可以通过延长工作时间这统一的手段来解决，程序员作为所有一切的末梢，一旦成为承担所有后果的容器，那就必然总是加班。但关键是这样做是没有底线的，如果企业不为自己设定边界，那就只会导致过劳。认为延长工作时间是唯一解决问题之道，就会进一步认为过劳只是起源于市场竞争的无奈，并因此而心安理得。这是极为错误的，不分析其内在形成原因，而简单的归结于市场竞争是一种托词和失职。\
	\
可以不加班么？\
	\
近来诺基亚裁员事件唤起了大家对这个公司的关注，并进一步发掘出了许多员工层面的细节，比如工作懈怠等，但反过来看诺基亚全员都死命加班就可以拯救这个公司么？我不这么看。一般来讲大家都认为日本人工作是比较勤奋的，但这种勤奋并未让索尼这样的日企避免陷入困境。\
	\
而再反过来看我们可以讲出现成功的产品的公司或团队是因为他们比别人更辛苦么？我觉得不是的，这更多的是由于捕捉到了窗口期的机会并打造了切合时代需要的产品，诚然他们也是辛苦的，但这不是决定性因素。\
	\
IT界的一个前辈宋朝弟曾经对我讲工业时代的规则比较牛顿，单维因果，但互联网时代的则比较量子，多维因果。在比较牛顿的时代里，加班对结果会有更多的影响，比如工厂里的工人，只要加班时间足够长就能够生产足够多的产品。但在多维因果的时代里，单纯的努力是没用的。在很多企业里加班更多的是种惯性，或者说是陷入红海后的无奈。再直接讲就是创新越不足，就越需要加班来弥补；工作本身附加值越低，加班越有效果。所以总强调加班的企业需要更多的反思。\
	\
当然写了这么多不是说不能加班，而是说要控制加班的程度。企业并不能决定市场上发生什么，所以加班本身无可厚非。但是持续高强度、无限制的加班则是企业必须要规避的。一点就是上面所说的，这通常并不解决问题或者说只解决眼前的问题；另一点则是员工同时具有多重属性，他即需要履行对企业的责任，也需要履行对社会和家庭的责任。而对家庭和社会的责任至少与履行在企业中的责任同样重要，大多时候其实是更加重要。员工本身对企业没有无限的权利所以也不应当无限制的履行责任，这是非常显然的事情。当上述规则无法达成共识并且确立的时候，履行对企业的责任天生就会侵占其余，越在金字塔末梢的员工自主性则越差，发言权越小，越容易成为过劳的主要受害者。\
	\
理想状况\
	\
理想状况应该是这样：\
	\
在长时间轴上，比如一年总的工作时间上有条红线，这条红线相当于企业与个人利益的最佳分割点，他可以在特定条件下伸缩，但伸缩也应该是个预先清楚定义的范围，红线之后是不可碰触区域。在红线之外，即使会丧失企业收入，企业不应该对员工提出要求，员工停止工作也不是不履行责任。\
这也就意味着超过这条红线之后，公司的问题更应该用其他手段来解决，比如创新，比如效率化等等。\
	\
企业家要想获得尊重，那就必须更好的履行自己的责任。把社会责任、创新这类词语挂在墙上风干是没有用的。否则就会让大家生出——怎么都说的是儒家，做事全是法家的感叹，这会导致个人与企业的疏离，最终伤害的也会是整个系统。这也许表现为离职，也许表现为一种被深深隐藏了的消极。');

//console.log( slice );
console.log(+(new Date()));

//console.log( segment.indexOf(slice, 'WordPress') )

var obj = {}
	, rs = []
	, j = slice.length
	, t
	, w
	;

while( j-- ){
	t = slice[j];
	w = t.w;
	if( w in obj ){
		rs[obj[w]].n++;
	}
	else{
		rs.push({
			tag: w
			, p: t.p
			, n: 1
		});
		obj[w] = rs.length -1;
	}
}
//console.log( rs );

rs.sort(function(a, b){
	return b.n - a.n;
});

console.log( rs );

var a = 5
	, i = 0
	;
j = rs.length;
while( i++ < j ){

	t = rs[i];
	if( t.p === 1048576 || t.p === 8 || t.p === 32 || t.p === 64 || t.p === 128 || t.p === 0 ){
		console.log(t);
		a--;
	}

	if( !a ) break;
}

a = 5;
i = 0;
j = rs.length;
while( i++ < j ){

	t = rs[i];
	if( t.p === 4096 ){
		console.log(t);
		a--;
	}

	if( !a ) break;
}


/**
 * nseg 中文分词
 * */
////var dict  = require('nseg/data/dict'),
////	freq  = require('nseg/data/freq'),
////	date  = require('nseg/lex/datetime'),
////	sina  = require('nseg/lex/sina');
//
//var opts  = {
////	dict: dict,
////	freq: freq,
////	lexers: [date, sina],
//};
//
//var nseg = require('nseg').normal();
//
//nseg('呵呵，我的个人网站终于上线了，按照程序员的潜规则，第一个输出就应该是 Hello world。\
//其实呢，这个网站已经策划好久了，自从我毕业后进入互联网行业，就一直想做一个个人网站，不过无奈当时的各方面能力都不够，所以一直在学习而没有实践。不过一直以来，最头痛的还是设计的问题，那时候的网站大都要找个人来好好设计一下，做得花哨一些，而技术我可以学，也能学会，但是设计就没有保证了。\
//后来 Metro Style 出来，看了突然顿悟简单才是美啊，然后网站就大体设计成这样了，除了一些细微的数值调整，界面应该不会什么改变了。总体上从去年 10 月份之后，工作上也不太紧张就开始正式进入编码阶段了。不过进度很缓慢，每天都有新的想法出现，然后就把之前的一些成果给否定了。这种状况持续了有一段时间，还好这是我个人的项目，如果是公司的话，我大概早就不干了吧。其实，这个过程也挺好，让我认识到了，自己的很多的问题，过程中又学习了很多新东西。\
//说起来，现在要建立个人网站通常都会使用类似 WordPress 的网站模板。不过，我个人是很讨厌框架、模板一类的东西的。同时，就目前来说我也从来没有经历过一个完整的项目，从架构设计到代码实现再到细节处理。所以，我决定从头开始，这个网站的代码完全是由自己来写，即使借鉴了别人的代码，也绝不是复制粘贴，而是一个一个字母重新敲下来的。不过，目前还是有使用一些非常复杂的 JS 插件，但我保证，以后有时间，一定会尝试自己开发一个。\
//总之，这个网站目前只具备最基本的功能，可以发表文章，回复功能也没有。不过还有一些之前没有正式开发阶段时，因为好玩写的一些小功能，比如：调色板，还有一路走过来，在前端开发方面学习的总结文档，这个文档参考了很多人所写的博客，而且年代久远了，所以都不记得参考了谁的文章。不过，这个前端文档主要还是给我自己看的。如果其它能顺便帮到其别人话，当然很荣幸；如果帮不到别人，那也没办法了，我的水平也是就这样了。\
//最后，这个网站的主题就是自娱自乐，不过更是希望这个网站能代表我的水平。目前，我的开发计划是以半个月到一个月为一个迭代周期来开发一个功能模块，不过具体时间的话还要看工作忙不忙了；具体的模块功能的话，虽然会有一个计划列表，但是总体上来说我也是一个很随意的人，而且这又是个人项目，所以还是以我的兴趣为主，随时有个想法就尽快把它实现了，呵呵。\
//Just Coding For Fun。', function (result) {
//	console.log(result);
//});