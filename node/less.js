/**
 * less 编译成 css
 * 确定 安装了 less 模块
 */

/**
 * 读取文件路径
 * */
var path = require('path'),
    public_dir = path.join(__dirname, '..', ''),
    less_file = path.join(public_dir, 'less', 'style.less'),
    css_file = path.join(public_dir, 'style', 'style.css');

console.log( public_dir );
console.log( less_file );
console.log( css_file );

/**
 * 命令行调用 less
 * */
var exec = require('child_process').exec,
    cmd = ['lessc', less_file, '>', css_file, '-x'].join(' ');

console.log( cmd );
exec(cmd, {
    encoding: 'utf-8'
}, function(error, stdout, stderr){
    if(error !== null) {
        console.log(error);
        return;
    }
    console.log(stdout, stderr);
});