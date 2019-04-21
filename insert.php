<?php 
	session_start();
    $username = isset($_SESSION['username'])?$_SESSION['username']:null;
    $password = isset($_SESSION['password'])?$_SESSION['password']:null;
    if (!$username) {
        header("Location:index.php");
    }
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>客户跟进管理系统丨新增客户</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <meta author="Vegeta">
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
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
        .section_head span{padding:0 15px;line-height: 80px;font-size: 13px;}
        .section_head a{text-decoration: none;padding:5px 15px;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
        .section_head a:hover{background-color:rgb(61,168,245);color:#fff;}

        form{width: 900px;height: 1150px;border-radius: 5px;margin: auto;}
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
		.form_p{text-indent: 3em;background-color: rgb(251,251,251);padding: 10px 0px;color: #999;font-size: 14px;clear: both;}
        .form_1{width: 150px;text-align: left;text-indent: 3em;}
        .form_2{width: 300px;text-align: left;}
        .input{width: 270px;outline: none;border:solid 1px #e5e5e5;line-height: 35px;text-indent: 1em;}
        .lastdate{background-color: #e2e2e2;}
    	.submit{cursor: pointer;padding:5px 50px;background-color: #fff;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
    	.submit:hover{background-color:rgb(61,168,245);color:#fff;}

	</style>
</head>
<body>
	<section>

		<div class="section_head">
            <span>客户管理</span><a href="system.php" class="user_add">客户列表信息</a>
        </div>

        <div class="hr"></div>

        <form method="post" action="insertAction.php" enctype="multipart/form-data" >
        	<p class="form_p">客户信息</p>

        	<div>
				<span class="form_1">等级：</span>
				<span class="form_2"><input class="input" type="text" required="true" name="grade" placeholder="请输入等级：A 或 B 或 C 或 E 或 D 或 F" maxlength="2" autocomplete="off"></span>
				<span class="form_1">公司名：</span>
				<span class="form_2"><input class="input" type="text" required="true" name="company" placeholder="请输入公司名：..." maxlength="50"></span>
			</div>

			<div>
				<span class="form_1">名字（职位）：</span>
				<span class="form_2"><input class="input" type="text" name="client" placeholder="请输入名字（职位）：..." maxlength="50"></span>
				<span class="form_1">电话：</span>
				<span class="form_2"><input class="input" type="text" required="true" name="phone" placeholder="请输入电话：..." maxlength="100"></span>
			</div>

			<div>
				<span class="form_1">人数产值：</span>
				<span class="form_2"><input class="input" type="text" name="population" maxlength="250" placeholder="请输入人数产值：..."></span>
				<span class="form_1">需求：</span>
				<span class="form_2"><input class="input" type="text" name="demand" maxlength="800" placeholder="请输入需求：..."></span>
			</div>

			<div>
				<span class="form_1">微信（拜访）：</span>
				<span class="form_2"><input class="input" type="text" name="wxvisit" maxlength="50" placeholder="请输入微信拜访：是/第一次"></span>
				<span class="form_1">邀课：</span>
				<span class="form_2"><input class="input" type="text" name="course" maxlength="50" placeholder="请输入邀课：是"></span>
			</div>

			<div>
				<span class="form_1">备注：</span>
				<span class="form_2"><input class="input" type="text" name="remarks" maxlength="50" placeholder="请输入备注：..."></span>
				<span class="form_1">其他联系方式：</span>
				<span class="form_2"><input class="input" type="text" name="others" placeholder="请输入备注：QQ（123456789）"></span>
			</div>

			<div>
				<span class="form_1">最后跟进：</span>
				<span class="form_2"><input class="input" type="text" class="lastdate" name="lastdate" readonly="readonly" placeholder=" 0000-00-00 00:00:00 "></span>
				<span class="form_1">提醒值：</span>
				<span class="form_2"><input class="input" type="number" name="remind" placeholder="请输入提醒值：如 1 或 2 或 3 （单位为天）"></span>
			</div>

			<p class="form_p">客户明片</p>

			<div>
				<input type="file" id="picture" name="pic" onchange="previewImg()"/>
				<img id="picture_img" src="img/error.jpg" onerror="onerror=null;src='img/error.jpg'">
			</div>
			
			<p class="form_p">公司简介</p>
			<div align="center">
				<textarea name="abstract">此处为对客户公司的简介。</textarea>
			</div>

			<div align="center">
				<input type="submit" class="submit" value="保存">
			</div>
        </form>

	</section>
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

</script>
</html>
