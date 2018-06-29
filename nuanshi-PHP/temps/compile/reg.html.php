<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['config']['site_name']; ?></title>
<meta name="keywords" content="<?php echo htmlspecialchars($this->_var['config']['site_keywords']); ?>">
<meta name="description" content="<?php echo htmlspecialchars($this->_var['config']['site_description']); ?>">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link href="/favicon.ico" rel="bookmark" />
<link type="text/css" rel="stylesheet" href="/templates/ali/style/global.css" />
<link type="text/css" rel="stylesheet" href="/templates/ali/style/layout.css" />
<link type="text/css" rel="stylesheet" href="/templates/ali/style/pop.css" />
<link type="text/css" rel="stylesheet" href="/templates/ali/style/reg.css" />
<script type="text/javascript" src="/templates/ali/js/jquery.js"></script>
<script type="text/javascript" src="/templates/ali/js/jquery.xdomainajax.js?domain=.7711.com"></script>

<script type="text/javascript" src="/templates/ali/js/J7711.Common.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/templates/ali/js/fixPNG.js"></script>
<script>
  DD_belatedPNG.fix('*');
</script>
<![endif]--><script type="text/javascript" src="/js/md5.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/templates/ali/js/fixPNG.js"></script>
<script>
  DD_belatedPNG.fix('*');
</script>
<![endif]-->
</head>

<body>

<?php echo $this->fetch('top.html'); ?>


