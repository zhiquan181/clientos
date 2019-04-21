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
    <title>客户跟进管理系统丨首页</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <meta author="Vegeta">
    <style type="text/css">
        *{margin: 0;padding: 0;}
        body{min-width: 1600px;font-size: Microsoft YaHei;background-color: rgb(244,244,244);}
        body li,body a{font-size: 13px;color: #666;text-decoration: none;}

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

        /* webkit, opera, IE9 */
        ::selection { background:rgb(95,244,233);color: #fff;}
        /* mozilla firefox */
        ::-moz-selection { background:rgb(95,244,233);color: #fff;}

        section{flex: 1 1;height: auto;margin: 15px;background-color: #fff;border-radius: 5px;box-shadow: 0 2px 3px rgba(0,0,0,0.05);}

        .section_head{width:100%;height:80px;background-color: none;position: relative;}
        .section_head span{padding:0 15px;line-height: 80px;font-size: 13px;}
        .section_head .insertclient{text-decoration: none;padding:5px 15px;display:inline-block;border:2px solid rgb(145,206,249);color:rgb(145,206,249);transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
        .section_head .insertclient:hover{background-color:rgb(61,168,245);color:#fff;}
        .section_head_search{width:292px;height:35px;background-color:aqua;position: absolute;margin:auto;left:0;right:0;top:0;bottom:0;clear: both;}
        .section_head_search input{float: left;}
        .section_head_search_input{width: 200px;height:35px;background-color: #fff;border: 1px solid #e5e5e5;color: #383838;-webkit-transition: border-color ease-in-out 0.15s;-o-transition: border-color ease-in-out 0.15s;transition: border-color ease-in-out 0.15s;outline: none;padding: 0px 20px 0px 20px;}
        .section_head_search_input::-webkit-input-placeholder {color:#bbb;}
        .section_head_search_submit{width: 50px;height:37px;background-color: rgb(145,206,249);color:#fff;font-size: 14px;outline: none;border: none;cursor: pointer;transition: ease background-color .3s;-moz-transition: ease background-color .3s;/* Firefox 4 */-webkit-transition: ease background-color .3s;/* Safari 和 Chrome */-o-transition: ease background-color .3s;/* Opera */}
        .section_head_search_submit:hover{background-color: rgb(61,168,245);}

        .section_head_admin{width: 150px;position: absolute;top: 0;right: 0;display: block;background-color: ;clear: both;}
        .section_head_admin img{width: 50px;height: 50px;position: absolute;top: 15px;border-radius: 50px;box-shadow: 0 2px 3px rgba(0,0,0,0.05);}
        .section_head_admin .remind_number{width: 20px;height: 20px;display: inline-block;background-color: ;position: absolute;top: 15px;left: 40px;}
        .section_head_admin .remind_number u{width: auto;height: auto;text-decoration: none;text-align: center;padding: 2px 5px;display: inline-block;font-size: 12px;position: absolute;top: 0px;left: 0;background-color: rgb(252,100,100);border-radius: 20px;color: #fff;line-height: 20px;}
        .loginout{text-decoration: none;position:absolute;right: 15px;top: 30px;font-size: 13px;transition: color ease .3s;}
        .loginout:hover{color:rgb(61,168,245);}

        .ul_head{width: 100%;height: 60px;clear: both;background-color: rgb(249,250,252);}
        .ul_head li{height: 60px;line-height: 60px;font-weight: regular;font-size: 15px;padding: 0 10px;float: left;list-style: none;text-align: center;}
        .ul_head_id{width: 4%;}
        .ul_head_grade{width: 5%;}
        .ul_head_company{width: 8%;}
        .ul_head_client{width: 5%;}
        .ul_head_phone{width: 8%;}
        .ul_head_population{width: 8%;}
        .ul_head_demand{width: 15%;}
        .ul_head_wxvisit{width: 5%;}
        .ul_head_course{width: 5%;}
        .ul_head_remarks{width: 9%;}
        .ul_head_lastdate{width: 8%;}
        .ul_head_remind{width: 4%;}

        .ul_client{width: 100%;height: 50px;clear: both;}
        .ul_client li{height: 50px;line-height: 50px;padding: 0 10px;float: left;list-style: none;text-align: center;display:block;overflow-x:auto;overflow-y:hidden;white-space:nowrap;}
        .ul_client_id{width: 4%;}
        .ul_client_grade{width: 5%;}
        .ul_client_company{width: 8%;}
        .ul_client_client{width: 5%;}
        .ul_client_phone{width: 8%;}
        .ul_client_population{width: 8%;}
        .ul_client_demand{width: 15%;}
        .ul_client_wxvisit{width: 5%;}
        .ul_client_course{width: 5%;}
        .ul_client_remarks{width: 9%;}
        .ul_client_lastdate{width: 8%;}
        .ul_client_remind{width: 4%;}

        /*滚动条 start*/
        .ul_client li::-webkit-scrollbar {
        width: 0px;
        height: 0px;
        background-color: #f8f8f8;
        }
        /*定义滚动条轨道 内阴影+圆角*/
        .ul_client li::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background: #fff ;
        }
        /*定义滑块 内阴影+圆角*/
        .ul_client li::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color:#999;
        }
        .ul_client li::-webkit-scrollbar-thumb:hover {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color:#666;
        }

        /*.count{background-color: yellow;}*/
    </style>
</head>
<body>
    <section> 
        <div class="section_head">
            <span>客户管理</span><a href="insert.php" class="insertclient" class="user_add">新增客户信息</a>
            
            <div class="section_head_search">
                <form method="get">
                    <input class="section_head_search_input" type="text" name="searchClient" id="searchClient" placeholder="客户检索">
                    <input class="section_head_search_submit" type="submit" id="search" value="搜索">
                </form>
            </div>

            <div class="section_head_admin">
                <img src="img/user.jpg" ondragstart="return false">
                <div class="remind_number"></div>
                <a class="loginout" href="loginout.php">退出系统</a>
            </div>
        </div>

        <div class="hr"></div>

        <ul class="ul_head">
            <li class="ul_head_id">序号</li>
            <li class="ul_head_grade">等级</li>
            <li class="ul_head_company">公司名</li>
            <li class="ul_head_client">名字（职位）</li>
            <li class="ul_head_phone">电话</li>
            <li class="ul_head_population">人数产值</li>
            <li class="ul_head_demand">需求</li>
            <li class="ul_head_wxvisit">微信（拜访）</li>
            <li class="ul_head_course">邀课</li>
            <li class="ul_head_remarks">备注</li>
            <li class="ul_head_lastdate">最后跟进日期</li>
            <li class="ul_head_remind">提醒值</li>            
        </ul>

        <?php
            // error_reporting(0);

            $searchClient = isset($_GET['searchClient'])?$_GET['searchClient']:null;

            $pdo = new PDO("mysql:host=localhost;dbname=test;", "root", "");
            $pdo->query("SET NAMES 'UTF8'");
 
            // foreach ($pdo->query("SELECT * from client where company like '%".$searchClient."%' ORDER BY company") as $row){
            foreach ($pdo->query("SELECT * from client where company like '%".$searchClient."%' OR phone like '%".$searchClient."%' ORDER BY company") as $row){
                // $xdate =  mb_substr($row['xdate'],0,10,'utf-8');//截取时间长度
echo<<<begin
    <div class="form_client">
        <input class="form_client_id" type="hidden" value="{$row['id']}"/>
        <input class="form_client_grade" type="hidden" value="{$row['grade']}"/>
        <input class="form_client_company" type="hidden" value="{$row['company']}"/>
        <input class="form_client_client" type="hidden" value="{$row['client']}"/>
        <input class="form_client_phone" type="hidden" value="{$row['phone']}"/>
        <input class="form_client_population" type="hidden" value="{$row['population']}"/>
        <input class="form_client_demand" type="hidden" value="{$row['demand']}"/>
        <input class="form_client_wxvisit" type="hidden" value="{$row['wxvisit']}"/>
        <input class="form_client_course" type="hidden" value="{$row['course']}"/>
        <input class="form_client_remarks" type="hidden" value="{$row['remarks']}"/>
        <input class="form_client_lastdate" type="hidden" value="{$row['lastdate']}"/>
        <input class="form_client_remind" type="hidden" value="{$row['remind']}"/>
        <input class="form_client_status" type="hidden" value="{$row['status']}"/>
    </div>
begin;
            }
        ?>

        <script src="js/vue.js"></script>
        <div id="el">
            <ul class="ul_client" v-for="item in list">
                <li class="ul_client_id"><a :href="'detail.php?id='+item.cid">{{ item.id }}</a></li>
                <li class="ul_client_grade">{{ item.grade }}</li>
                <li class="ul_client_company">{{ item.company }}</li>
                <li class="ul_client_client">{{ item.client }}</li>
                <li class="ul_client_phone">{{ item.phone }}</li>
                <li class="ul_client_population">{{ item.population }}</li>
                <li class="ul_client_demand">{{ item.demand }}</li>
                <li class="ul_client_wxvisit">{{ item.wxvisit }}</li>
                <li class="ul_client_course">{{ item.course }}</li>
                <li class="ul_client_remarks">{{ item.remarks }}</li>
                <li class="ul_client_lastdate" v-bind:class="item.classstr">{{ item.lastdate }}</li>
                <li class="ul_client_remind">{{ item.remind }}天</li>
                <!-- <li class="ul_client_remind">{{ item.jishi }}</li> -->
            </ul>
        </div>
        <script type="text/javascript">
            var json = [];
    
            var i = 1;
            jQuery('.form_client').each(function(e) {
                var form_client = jQuery(this);
                form_client.each(function(){
                    var now = new Date();
                    var now_t = now.getTime()/1000;
                    var now_int = parseInt(now_t);
                
                    var cid = form_client.find('.form_client_id').val();
                    var grade = form_client.find('.form_client_grade').val();
                    var company = form_client.find('.form_client_company').val();
                    var client = form_client.find('.form_client_client').val();
                    var phone = form_client.find('.form_client_phone').val();
                    var population = form_client.find('.form_client_population').val();
                    var demand = form_client.find('.form_client_demand').val();
                    var wxvisit = form_client.find('.form_client_wxvisit').val();
                    var course = form_client.find('.form_client_course').val();
                    var remarks = form_client.find('.form_client_remarks').val();
                    var lastdate = form_client.find('.form_client_lastdate').val();
                    var remind = form_client.find('.form_client_remind').val();
                    var status = form_client.find('.form_client_status').val();
                    // console.log(lastdate);
                    // console.log(status);
                    var endtime_date = new Date(lastdate);
                    var endtime_timestamp = endtime_date.getTime()/1000;
                    var end_int = parseInt(endtime_timestamp);

                    var remind_int = parseInt(remind);
                    var remind_t = remind_int*86400;
                    var tar = end_int+remind_t-now_int;
                    // console.log(tar);
                    
                    var j = {};
                    j.id = i;
                    j.cid = cid;
                    j.grade = grade;
                    j.company = company;
                    j.client = client;
                    j.phone = phone;
                    j.population = population;
                    j.demand = demand;
                    j.wxvisit = wxvisit;
                    j.course = course;
                    j.remarks = remarks;
                    j.lastdate = lastdate;
                    j.remind = remind;
                    j.time = tar;
                    j.status = status;
                    json.push(j);
                });
                i++;
            });
            
            var client = {list:json};
            // console.log(client);
        </script>
        <script>
            new Vue({
                el: '#el',
                data:client,
                //方法体
                methods:
                {
                    num: function (n) {
                        return n < 10 ? '0' + n : '' + n
                    },
                    timeToData:function ( maxtime ) {
                        second = Math.floor( maxtime % 60);       //计算秒
                        minite = Math.floor((maxtime / 60) % 60); //计算分
                        hour = Math.floor((maxtime / 3600) % 24 ); //计算小时
                        day = Math.floor((maxtime / 3600) / 24);//计算天
                        if(day<=0){
                            day = 0;
                        }
                        if(hour<=0){
                            hour = 0;
                        }
                        if(minite<=0){
                            minite = 0;
                        }
                        if(second<=0){
                            second = 0;
                        }
                        return day+'天'+this.num(hour)+'时'+this.num(minite)+'分'+this.num(second)+'秒';
                    },
                    getTime:function () {
                        var that = this;
                        // console.log(this);
                        setInterval(function ()
                        {
                            that.list.forEach(function (value) {
                                var shijian = that.timeToData(value.time);
                                
                                if ( typeof value.jishi == 'undefined' ) {
                                    that.$set(value,'jishi',shijian);
                                } else {
                                    value.jishi = shijian;
                                }

                                // if ( value.time>0 ) {
                                //     -- value.time;
                                //     tid =  value.id-1;
                                //     this.el.childNodes[tid].children[10].style.color = 'rgb(156,228,127)';
                                // } else {
                                //     value.time = 0;
                                //     tid =  value.id-1;
                                //     this.el.childNodes[tid].children[10].style.color = 'red';
                                //     this.el.childNodes[tid].children[10].classList.add("count");
                                // }
                                
                                if (value.status==1) {
                                    if ( value.time>0 ) {
                                        -- value.time;
                                        tid =  value.id-1;
                                        this.el.childNodes[tid].children[10].style.color = 'rgb(156,228,127)';
                                    } else {
                                        value.time = 0;
                                        tid =  value.id-1;
                                        this.el.childNodes[tid].children[10].style.color = 'red';
                                        this.el.childNodes[tid].children[10].classList.add("count");
                                    }
                                }else{
                                    
                                }
                                

                                var count = $(".count").length;
                                // console.log(count);
                                $(".remind_number").html("<u>"+count+"</u>");
                            })
                        }, 1000);
                    }
                },
                //页面打开渲染之前就调用
                created: function () {
                    var that = this;
                    that.getTime();
                }
            });
        </script>
    </section> 

    <script type="text/javascript">
        jQuery("body .ul_client:even").css("background","#fff");
        jQuery("body .ul_client:odd").css("background","rgb(249,250,252)");


        /**
         * [description] 相同Class类名变色
         * @param  {[type]} e) 
         * @return {[type]}    [description]
         * <div class="ul_client">
         * <div class="ul_client_domain">k10000.top</div>
         * </div>
         *
         * <div class="ul_client">
         * <div class="ul_client_domain">k10001.top</div>
         * </div>
         *
         * <div class="ul_client">
         * <div class="ul_client_domain">k10002.top</div>
         * </div>
         */
        // jQuery('.ul_client').each(function(e) {
        //     var ul_client = jQuery(this);
        //     ul_client.each(function(){
        //         var domain_css = ul_client.find(".ul_client_domain").text();

        //         if(domain_css.length>0){
        //             var tar = domain_css.split(".")[0];
        //             var str = String(tar);
        //             // console.log(typeof(tar));
        //             ul_client.find(".ul_client_domain").addClass(tar);
        //             var tar_css = "."+str;
        //             // console.log(tar_css);
        //             var r=Math.floor(Math.random()*256);
        //             var g=Math.floor(Math.random()*256);
        //             var b=Math.floor(Math.random()*256);
        //             $(tar_css).css("background-color","rgba("+r+","+g+","+b+",0.2)");
        //         }
        //     });
        // });
    </script>

    
</body>
</html>
