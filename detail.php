<?php
	// error_reporting(0);
	header("Content-type:text/html;charset=utf-8");

	session_start();
    $username = isset($_SESSION['username'])?$_SESSION['username']:null;
    $password = isset($_SESSION['password'])?$_SESSION['password']:null;
    if (!$username) {
        header("Location:index.php");
    }
    
	try {
	    $pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");

	}
	catch (PDOException $e) {
	    die("数据库连接失败" . $e->getMessage());
	}
	$pdo->query("SET NAMES 'UTF8'");

	$sql1 = "SELECT * FROM client WHERE id =".$_GET['id'];
	$stmt = $pdo->query($sql1);//返回预处理对象
	if($stmt->rowCount()>0){
	    $a = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
	}else{
	    die("没有要修改的数据！");
	}

	// $sql2 = "SELECT * FROM follow WHERE clientid =".$_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>客户跟进管理系统丨客户详情</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta author="Vegeta">
    <!-- <link rel="stylesheet" type="text/css" href="css/demo.css"> -->
    <link rel="stylesheet" type="text/css" href="css/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/switchery.min.js"></script>
    <style type="text/css">
    	*{margin: 0;padding: 0;}
        body{min-width: 1600px;font-family: Microsoft YaHei;background-color: rgb(244,244,244);font-size: 13px;color: #666;}

		#picture{display: none;}

		.hr{flex: 1 1;border-bottom:solid 1px #e5e5e5;margin:0 15px 15px 15px;}

    	/*滚动条 start*/
        ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
        background-color: #f8f8f8;
        }
        /*定义滚动条轨道 内阴影+圆角*/
        ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background: #fff ;
        }
        /*定义滑块 内阴影+圆角*/
        ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color:#999;
        }
        ::-webkit-scrollbar-thumb:hover {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color:#666;
        }

    	section{flex: 1 1;height: auto;margin: 15px;background-color: #fff;border-radius: 5px;box-shadow: 0 2px 3px rgba(0,0,0,0.05);}

    	.section_head{width:100%;height:80px;background-color: none;position: relative;}
        .section_head .manage{padding:0 15px;line-height: 80px;font-size: 13px;}
        .section_head a{text-decoration: none;padding:5px 15px;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
        .section_head a:hover{background-color:rgb(61,168,245);color:#fff;}

        .abc{width: 54px;position: absolute;top: 25px;right: 0;bottom: 0;left: 0;margin: auto;display: block;background-color: ;clear: both;}

        form{width: 900px;height: 1110px;margin: auto;}
        form div{clear: both;}
        form div span{display: inline-block;float: left;text-align: center;line-height: 35px;padding:10px 0 ;}
        form div span input{transition: ease .5s;}

		/*placehodel*/
		form div input:-ms-input-placeholder{color:#bbb;}/* Internet Explorer 10+ */ 
		form div input::-webkit-input-placeholder{color:#bbb;}/* WebKit browsers */
		form div input::-moz-placeholder{color:#bbb;}/* Mozilla Firefox 4 to 18 */ 
		form div input:-moz-placeholder{color:#bbb;}/* Mozilla Firefox 19+ */

        form div span input:focus {border-color: rgb(145,206,249);outline: thin dotted \9;box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.01), 0 0 8px rgb(145,206,249);}
		form div img{width: 500px;height: 281px;display: block;margin: 20px auto;cursor: pointer;border: 1px solid #eee;}
		form div textarea{width: 880px;height: 200px;text-indent: 2em;outline: none;font-size: 14px;font-family: Microsoft YaHei;padding: 10px;color: #666;margin: 20px 0;border:solid 1px #e5e5e5;}
		.form_p{text-indent: 3em;background-color: rgb(251,251,251);padding: 10px 0px;color: #999;font-size: 14px;clear: both;position: relative;}
        .form_1{width: 150px;text-align: left;text-indent: 3em;}
        .form_2{width: 300px;text-align: left;}
        .input{width: 270px;outline: none;border:solid 1px #e5e5e5;line-height: 35px;text-indent: 1em;}
        .lastdate{background-color: #e2e2e2;}
    	.submit{cursor: pointer;padding:5px 50px;background-color: #fff;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
    	.submit:hover{background-color:rgb(61,168,245);color:#fff;}

    	.follow{width: 900px;height: auto;margin: auto;padding-bottom: 50px;clear: both;}
    	.follow ul{margin: 15px auto;}
    	.follow_p{text-indent: 3em;background-color: rgb(251,251,251);padding: 10px 0px;color: #999;font-size: 14px;clear: both;}
    	.follow_li{width: 100%;height: auto;list-style: none;clear: both;border-bottom:solid 1px #e5e5e5;position: relative;line-height:150%;display: flex;padding: 8px 0;}
    	.follow_li span{display: inline-block;float: left;}
    	.follow_followdate{width:145px;height: auto;padding: 0px 0 0 15px;background-color: none;vertical-align:middle;display: inline-block;}
    	.follow_content{width: 470px;margin:0 10px 0 0;padding: 0px 0px 0 0;background-color: ;color: rgb(249,154,87);word-wrap:break-word;}
    	.follow_remarks{width: 220px;margin:0 0px 0 10px;padding: 0px 0px 0 0px;background-color: ;word-wrap:break-word;}
    	.follow_edit{width: 20px;height: 20px;background-color: ;position: absolute;right: 0;top: 8px;background-color: ;}
		.fa-pencil{cursor: pointer;color: #666;line-height: 20px;}
		.fa-window-close{position: absolute;right: 30px;top: 10px;font-size: 20px;cursor: pointer;}
		.fa-window-close:hover{color: rgb(211,36,36);}

		.follow form{height: 150px;}
		.follow .submit{cursor: pointer;padding:5px 0px;margin: 20px auto;width: 845px;background-color: #fff;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
    	.follow .submit:hover{background-color:rgb(61,168,245);color:#fff;}

    	.form_card{display: none;width: 900px;height: 200px;background-color: #fff;position: fixed;margin: auto;left: 0;right: 0;bottom: 55px;box-shadow: 0 2px 3px rgba(0,0,0,0.15);}
    	.form_card .submit{cursor: pointer;padding:5px 0px;margin: 20px auto;width: 845px;background-color: #fff;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
    	.form_card .submit:hover{background-color:rgb(61,168,245);color:#fff;}
	</style>
</head>
<body>
	<section>

		<div class="section_head">
            <span class="manage">客户管理</span><a href="system.php" class="user_add">客户列表信息</a>

            <div class="abc">
            	<input type="hidden" class="id" value="<?php echo $a['id'];?>">
            	<input type="hidden" class="status" value="<?php echo $a['status'];?>">
				<input type="checkbox" class="js-switch checkbox"/>



				<script type="text/javascript">
					var id = $(".id").val();
					var status = $(".status").val();

					var data1 = {
						xid:id,
						xstatus:1,
					}

					var data2 = {
						xid:id,
						xstatus:0,
					}

					console.log(id+" "+status+" "+data1+" "+data2);

					if (status == 1) {
						$('.checkbox').attr("checked", true);
					}else{
						$('.checkbox').attr("checked", false);
					}

					$(".checkbox").click(function () {
						if ($(this).prop("checked")) {

							$.ajax({
								url:'checkbox.php',
								type:'post',
								dataType:'json',
								data: data1,
								success:function(data){
									// console.log(data);
									// alert(data);
									// alert("开启成功！");
									window.location='detail.php?id='+id;
								}
							});
							
						} else {
							
							$.ajax({
								url:'checkbox.php',
								type:'post',
								dataType:'json',
								data: data2,
								success:function(data){
									// console.log(data);
									// alert(data);
									// alert("关闭成功！");
									window.location='detail.php?id='+id;
								}
							});
						}
					});

					//ios checkbox begin
					var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
					elems.forEach(function(html) {
					  var switchery = new Switchery(html);
					});
					console.log(elems);
					//ios checkbox end

					$(".abc .switchery").click(function () {
						$(".checkbox").click();
					});

					
					
				</script>
            </div>
        </div>

        <div class="hr"></div>

        <form method="post" action="detailAction.php" enctype="multipart/form-data" >
        	<p class="form_p">客户信息</p>
			
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

        	<div>
				<span class="form_1">等级：</span>
				<span class="form_2"><input class="input" type="text" required="true" name="grade" value="<?php echo $a['grade'];?>" placeholder="请输入等级：A 或 B 或 C 或 E 或 D 或 F" maxlength="2" autocomplete="off"></span>
				<span class="form_1">公司名：</span>
				<span class="form_2"><input class="input" type="text" required="true" name="company" value="<?php echo $a['company'];?>" placeholder="请输入公司名：..." maxlength="50"></span>
			</div>

			<div>
				<span class="form_1">名字（职位）：</span>
				<span class="form_2"><input class="input" type="text" name="client" value="<?php echo $a['client'];?>" placeholder="请输入名字（职位）：..." maxlength="50"></span>
				<span class="form_1">电话：</span>
				<span class="form_2"><input class="input" type="text" required="true" value="<?php echo $a['phone'];?>" name="phone" placeholder="请输入电话：..." maxlength="100"></span>
			</div>

			<div>
				<span class="form_1">人数产值：</span>
				<span class="form_2"><input class="input" type="text" name="population" value="<?php echo $a['population'];?>" maxlength="250" placeholder="请输入人数产值：..."></span>
				<span class="form_1">需求：</span>
				<span class="form_2"><input class="input" type="text" name="demand" value="<?php echo $a['demand'];?>" maxlength="800" placeholder="请输入需求：..."></span>
			</div>

			<div>
				<span class="form_1">微信（拜访）：</span>
				<span class="form_2"><input class="input" type="text" name="wxvisit" value="<?php echo $a['wxvisit'];?>" maxlength="50" placeholder="请输入微信拜访：是/第一次"></span>
				<span class="form_1">邀课：</span>
				<span class="form_2"><input class="input" type="text" name="course" value="<?php echo $a['course'];?>" maxlength="50" placeholder="请输入邀课：是"></span>
			</div>

			<div>
				<span class="form_1">备注：</span>
				<span class="form_2"><input class="input" type="text" name="remarks" value="<?php echo $a['remarks'];?>" maxlength="50" placeholder="请输入备注：..."></span>
				<span class="form_1">其他联系方式：</span>
				<span class="form_2"><input class="input" type="text" name="others" value="<?php echo $a['others'];?>" placeholder="请输入备注：QQ（123456789）"></span>
			</div>

			<div>
				<span class="form_1">最后跟进：</span>
				<span class="form_2"><input class="input" type="text" class="lastdate" value="<?php echo $a['lastdate'];?>" name="lastdate" readonly="readonly" placeholder=" 0000-00-00 00:00:00 "></span>
				<span class="form_1">提醒值：</span>
				<span class="form_2"><input class="input" type="number" name="remind" value="<?php echo $a['remind'];?>" placeholder="请输入提醒值：如 1 或 2 或 3 （单位为天）"></span>
			</div>

			<p class="form_p">客户明片</p>

			<div>
				<input type="hidden" name="picture_input" value="<?php echo $a['pic'];?>">
				<input type="file" id="picture" name="pic" onchange="previewImg()"/>
				<?php
					if ($a['pic']||$a['pic']!=null||$a['pic']!='') {
				?>
				<img id="picture_img" src="<?php echo $a['pic'];?>" onerror="onerror=null;src='img/error.jpg'">
				<?php
					}
					else{
				?>
				<img id="picture_img" src="img/error.jpg" onerror="onerror=null;src='img/error.jpg'">
				<?php
					}

				?>
			</div>
			
			<p class="form_p">公司简介</p>
			<div align="center">
				<textarea name="abstract"><?php echo $a['abstract'];?></textarea>
			</div>

			<div align="center">
				<input type="submit" class="submit" value="保存">
			</div>
        </form>
		
		<div class="follow">
			<p class="follow_p">客户跟进信息</p>

			<ul>
			<?php
				foreach ($pdo->query("SELECT * FROM cfollow WHERE clientid = ".$_GET['id'] ." order by followdate") as $row){
echo<<<begin
    <li class="follow_li">
    	<input class="follow_id" type="hidden" value="{$row['id']}"/>
    	<span class="follow_followdate">{$row['followdate']}</span>
    	<span class="follow_content">{$row['content']}</span>
    	<span class="follow_remarks">{$row['remarks']}</span>
    	<span class="follow_edit"><i class="fa fa-pencil fa-fw"></i></span>
    </li>
begin;
            	}
            	$pdo=null;
			?>
			</ul>

			<p class="form_p">客户跟进信息 · 添加</p>

			<form method="post" action="infoAction.php">
				<div>
					<input type="hidden" name="fcid" value="<?php echo $_GET['id'];?>">
					<span class="form_1">跟进反馈：</span>
					<span class="form_2"><input class="input" type="text" required="true" name="fcontent" placeholder="请输入跟进反馈：..." maxlength="200" autocomplete="off"></span>
					<span class="form_1">跟进备注：</span>
					<span class="form_2"><input class="input" type="text" required="true" name="fremarks" placeholder="请输入跟进备注：..." maxlength="200"></span>
				</div>

				<div align="center">
					<input type="submit" class="submit" value="保存">
				</div>
			</form>
		</div>
	</section>

	<div class="form_card">
		<p class="form_p">客户跟进信息 · 修改<i class="fa fa-window-close"></i></p>

		<form method="post" action="infoEditAction.php">
			<div>
				<input type="hidden" name="efcid" value="<?php echo $_GET['id'];?>">
				<input type="hidden" id="efid" name="efid">
				<span class="form_1">跟进反馈：</span>
				<span class="form_2"><input class="input" type="text" id="efcontent" required="true" name="efcontent" placeholder="请输入跟进反馈：..." maxlength="200" autocomplete="off"></span>
				<span class="form_1">跟进备注：</span>
				<span class="form_2"><input class="input" type="text" id="efremarks" required="true" name="efremarks" placeholder="请输入跟进备注：..." maxlength="200"></span>
			</div>

			<div align="center">
				<input type="submit" class="submit" value="保存">
			</div>
		</form>
	</div>
</body>
<script type="text/javascript">
	$("#picture_img").click(function(){
		$("#picture").click();
	});

	function previewImg() {
		var preview = document.getElementById('picture_img');
		var picture = document.getElementById('picture');
		if(picture.files[0] != undefined){
			var filevalue1 = picture.value;
			var fileType1 = filevalue1.substring(filevalue1.lastIndexOf('.'));
			console.log(fileType1);
			
			if (fileType1.match(/.jpg|.jpeg|.png|.JPG|.PNG/i)) {
				var reader  = new FileReader();
				reader.onloadend = function () {
					preview.src = reader.result;
				}
				reader.readAsDataURL(picture.files[0]);
			}
			else{
				preview.src = "img/error.jpg";
				alert('请上传正确格式的图片！');
			}
		}
		else{
			preview.src = "img/error.jpg";
			alert('请上传正确格式的图片！');
		}
	}

	// $(".fa-pencil").click(function(){
	// 	$(".form_card").fadeIn(200);			
	// });

	$(".fa-window-close").click(function(){
		$(".form_card").fadeOut(200);			
	});

	//for each复制用户到编辑表单
    jQuery('.follow .follow_li').each(function(e) {
    	console.log(this);
		var follow_li = jQuery(this);//这里的this指向 follow_li
		follow_li.find('.fa-pencil').each(function(){
		    var fa_pencil = jQuery(this); // 这里this指向 fa_pencil
		    var follow_id = follow_li.find('.follow_id').val();
		    var follow_content = follow_li.find('.follow_content').text();
		    var follow_remarks = follow_li.find('.follow_remarks').text();
		    fa_pencil.on("click",function(){
		    	jQuery(".form_card").fadeIn(200);
		    	$("#efid").val(follow_id);
		    	$("#efcontent").val(follow_content);
		    	$("#efremarks").val(follow_remarks);
		    });
		})
	});

</script>
</html>

