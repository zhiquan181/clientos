<!DOCTYPE html>
<html>
<head>
	<title>客户跟进管理系统</title>
	<meta charset="UTF-8">
	<meta author="Vegeta">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<style type="text/css">
		@charset "utf-8";
		* { font: 13px/1.5 '微软雅黑'; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; -box-sizing: border-box; padding:0; margin:0; list-style:none; box-sizing: border-box; }
		body, html { width:100%;min-width:1400px;height:100%; }
		body { background:#fff; background-size: cover; }
		a { color:#27A9E3; text-decoration:none; cursor:pointer; }

		/*滚动条 start*/
		body::-webkit-scrollbar {
		width: 8px;
		height: 8px;
		background-color: #f8f8f8;
		}
		/*定义滚动条轨道 内阴影+圆角*/
		body::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		background: #fff ;
		}
		/*定义滑块 内阴影+圆角*/
		body::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color:#999;
		}
		body::-webkit-scrollbar-thumb:hover {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color:#666;
		}
		/*滚动条 end*/

		.login_box{ width:1000px;height:521px;margin:auto;position:absolute;left:0;right:0;top:0;bottom:0;}
		.login_box .login_img{  width:432px; height:360px;float:left;margin-left:50px;background-image:url(../img/banner.png);background-position:center;background-size:contain;background-repeat: no-repeat;}
		.login {height:360px; width:400px; padding:50px; background-color: #ffffff;border-radius:6px;box-sizing: border-box; float:right; margin-right:50px; position:relative; }
		.login_name{ width:100%; float:left; text-align:center; margin-top:20px;}
		.login_name p{ width:100%; text-align:center; font-size:18px; color:#aaa;letter-spacing:5px;padding:10px 0 20px;}
		.login_logo img{ width:60px; height:60px;display: inline-block; vertical-align: middle;}
		input[type=text], input[type=file], input[type=password], input[type=email], select { border: 1px solid #DCDEE0; vertical-align: middle; border-radius: 3px; height: 50px; padding: 0px 16px; font-size: 14px; color: #555555; outline:none; width:100%;margin-bottom: 15px;line-height:50px; color:#888;transition: ease border .3s;-moz-transition: ease border .3s;/* Firefox 4 */-webkit-transition: ease border .3s;/* Safari 和 Chrome */-o-transition: ease border .3s;/* Opera */}
		input[type=text]:focus, input[type=file]:focus, input[type=password]:focus, input[type=email]:focus, select:focus { border: 1px solid #27A9E3; }
		input[type=submit], input[type=button] { display: inline-block; vertical-align: middle; padding: 12px 24px; margin: 0px; font-size:16px; line-height: 24px; text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; color: #ffffff; background-color: #27A9E3; border-radius: 3px; border: none; -webkit-appearance: none; outline:none; width:100%; }
		input::-webkit-input-placeholder {color:#bbb;}
		.copyright { width: 100%; height: ; position: absolute; text-align: center;color:#aaa;bottom: 50px; }
	</style>
</head>
<body>
	<div class="login_box">
		<div class="login_img"></div>
		<div class="login">
			<div class="login_name">
				<p>客户跟进管理系统</p>
			</div>
			<form method="post" action="login.php">
				<input id="username" name="username" type="text" placeholder="账号" maxlength="20" autocomplete="off">
				<input id="password" name="password" type="password" placeholder="密码" autocomplete="off"/>
				<input type="submit" value="登录">
			</form>
		</div>
	</div>
	
	<div class="copyright">版权所有©2019 技术支持电话：000-00000000</div>
</body>
</html>
