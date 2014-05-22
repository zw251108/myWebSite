/**
 * NodeJS 连接 MySQL 数据库
 * */
console.log('start connecting to MySQL');
var sys = require('util'),
    mysql = require('mysql'),
    conn = mysql.createConnection({
        host: 'localhost',
        port: '3306',
        user: 'root',
        password: 'zw251108',
        database: 'coding4fun'
    }),
    errorCallBack = function(e){    // 错误回调函数
        console.log('Error: '+ e.message);
    },
    together = [],
    flag = 0,
    result = {};

conn.connect();

var connClose = function(){ // 关闭数据库连接
		console.log('close connection');
        conn.end();
    },
    countTag = function(){  // 统计标签
        var i = together.length,
            temp, tagId,
            m, n;

        while( i-- ){
            temp = together[i];
            temp = temp.tagsId.split(',');

            for(m = 0, n = temp.length; m < n; m++ ){
                tagId = temp[m];
                if( tagId in result ){
                    result[tagId]++;
                }
                else{
                    result[tagId] = 1;
                }
            }
        }

        for( m in result ) if( result.hasOwnProperty(m) ){

            conn.query('update tag set tagNum=? where Id=?', [result[m], m], function(e, rs){
                if( e ){
                    errorCallBack( e );
                }
            });
        }

        connClose();
    },
    queryCallback = function(e, rs, fields){// 查询数据回调函数
        if( e ){
            errorCallBack( e );
        }
        else{
            flag++;
            [].push.apply(together, rs);

            if( flag === 3 ){
                countTag();
            }
        }
    };

conn.query('select tagsId from blog where tagsId<>\'\'', queryCallback);
conn.query('select tagsId from editor where tagsId<>\'\'', queryCallback);
conn.query('select tagsId from favorite where tagsId<>\'\'', queryCallback);

/**
 * 修改数据库 editor 表
 * */
//conn.query('select Id,includeFile from editor', function(e, rs, fields){
//	if( e ){
//		errorCallBack( e );
//	}
//	var i = 1
//		, j = rs.length
//		, k
//		;
//
//	k = j;
//	while( j-- ){
//		conn.query('update editor set includeFile=? where Id=?', [
//			rs[j].includeFile.replace('../bower_components/jquery/dist/jquery.min.js'
//				, '../script/lib/jQuery/jquery.min.js')
//			, rs[j].Id], function(e){
//				i++;
//				if( i === k ){
//					connClose();
//				}
//		});
//	}
//});

//conn.end();