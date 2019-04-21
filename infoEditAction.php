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

    $efid = isset($_POST['efid'])?$_POST['efid']:null;
    $efcid = isset($_POST['efcid'])?$_POST['efcid']:null;
    $efcontent = isset($_POST['efcontent'])?$_POST['efcontent']:null;
    $efremarks = isset($_POST['efremarks'])?$_POST['efremarks']:null;

    if ($efcid&&$efcontent&&$efremarks) {

        $sql1 = "UPDATE cfollow SET content='{$efcontent}',remarks='{$efremarks}' WHERE id = ".$efid;

        $rw1 = $pdo->exec($sql1);
                
        if ($rw1>0) {
            echo "<script> alert('保存成功');window.location='detail.php?id=".$efcid."';</script>";
        } else {
            echo "<script> alert('未有任何更改！');
                            window.history.back(); //返回上一页
                 </script>";
        }
    }
    else{
        echo "<script>window.location='system.php';</script>";
    }

?>