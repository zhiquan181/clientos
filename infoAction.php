<meta charset="utf-8">
<?php
    // error_reporting(0);
    header("Content-type:text/html;charset=utf-8");
    if(date_default_timezone_get() != "1Asia/Shanghai") date_default_timezone_set("Asia/Shanghai");

    // 1.连接数据库
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
    }
    catch (PDOException $e) {
        die("数据库连接失败" . $e->getMessage());
    }

    // 2.防止中文乱码
    $pdo->query("SET NAMES 'UTF8'");

    $fcid = isset($_POST['fcid'])?$_POST['fcid']:null;
    $fcontent = isset($_POST['fcontent'])?$_POST['fcontent']:null;
    $fremarks = isset($_POST['fremarks'])?$_POST['fremarks']:null;
    $followdate = date('Y-m-d H:i:s',time());

    if ($fcid&&$fcontent&&$fremarks) {

        $sql1 = "INSERT INTO cfollow VALUES (null,'{$fcid}','{$followdate}','{$fcontent}','{$fremarks}')";
        $sql2 = "UPDATE client SET lastdate='{$followdate}' WHERE id = ".$fcid;

        $rw1 = $pdo->exec($sql1);
        $rw2 = $pdo->exec($sql2);
                
        if ($rw1>0&&$rw2>0) {
            echo "<script> alert('保存成功');window.location='detail.php?id=".$fcid."';</script>";
        } else {
            echo "<script> alert('保存失败');
                            window.history.back(); //返回上一页
                 </script>";
        }
    }
    else{
        echo "<script>window.location='system.php';</script>";
    }

?>