<div class="sbg01">
    
    <div class="swrap">
                  <?php echo $this->fetch('header.html'); ?>
            <!--begin:main中间区域{{{-->
        <div class="main clearfix">
            <!--begin:left左侧内容栏{{{-->
            <div class="col3 fl">
                <div class="cBox boxMain  clearfix">
                    <h3 class="th1"><p>欢迎注册<?php echo $this->_var['config']['site_name']; ?>会员（以下信息皆为必填项，请认真填写！）</p></h3>
                    <div class="regWay clearfix">
                        <form id="register_form" name="register_form" method="post" action="user.php?action=register_ok">
                        <ul class="ucWay clearfix">
                            <li>
                                <label for="code">用&nbsp;户&nbsp;名：</label>
                                <input type="text" id="member_username" name="member_username" />
                                <span id="errMsg_member_username">* 4~20个数字、字母或下划线，以字母开头</span>
                            </li>
                            <li>
                                <label for="password">输入密码：</label>
                                <input type="password" id="member_password" name="member_password" onkeyup="check_strength(this.value)"/>
                                <span id="sp_password">* 至少6个字符且不能为纯数字</span>
                            </li>
                            <li>
                                 <label for="safe_level">密码强度：</label>
                                 <span id="pwd_lower" class="success_level">低</span>
								  <span id="pwd_middle" class="success_level">中</span>
								   <span id="pwd_high" class="success_level">高</span>
                            </li>
                            <li>
                                <label for="repeat">确认密码：</label>
                                <input type="password" id="member_password_confirm" name="member_password_confirm"  />
                                <span id="sp_repeat">* 请再次输入密码</span>
                            </li>
                            <li>
                                <label for="email">电子邮箱：</label>
                               <input type="text" id="member_mail" name="member_mail" class="reg_i" />
                                <span id="errMsg_member_mail">* 邮箱是找回密码的重要凭证，请认真填写</span>
                            </li>
                            <li>
                                <label for="name">真实姓名：</label>
                                <input type="text" id="member_name" name="member_name" />
                                <span id="sp_name">* 2~4个汉字</span>
                            </li>
                            <li>
                                <label for="idcard">身份证号：</label>
                                 <input type="text" id="member_card" name="member_card" />
                                <span id="sp_idcard">* 请输入正确的身份证号码</span>
                            </li>
                            <li class="validate">
                                <label>验 证 码：</label>
                                <input type="text" id="authcode" name="authcode" class="reg_i2" />
                        <img src="authcode.php" alt="" align="absmiddle" onclick="this.src+='?'+Math.random()" id="img_sec"/>
                                <a onclick="document.getElementById('img_sec').src='/authcode.php?'+Math.random();return false;" href="javascript:void(0);">看不清，换一张</a>
                            </li>
                            <li class="b">
                                <input type="checkbox" value="" checked="checked" disabled="disabled" />
                                <label>我已经仔细阅读并接受《<a target="_blank" href="content.php?id=14"><?php echo $this->_var['config']['site_name']; ?>平台通行证服务协议</a>》</label>
                            </li>
                        </ul>
                        <button class="tjBtn" type="button" id="register_submit" value="val">提交注册</button>
                     
						<input name="sp" type="hidden" value="<?php echo $this->_var['sp']; ?>" />
						<input name="oauth_id" type="hidden" value="<?php echo $this->_var['oauth_id']; ?>" />
						<input name="oauth_account" type="hidden" value="<?php echo $this->_var['oauth_account']; ?>" />
                        </form>
                    </div>
                </div>
            </div>
            

                            <div class="col2 fr">
        <div class="box3">
            
            <div class="userWay">
                <ul>
                    <li>
                        <a class="w5" href="/login.php" style="margin-top:0;"><strong>已有账号登录</strong><p>如果您已经有账号，请点击这里登陆</p></a>
                    </li>
                </ul>
            </div>
            

            
            
            
        </div>
    </div>

        </div>
        
    </div>
    
        
<?php echo $this->fetch('footer.html'); ?>



</div>
<script type="text/javascript">
	$("#member_username").blur(function(){
		var flag=false;
		if(this.value!=''){
			$.ajax({
				type:"GET",
				url:"/user.php?action=check_member_username&member_username="+encodeURI(this.value)+"&r="+Math.random(), dataType:"text",async:false,success:function (e){
				if (e==1) {
					flag=false;
				}else{
					flag=true;
				}
			}});
		}
		if (!flag) {
			$("#errMsg_member_username").html("<img src='images/no.gif' align='absmiddle'/> <font color=red>账号已被注册</font>");
		}else{
			$("#errMsg_member_username").html("<img src='images/yes.gif' align='absmiddle'/> <font color=blue>账号可以使用</font>");
		}
	});

	$("#member_mail").blur(function(){
		var flag=false;
		if(this.value!=''){
			$.ajax({
				type:"GET",
				url:"user.php?action=check_member_mail&member_mail="+encodeURI(this.value)+"&r="+Math.random(), dataType:"text",async:false,success:function (e){	
				if (e==1) {
					flag=false;
				}else{
					flag=true;
				}
			}});
		}
		if (!flag) {
			$("#errMsg_member_mail").html("<img src='images/no.gif' align='absmiddle'/> <font color=red>邮箱已被注册</font>");
		}else{
			$("#errMsg_member_mail").html("<img src='images/yes.gif' align='absmiddle'/> <font color=blue>邮箱可以使用</font>");
		}
	});
	
	$("#member_password").blur(function(){
		var Mcolor = "#FFF",Lcolor = "#FFF",Hcolor = "#FFF";
		var m=0,Modes = 0,pwd=this.value;
		for (i=0; i<pwd.length; i++){
			var charType = 0;
			var t = pwd.charCodeAt(i);
			if (t>=48 && t <=57){
			  charType = 1;
			}else if (t>=65 && t <=90){
			  charType = 2;
			}else if (t>=97 && t <=122){
			  charType = 4;
			}else{
			  charType = 4;
			 }
			Modes |= charType;
		}

		for (i=0;i<4;i++){
			if(Modes & 1)m++;
			Modes>>>=1;
		}

		if (pwd.length<=4){
			m = 1;
		}

		switch(m){
		case 1 :
		  Lcolor = "2px solid red";
		  Mcolor = Hcolor = "2px solid #DADADA";
		break;
		case 2 :
		  Mcolor = "2px solid #f90";
		  Lcolor = Hcolor = "2px solid #DADADA";
		break;
		case 3 :
		  Hcolor = "2px solid #3c0";
		  Lcolor = Mcolor = "2px solid #DADADA";
		break;
		case 4 :
		  Hcolor = "2px solid #3c0";
		  Lcolor = Mcolor = "2px solid #DADADA";
		break;
		default :
		  Hcolor = Mcolor = Lcolor = "";
		break;
		}
		if (document.getElementById("pwd_lower")){
			document.getElementById("pwd_lower").style.borderBottom  = Lcolor;
			document.getElementById("pwd_middle").style.borderBottom = Mcolor;
			document.getElementById("pwd_high").style.borderBottom   = Hcolor;
		}
	});
	
	$("#register_submit").click(function(){
		var member_username=$('#member_username').val();
		var member_mail=$('#member_mail').val();
		var member_password=$('#member_password').val();
		var member_password_confirm=$('#member_password_confirm').val();
		if ($.trim(member_username)==''){
			alert('<?php echo $this->_var['language']['username_is_empty']; ?>');
			return false;
		}
		if ($.trim(member_password)==''){
			alert('<?php echo $this->_var['language']['password_is_empty']; ?>');
			return false;
		}
		if (member_password.length<6&&member_password.length>20){
			alert('<?php echo $this->_var['language']['member_password_text']; ?>');
			return false;
		}
		if ($.trim(member_password)!=$.trim(member_password_confirm)){
			alert('<?php echo $this->_var['language']['password_is_error']; ?>');
			return false;
		}
		if ($.trim(member_mail)==''){
			alert('<?php echo $this->_var['language']['mail_is_empty']; ?>');
			return false;
		}
		var reg=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;
		if(!reg.test(member_mail)){
			alert('<?php echo $this->_var['language']['mail_is_error']; ?>');
			return false;
		}
		
		$("#register_form").submit();

		/*$.ajax({type:"GET", url:"user.php?action=register_ok&member_username="+encodeURI(member_username)+"&member_mail="+encodeURI(member_mail)+"&member_password="+encodeURI(member_password)+"&member_password_confirm="+encodeURI(member_password_confirm)+"&r="+Math.random(), dataType:"text",async:false,success:function(e){
			if(e=='error:username_is_empty'){
				alert('<?php echo $this->_var['language']['username_is_empty']; ?>');
				return false;
			}else if(e=='error:username_is_occupy'){
				alert('<?php echo $this->_var['language']['username_is_occupy']; ?>');
				return false;
			}else if(e=='error:mail_is_empty'){
				alert('<?php echo $this->_var['language']['mail_is_empty']; ?>');
				return false;
			}else if(e=='error:mail_is_error'){
				alert('<?php echo $this->_var['language']['mail_is_error']; ?>');
				return false;
			}else if(e=='error:password_is_empty'){
				alert('<?php echo $this->_var['language']['password_is_empty']; ?>');
				return false;
			}else if(e=='error:password_is_error'){
				alert('<?php echo $this->_var['language']['password_is_error']; ?>');
				return false;
			}
		}});*/
	});
</script>
</body>
</html>