// JavaScript Document
/**
 *  nodeJS后台测试
 * */

/**
 *  配置信息
 * */
//var Config = require("./Config").Config;
var Config = {
    host:"192.168.0.74",
    port:3000
};

/**
 *  静态文件
 * */
//var fs = require('fs');
//var html = [];
//var tmpl = [
//    "tmpl/css.html",
////    "tmpl/top.html",
////    "tmpl/header.html",
////    "tmpl/nav.html",
//    "tmpl/main.html",
////    "tmpl/footer.html",
////    "tmpl/right.html",
////    "tmpl/bottom.html",
//    "tmpl/js.html"
//];
//var len = tmpl.length;
//for(var i=0, j=tmpl.length; i<j; i++){
//    fs.readFile(tmpl[i], 'utf-8', function(err, data){
//        if(err){
//            console.error(err);
//        }
//        else{
//            //TODO 替换模板中的变量
//            html.push( data );
//        }
//    });
//}

/**
 *  http服务器
 * */
var http = require('http');
console.log("server start");
var server = http.createServer(function(req, res){
    res.writeHead(200, {'content-Type':'text/html;charset=utf-8'});
    res.write( "hello" );
    res.end();
});
server.listen( Config.port );//监听端口
console.log('http server is listening at port '+ Config.port +'.');

/**
 *  socket
 * */
var io = require("socket.io");
var socket = io.listen(server);//, {log:false}关闭log
var UserNum = 0;    //用户数量
var UserList = [];  //用户列表
console.log("web socket server start");
socket.on("connection", function(client){
    var id = client.id;
    var num = ++UserNum;
    UserList.push(client);
    console.log("new user " + id + ", sumcount:" + UserNum);
    client.on("message", function(data){
        var i = UserNum;
        while(i--){
            UserList[i].send(data);
        }
        console.log("receive msg from client " + id, data);
    });
    client.on("disconnect", function(){
//        UserList.splice(num, 1);
        console.log("user " + id + " disconnected, sumcount:" + (--UserNum));
    });
});

/**
 *  订阅/发布
 * */
//var PubSub = require("./PubSub").PubSub;
//PubSub.subscribe("sendMessage", function(){
//    console.log("message publish");
//});
//PubSub.publish("sendMessage");

/**
 *  事件
 * */
//var eventEmitter = require('events').EventEmitter;
//var event = new eventEmitter();
//event.on('some_event', function(){
//    console.log('some_event occured.');
//});
//setTimeout(function(){
//    event.emit('some_event');
//}, 10000);

/**
 *  MVC实验
 *
 *      Model       模型
 *      Controller  控制
 *      View        视图
 * */
//var Model = require("./MVC/Model.Class.js").Model;

//var User = Model.create();
//var user1 = User.init({"attr":"disabled"});
//user1.save();
//console.log( user1.id+ "," +user1.attr );
//
//var user2 = User.init({"attr":"type"});
//user2.save();
//console.log( user2.id+ "," +user2.attr );
//
//var Asset = Model.create();
//var asset1 = Asset.init({name:"123"});
//asset1.save();
//console.log( asset1.id+ "," +asset1.name );
//
//var asset2 = Asset.init({"name":"234"});
//asset2.save();
//console.log( asset2.id+ "," +asset2.name );