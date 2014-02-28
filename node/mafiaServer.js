/**
 *
 */

var Config = {
    port:3000
};

// http服务器
var http = require('http');
var server = http.createServer(function(req, res){
    res.writeHead(200, {'content-Type':'text/html;charset=utf-8'});
    res.write( "请不要访问此页面" );
    res.end();
});
server.listen( Config.port );//监听端口
console.log('http server start, is listening at port '+Config.port+'.');

// socket 通信
var io = require("socket.io");
var socket = io.listen(server);// 加参数 {log:false} 可关闭log
console.log("web socket server start");

// 杀人游戏 主业务逻辑
var mafia = {
    userNum:0,      // 用户数量
    userList:[],    // 用户列表
    userTarget:{},  // 用户对象

    /**
     *  0 死亡
     *  1 平民
     *  2 杀手
     *  3 警察
     *  4 医生
     *  5 秘警
     * */
    userStatueList:[],  // 用户状态表
    message:function(msg, id){// 接收消息
        msg = eval('('+ msg +')');
        var title = msg.title,
            rs;
        switch( title ){
            case 'login':
                this.userLogin( msg.name );
                break;
            case 'msg':
                this.chat( msg );
                break;
            default:
                break;
        }

        this.sendMsg(rs, id);
    },
    sendMsg:function(){},
    chat:function(msg){},
    userLogin:function(name){
        var userList = this.userList,
            userTarget = this.userTarget,
            i = userList.length,
            temp;

        while( i-- ){console.log(i)
            temp = userTarget[userList[i]];
            temp && temp.send('{title:"msg",content:"'+name+' 登录游戏",from:"系统",statue:"system"}');
        }
    },
    userBeKilled:function(){}
};

socket.on("connection", function(client){
    var id = client.id;

    // 添加用户
    ++mafia.userNum;
    mafia.userList.push(id);
    mafia.userTarget[id] = client;

    // 绑定消息接收事件
    client.on("message", function(info){
        console.log(info);

        eval("("+info+")");

        mafia.message(info);

//        var mafiaProtocol = eval(data);
//        while(i--){
//            UserObj[UserList[i]].send(data);
//        }
        var num = mafia.userNum;
        //console.log("receive msg from client " + id, mafiaProtocol.login);
    });

    // 用户离线事件
    client.on("disconnect", function(){
//        UserList.splice(num, 1);
//        UserList[id]
        delete mafia.userTarget[id];
        console.log("user " + id + " disconnected, sumcount:" + (--mafia.userNum));
    });
});