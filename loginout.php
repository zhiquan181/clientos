<?php
	header("Content-type:text/html;charset=utf-8");
	session_start();//启动会话
	session_unset();//删除会话
	session_destroy();//结束会话
	echo "<script> alert('退出成功！');window.location='index.php'; //跳转首页</script>";
?>