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
var assert = require('assert')
	;
//assert.equal(1, true, 'Truthy');
//assert.notEqual(1, true, 'Truthy');
//assert.ok('this is a string', 'strings that are not empty are truthy');
//assert.ok(0, 'zero is not truthy');
