<?php
	header("Content-type:text/html;charset=utf-8");
	
	session_start();
	$username = isset($_POST['username'])?$_POST['username']:null;
	$password = isset($_POST['password'])?$_POST['password']:null;
	if ($username == 'admin' && $password == 'admin888') {
		$_SESSION["username"]=$username;
        $_SESSION["password"]=$password;
        header("Location:system.php");
	}
	else{
		echo"<script> alert('账号或密码错误！');
                    window.location='index.php';
            </script>";
	}
?>