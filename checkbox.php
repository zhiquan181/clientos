<?php
	header("Content-type:text/html;charset=utf-8");

	$xid = isset($_POST['xid'])?$_POST['xid']:null;
	$xstatus = isset($_POST['xstatus'])?$_POST['xstatus']:null;

	$json_arr = array("xid"=>$xid,"xstatus"=>$xstatus);
	$json_obj = json_encode($json_arr);

    echo $json_obj;
    
    try {
		$pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
	}
	catch (PDOException $e) {
		die("数据库连接失败" . $e->getMessage());
	}
	$pdo->query("SET NAMES 'UTF8'");

	if ($xid && $xstatus == 1) {
		
		$sql = "UPDATE client SET status=1 where id='{$xid}'";
	    $rw = $pdo->exec($sql);

	    if ($rw > 0) {
	        // echo "ok";
	    } else {
	        // echo "no";
	    }

	    $pdo = null;
	}
	else if ($xid && $xstatus == 0) {
		$sql = "UPDATE client SET status=0 where id='{$xid}'";
	    $rw = $pdo->exec($sql);

	    if ($rw > 0) {
	        // echo "ok";
	    } else {
	        // echo "no";
	    }
	}

	$pdo = null;
?>