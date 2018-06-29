define(function () {  
    'use strict';  
    function ctrl($scope,$rootScope,$controller,$mainServices,$stateParams,$ionicScrollDelegate,$timeout,$ionicPopup,$ionicModal) {  
    	$scope.sharelist = [];// 晒单数组
    	$scope.isShareShow = true;
    	$scope.datas = []; // 评论信息数组
    	$scope.postData = {content:""}; // 评论文本框
      	var base = $controller('baseController', { $scope: $scope });
      	$scope.canLoadMore.comment = false;
      	$scope.canLoadMore.commPageMore = 0;
		
		// 分享回调
        window.shareCallBackFn = function(type){
        	showTankuangOneBtn('分享成功！');
            $("#querenBtnRollback").click(function () {
                $("#tankuangIdDiv").remove();
                $(".reveal-modal-bg").remove();
            });
        }
		
      	// 获取所有晒单列表
		function getShareOrder(more,px){
		    var wd = $stateParams.wd;// 我的晒单
		    var pid = $stateParams.pid;// 指定商品
		    var u = localStorage.getItem("uid_local");
		
		    var isHide = false;
		    if(more == "first"){
		        isHide = true;
		    }
		
		    var dataJson = {'toPage':$scope.canLoadMore.nowPageMore+1,'wd':wd,'uid':u,'pid':pid};
		    // 异步加载数据
		    $mainServices.post(basePath + "getShareOrder.jsp",dataJson,isHide).success(function(JSONObjRet){
				var JSON_list = JSONObjRet.sharelistnew;
		        var pageCount = parseInt(JSONObjRet.pageCount);
		        var recount = parseInt(JSONObjRet.recount);
		        $scope.canLoadMore.nowPageMore = parseInt(JSONObjRet.showPage)-1;
		
		        if($scope.canLoadMore.nowPageMore == pageCount || recount <= 0){
		          	$scope.canLoadMore.code = false;
		        }
		        
		        if(recount <= 0){
		          	$scope.isShareShow = false;
		          	$scope.canLoadMore.code=false;
		          	$scope.$broadcast('scroll.refreshComplete');
		          	return;
		        }else{
		          	$scope.isShareShow = true;
		        }
		
		        if(JSON_list.length > 0){
		          	for(var i=0;i<JSON_list.length;i++){
		            	var id = JSON_list[i].id;
		            	var uid = JSON_list[i].uid;
		            	var title = JSON_list[i].title;
		            	var pics = JSON_list[i].pics;
		            	var picsArray = $mainServices.splitStr(pics,",");
		            	var len = 3;
			            if(picsArray.length < 3){
			              	len = picsArray.length;
			            }
			            var ul_html = [];
			            for(var jj=0 ; jj < len; jj++){
			              	ul_html.push({pic:domain3+picsArray[jj]+""});
			            }
			
			            var content = JSON_list[i].content;
			            var num_clicklike = JSON_list[i].num_clicklike;
			            var num_comment = JSON_list[i].num_comment;
			            var intime = JSON_list[i].intime;
			            intime = intime.substring(0,16);
			
			            var headpic = JSON_list[i].headpic;
			            headpic = $mainServices.getHttpOrlocalHeadPic(headpic);
			            var nickname = JSON_list[i].nickname;
			
			            var num = JSON_list[i].num;
			
			            var recount_share = JSON_list[i].recount_share;
			            var src = "icon_dz.png";
			            if(recount_share > 0){
			              	src = "icon_dz_on.png";
			            }

						var shareIntegral = JSON_list[i].vouchers; // 晒单赠送的红包
						if(shareIntegral == ''|| shareIntegral == '0'){
							var shareIntegralFlag = false;
						} else {
							var shareIntegralFlag = true;
						}

			            var href_os = "#/"+ $scope.host +"/orderdetail_share_detail?id="+id; //晒单详情
			            var href_mp = "#/"+ $scope.host +"/userIndex/"+uid; //用户详细
			
			            var ul_style = 'qbsd';
			            if(i >= JSON_list.length-1){
			              	ul_style = '';
			            }
			            var div_style = ' ';
			            if(more == "more" && i == 0){
			              	div_style = 'margin-top:10px;';
			            }

						var typename = JSON_list[i].typename;
						if(typename == ''){
							var curJson={id:id,remark:"一元行真的就花了"+num+"块钱中啦，快来膜拜一下！",num:num,content:content,ul_style:ul_style,div_style:div_style,href_mp:href_mp,headpic:headpic,nickname:nickname,intime:intime,href_os:href_os,
								title:title,ul_html:ul_html,num_comment:num_comment,src:src,num_clicklike:num_clicklike,uid:uid,plurl:'#/'+ $scope.host +'/comment?id='+id,shareIntegralFlag:shareIntegralFlag,shareIntegral:shareIntegral};
							$scope.sharelist.push(curJson);
						} else {
							var curJson={id:id,remark:"一元行"+typename+"活动中啦，快来膜拜一下！",num:num,content:content,ul_style:ul_style,div_style:div_style,href_mp:href_mp,headpic:headpic,nickname:nickname,intime:intime,href_os:href_os,
								title:title,ul_html:ul_html,num_comment:num_comment,src:src,num_clicklike:num_clicklike,uid:uid,plurl:'#/'+ $scope.host +'/comment?id='+id,shareIntegralFlag:shareIntegralFlag,shareIntegral:shareIntegral};
							$scope.sharelist.push(curJson);
						}
						
		          	}
		          	$ionicScrollDelegate.resize();
			            
			        if($scope.canLoadMore.nowPageMore == pageCount || recount <= 0){
			            $scope.canLoadMore.code = false;
			        } else {
			            $timeout(function(){
			                $scope.canLoadMore.code = true;
			            },200);
			        }
					if(more == "more"){
					    $scope.$broadcast('scroll.infiniteScrollComplete');
					} else if(more != "first"){
					    $scope.$broadcast('scroll.refreshComplete');
					}
		        }
		    });
		
		}
		
		// 点赞
	    $scope.dianzan = function(id){
	      	var u = localStorage.getItem("uid_local");
	      	if(u == null || u == ""){
	        	alert("请先登录");
	        	return;
	      	}
	      	var src = angular.element("#dianzan_"+id).attr("src");
	      	if(src == "img/icon_dz_on.png"){
	        	alert("不能重复点赞");
	        	return;
	      	}
	      	var num_clicklike = angular.element("#num_clicklike_"+id).html();
		    var num_clicklike_int = parseInt(num_clicklike);
		    var url = basePath + "setDianzan.jsp";
		    var dataJson = {'u':u,'id':id};
		    $mainServices.post(url,dataJson,false).success(function(jsonRet){
		        if(jsonRet != null){
		          	var code = jsonRet.code;
		          	if(code == 200){
		            	angular.element("#num_clicklike_"+id).html(num_clicklike_int+1);
		            	angular.element("#dianzan_"+id).attr("src","img/icon_dz_on.png");
		          	} else {
		            	alert("网络异常，请稍后重试");
		          	}
		        }
		    });
	    };
		
		// 分享
		var myPopup = '';
	    $scope.showPopup = function(remark,content) {
	      	myPopup = $ionicPopup.show({
	        	templateUrl:'templates/index/shareTemplate.html',
	        	title: '分享给好友',
	        	scope: $scope,
	        	buttons: [
	          		{ text: '取消' }
	        	]
	      	});
	      	myPopup.then(function(res) {
	        	//console.log('Tapped!', res);
	      	});
	
	      	$scope.WeixinShare=function(type){
	        	$mainServices.WeixinShare(type,remark,content);
	        	$timeout(function(){
	          		myPopup.close();
	        	},1000);
	      	}
	    };
	    // 看大图
	    $scope.move = function(index,event) {
	      	event = event.toElement;
	      	var len = angular.element(event).parent().parent().find("li").length;
	      	$rootScope.gBanList = [];
	      	for(var i=0;i<len;i++){
	        	$rootScope.gBanList.push({pic:angular.element(event).parent().parent().find("li").eq(i).find('p').attr('back-image-src')});
			}
	
	      	$rootScope.myActiveSlide = index;
	    };
	    
		// 初始化
		getShareOrder('first');// 获取晒单列表
		
		$scope.doRefresh=function(){
	     	$scope.canLoadMore.nowPageMore = 0;
	      	$scope.sharelist = [];
	      	getShareOrder(); //获取晒单列表
	    };
	    $scope.loadMore=function(){
	      	// $scope.canLoadMore.nowPageMore++;
	      	getShareOrder('more'); //获取晒单列表
	    };
	    // 评论
	    $scope.toComment = function(id) {
	      	$scope.datas = [];
	      	$scope.commentid = id;
	      	$scope.postData.content = "";
	      	pl("first",id);//获取评论列表
	      	$scope.modal.show();
	    };
	    // 获取评论信息
	    function pl(more,id){
	      	var nowPageMore = $scope.canLoadMore.commPageMore;
	      	var toPage = 1;
	      	if(more == 'more'){
	        	toPage = (nowPageMore + 1);
	      	}
	      	var isHide = false;
		  	if(more == "first"){
		    	var isHide = true;
		  	}  
		  
	      	var url = basePath + "pl.jsp";
	      	var dataJson = {'toPage':toPage,'id':id};
	      	// 异步加载数据
	        $mainServices.post(url,dataJson,isHide).success(function(JSONObjRet){
	        	if(JSONObjRet == null || JSONObjRet == undefined || JSONObjRet == ""){
	        		return;
	        	}
	        	var JSON_list = JSONObjRet.prolist;
	        	var pageCount = parseInt(JSONObjRet.pageCount);
	        	var recount = parseInt(JSONObjRet.recount);
	        	$scope.canLoadMore.commPageMore = parseInt(JSONObjRet.showPage);
	
	        	if(recount <= 0){
	          		$scope.canLoadMore.comment = false;
	        	}
	        	if(JSON_list.length > 0){
	          		for(var i=0;i<JSON_list.length;i++){
			            var id = JSON_list[i].id;
			            var uid = JSON_list[i].uid;
			            var content = JSON_list[i].content;
			            var intime = JSON_list[i].intime;
			            intime = intime.substring(5,16);
			            // 查询会员信息
			            var headpic = JSON_list[i].headpic;
			            var nickname = JSON_list[i].nickname;
			            headpic = $mainServices.getHttpOrlocalHeadPic(headpic);
			            
			            var json = {uid:uid,headpic:headpic,nickname:nickname,content:content,intime:intime,userUrl:'#/'+$scope.host+'/userIndex/'+uid};
			            $scope.datas.push(json);
			        }
	        	}	
	        	if($scope.canLoadMore.commPageMore == pageCount || recount <= 0){
	          		$scope.canLoadMore.comment = false;
	        	} else {
	          		$ionicScrollDelegate.resize();
	          		$timeout(function(){
	            		$scope.canLoadMore.comment=true;
	          		},500);
	        	}
	        	if(more == "more"){
	        		$scope.$broadcast('scroll.infiniteScrollComplete');
	        	} else if(more != "first"){
	        		$scope.$broadcast('scroll.refreshComplete');
	        	}
	      	});
	    }
	    
	    // 提交评论
	    $scope.plSubmit = function(id){
	      	var u = localStorage.getItem("uid_local");
	      	if(u == null || u == ""){
	        	alert("请先登录");
	        	return;
	      	}
	
	      	// 验证参数
	      	if($scope.postData.content == ""){
	        	alert("内容不能为空");
	        	return;
	      	}
	      	var url = basePath + "plSubmit.jsp";
	      	var dataJson = {'u':u,'id':id,'pl_content':$scope.postData.content};
	      	$mainServices.post(url,dataJson,true).success(function(jsonRet){
	        	if(jsonRet != null){
	          		var code = jsonRet.code;
	          		if(code == 200){
	            		// 清空内容
	            		$scope.postData.content = "";
	            		// 重新加载pl内容
	            		$scope.datas = [];
	            		pl("",id);
	            		// 修改评论
	            		for(var t=0;t<$scope.sharelist.length;t++){
	              			if($scope.sharelist[t].id == id){
	                			$scope.sharelist[t].num_comment++;
	                			break;
	              			}
	           			 }
	          		} else {
	            		alert(jsonRet.message);
	          		}
	        	}
	      	});
	    };
	    
	    $ionicModal.fromTemplateUrl('templates/index/comment.html', {
	      	scope: $scope,
	      	animation: 'slide-in-up'
	    }).then(function(modal) {
	      	$scope.modal = modal;
	    });
	    
	    $scope.closeModal = function() {
			$scope.modal.hide();
		};
	    
	    $scope.doRefreshComment=function(){
	      	$scope.datas = [];
	      	pl("",$scope.commentid); //获取评论列表
	    };
	    $scope.loadMoreComment=function(){
      		pl("more",$scope.commentid); //获取评论列表
    	};
    	
    	// 当我们用完模型时，清除它
	    $scope.$on('$destroy', function() {
	      	$scope.modal.remove();
	      	$rootScope.gBanList = [];
	      	if(myPopup != ''){
	        	myPopup.close();
	      	}
	    });
	    
    }  
  	
    ctrl.$inject = ['$scope','$rootScope','$controller','$mainServices','$stateParams','$ionicScrollDelegate','$timeout','$ionicPopup','$ionicModal'];  
    return ctrl;  
      
}); 