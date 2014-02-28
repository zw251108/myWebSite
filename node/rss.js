var fs = require('fs'),
	xml2js = require('xml2js'),
	parser = new xml2js.Parser(), sql = [],

/**
 * 存入数据库
 * */
	sys = require('util'),
	mysql = require('mysql'),
	conn = mysql.createConnection({
		host: 'localhost',
		port: '3306',
		user: 'root',
		password: 'zw251108',
		database: 'coding4fun'
	});

conn.connect();

console.log('数据库连接已建立，读取 '+ __dirname +'\\..\\rss.opml 文件');
fs.readFile(__dirname +'\\..\\rss.opml', 'utf8', function(err, data){
	if( err ){
		console.log('e1');
		console.dir( err );
		return;
	}

	parser.parseString(data, function(err, result){
		if( err ){
			console.log('e2');
			console.dir( err );
			return;
		}

		var data = result.opml.body[0].outline,
			i = 0, j = data.length,
			m, n,
			subData, temp,
			tag;

		for(; i < j; i++){
			subData = data[i];

			if( subData.outline ){
				tag = subData.$.text;
				temp = subData.outline;

				for(m = 0, n = temp.length; m < n; m++){
					subData = temp[m].$;

					conn.query('insert into rss(name,xmlUrl,htmlUrl,type,tag) values(?,?,?,?,?);',
						[subData.text, subData.xmlUrl, subData.htmlUrl, subData.type, tag], function(e, rs){
						if( e ){
							console.dir( e );
						}
					});
				}
			}
			else{
				tag = '';
				subData = subData.$;
				conn.query('insert into rss(name,xmlUrl,htmlUrl,type,tag) values(?,?,?,?,?);',
					[subData.text, subData.xmlUrl, subData.htmlUrl, subData.type, tag], function(e, rs){
						if( e ){
							console.dir( e );
						}
					});
			}
		}

		conn.end();
	});
});

