<?php
require_once('../include/Message.class.php');
$msg = new Message();
$rs = $msg->selectAll();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title></title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>发送者</th>
        <th>内容</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
<?php
for( $i = 0, $j = count( $rs ); $i<$j; $i++ ){
    echo '<tr>';
    echo '<td>'. $rs[$i]->Id .'</td>';
    echo '<td>'. $rs[$i]->sendfrom .'</td>';
    echo '<td>'. $rs[$i]->content .'</td>';
    echo '<td>'. $rs[$i]->datetime .'</td>';
    echo '</tr>';
}
?>
    </tbody>
</table>
</body>
</html>