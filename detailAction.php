<?php
	// error_reporting(0);
	header("Content-type:text/html;charset=utf-8");

	$id = isset($_POST['id'])?$_POST['id']:null;
	$grade = isset($_POST['grade'])?$_POST['grade']:null;
	$company = isset($_POST['company'])?$_POST['company']:null;
	$client = isset($_POST['client'])?$_POST['client']:null;
	$phone = isset($_POST['phone'])?$_POST['phone']:null;
	$population = isset($_POST['population'])?$_POST['population']:null;
	$demand = isset($_POST['demand'])?$_POST['demand']:null;
	$wxvisit = isset($_POST['wxvisit'])?$_POST['wxvisit']:null;
	$course = isset($_POST['course'])?$_POST['course']:null;
	$remarks = isset($_POST['remarks'])?$_POST['remarks']:null;
	$others = isset($_POST['others'])?$_POST['others']:null;
	// $lastdate = date('Y-m-d H:i:s',time());
	$remind = isset($_POST['remind'])?$_POST['remind']:null;
	$pic = isset($_FILES['pic'])?$_FILES['pic']:null;
	$pic_str = isset($_FILES['pic']['name'])?$_FILES['pic']['name']:null;
	$abstract = isset($_POST['abstract'])?$_POST['abstract']:null;
	$picture_input = isset($_POST['picture_input'])?$_POST['picture_input']:null;
	
	try {
			$pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
		}
	catch (PDOException $e) {
		die("数据库连接失败" . $e->getMessage());
	}
	$pdo->query("SET NAMES 'UTF8'");

	if ($id&&$company&&$pic_str) {

		// 创建文件夹
		$dir = iconv("UTF-8", "GBK", "upload");
	    if (!file_exists($dir)){
	        mkdir ($dir,0777,true);
	    }

	    // 上传图片以及处理图片路径
		$filepath = 'upload/';
		$tmp1 = $_FILES['pic']['tmp_name'];
		$pic_expl = substr(strrchr($pic_str, '.'), 1);
		$pic_path = $filepath."1".uniqid().".".$pic_expl;
		move_uploaded_file($tmp1,$pic_path);

		// $lastdate = date($lastdate_str);

	    $sql2 = "UPDATE client SET grade='{$grade}',company='{$company}',client='{$client}',phone='{$phone}',population='{$population}',demand='{$demand}',wxvisit='{$wxvisit}',course='{$course}',remarks='{$remarks}',others='{$others}',remind='{$remind}',pic='{$pic_path}',abstract='{$abstract}' WHERE id='{$id}'";
	    $rw = $pdo->exec($sql2);

	    if ($rw > 0) {
	        echo "<script> alert('保存成功，返回系统首页。');
	                        window.location='system.php'; //跳转首页
	             </script>";
	    } else {
	        echo "<script> alert('未有任何更改！');
	                        window.history.back(); //返回上一页
	             </script>";
	    }		
	}
	else if ($id&&$company&&$pic_str==null) {
		$sql2 = "UPDATE client SET grade='{$grade}',company='{$company}',client='{$client}',phone='{$phone}',population='{$population}',demand='{$demand}',wxvisit='{$wxvisit}',course='{$course}',remarks='{$remarks}',others='{$others}',remind='{$remind}',abstract='{$abstract}' WHERE id='{$id}'";
	    $rw = $pdo->exec($sql2);

	    if ($rw > 0) {
	        echo "<script> alert('保存成功，返回系统首页。');
	                        window.location='system.php'; //跳转到首页
	             </script>";
	    } else {
	        echo "<script> alert('未有任何更改！');
	                        window.history.back(); //返回上一页
	             </script>";
	    }

	}
	else{
		echo "<script>window.location='system.php';</script>";
	}
	
	$pdo = null;
?>