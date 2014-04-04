var fs = require('fs')
//	, rd = require('rd')
	, path = require('path')
	, images = require('images')
	, mysql = require('mysql')
	, conn = mysql.createConnection({
		host: 'localhost',
		port: '3306',
		user: 'root',
		password: 'zw251108',
		database: 'coding4fun'
	})
	, errorCallBack = function(e){    // 错误回调函数
		console.log('Error: '+ e.message);
	}
	;

//rd.read('../image/preview', function(err, files){ // files是一个数组，里面是目录/tmp目录下的所有文件（包括子目录）
//	if (err) throw err;
//
//	console.log( files );
//});

//conn.connect();
//
//var connClose = function(){ // 关闭数据库连接
//	conn.end();
//};