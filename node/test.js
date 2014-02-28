/**
 * 测试 POST API
 * */
var opts = {
		host: 'localhost'
		, port: 80
		, path: '/send'
		, method: 'POST'
		, header: {
			'content-type': 'application/x-www-form-urlencoded'
		}
	}
	, assert = require('assert')
	, http = require('http')
	, req = http.request(opts, function(res){
		res.setEncoding('utf8');

		var data = '';

		res.on('data', function(d){
			data += d;
		});
		res.on('end', function(){
			assert.strictEqual(data, '{"status":"ok","message":"Tweet received"}');
		});
	})
	;
req.write('tweet=test');
req.end();