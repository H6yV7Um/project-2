 <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <link href="./css/bootstrap-responsive.min.css" rel="stylesheet" />
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
    <link href="./css/font-awesome.css" rel="stylesheet" />
    
    <link href="./css/adminia.css" rel="stylesheet" /> 
    <link href="./css/adminia-responsive.css" rel="stylesheet" /> 
    
    <link href="./css/pages/dashboard.css" rel="stylesheet" /> 
    

    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar">1</span> 
				<span class="icon-bar">2</span> 
				<span class="icon-bar">3</span> 				
			</a>
			
			<a class="brand" href="">【<?php echo $_SESSION['admin_name']; ?>】<?php echo $this->_var['language']['welcome']; ?></a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">
					<li>
						<a href="#"><span class="badge badge-success"></span></a>
					</li>
					
					<li class="divider-vertical"></li>
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#" onclick="toggle('div1')">
							常用操作 <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu" id="div1">
						<li>
								<a href="/" target="_blank"> <?php echo $this->_var['language']['web_main']; ?>  </a>
							</li>
							<li>
								<a href="?action=start"> <?php echo $this->_var['language']['menu_main']; ?>  </a>
							</li>
							
							<li>
								<a href="?action=start&do=log_list"><?php echo $this->_var['language']['menu_log']; ?></a>
							</li>
							<li>
								<a href="?action=start&do=clear_cache"><?php echo $this->_var['language']['menu_clear']; ?></a>
							</li>
							
							
							<li class="divider"></li>
							
							<li>
								<a href="?do=logout"><?php echo $this->_var['language']['menu_logout']; ?></a>
							</li>
						</ul>
					</li>
				</ul>
				
			</div> 
			
		</div> 
		
	</div> 
	
</div> 
<script type="text/javascript">
function batch(form,checkbox){
	var f=document.forms[form];
	for (var i=0;i<f.elements.length;i++){
		if (f.elements[i].type=='checkbox'){
			if (checkbox.checked){
				f.elements[i].checked=true;
			}else{
				f.elements[i].checked=false;
			}
		}
	}
}

function batch_do(form,mode){
	var f=document.forms[form];
	var s=false;
	for (var i=0;i<f.elements.length;i++){
		if (f.elements[i].type=='checkbox'){
			if (f.elements[i].checked){
				s=true;
			}
		}
	}
	if (s==false){
		return false;
	}
	if (mode=="best_yes"){
		f.action='?action=content&do=best_yes';
		f.submit();
	}
	if (mode=="best_no"){
		f.action='?action=content&do=best_no';
		f.submit();
	}
	if (mode=="delete"){
		f.submit();
	}
}
</script>