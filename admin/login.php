<?php
require_once('../include/user.class.php');

$msg = '';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	if( isset( $_POST['username'] ) && isset( $_POST['password'] ) ){

		$user = new User();

		$username = filterReq( $_POST['username'] );
		$password = filterReq( $_POST['password'] );

		$userInfo = $user->selectPwdByEmail( $username );

		if( $userInfo ){// 用户名已存在
			if( $userInfo->password == $password ){
				$res['state'] = 'login';

				$_SESSION['user'] = true;
				$_SESSION['userId'] = $userInfo->Id;

				header('location:index.php');
			}
			else{
				$msg = '账户名称或账户密码错误';
			}
		}
		else{
			$msg = '账户名称或账户密码错误';
		}
	}
	else{
		$msg = '账户名称或账户密码未填';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>登录</title>
<link rel="stylesheet" href="../style/style.css" />
<style>
.loginBox{
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	top: 0;

	height: 200px;
	width: 300px;

	border: 5px solid #C0C0C0;
	margin: auto;
	background: #efefef;
}
.btn{
	float: none;
	display: block;
	margin: 0 auto;
}
</style>
</head>
<body>

<div class="loginBox">
	<form action="login.php" method="post">
		<div class="form_group">
			<label class="hidden" for="username">账户名称</label>
			<input class="input" type="text" name="username" id="username" placeholder="账户名称"/>
		</div>
		<div class="form_group">
			<label class="hidden" for="password">账户密码</label>
			<input class="input" type="password" name="password" id="password" placeholder="账户密码"/>
		</div>
		<input type="submit" class="btn btn-submit" value="登录"/>
		<p><?php echo $msg; ?></p>
	</form>
</div>

</body>
</html>