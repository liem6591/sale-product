     var type = '4' ;//查询已经审批通过

	 function formatMoney(val){
	 	val = $.trim(val+"") ;
	 	val = val.replace("$","") ;
	 	return $.trim(val) ;
	 }

	$(function(){
		   var sqlKey = flag == 1 ?'sql_purchase_plan_list':'sql_purchase_plan_list_executor' ;
		  
			$(".grid-content").llygrid({
				columns:[
		           	{align:"center",key:"ID",label:"",width:"7%",format:function(val,record){
						var status = record.STATUS ;
						var html = [] ;
						if( status == 1){
							if( $delete_pp ) html.push("<a href='#' class='delete_purchase_plan' val='"+val+"'>删除</a>&nbsp;") ;
							if( $create_pp ) html.push("<a href='#' class='edit_purchase_plan' val='"+val+"'>修改</a>&nbsp;") ;

							return html.join("") ;
						}
						return "" ;
					},permission:function(){
						return $create_pp || $delete_pp ;
					}},
		           	{align:"center",key:"NAME",label:"采购计划名称",width:"15%",forzen:false,align:"left"},
		           	{align:"center",key:"PLAN_TIME",label:"计划采购时间",width:"9%"},
		           	{align:"center",key:"TYPE",label:"采购用途",width:"7%",format:function(val,record){
		           		if(val == 1){
		           			return "产品试销" ;
		           		}else{
		           			return "正式采购" ;
		           		}
		           	}},
		           	{align:"center",key:"STATUS1",label:img1,group:"状态",width:"4%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action' planId='"+record.ID+"' status=1>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"STATUS2",label:img2,group:"状态",width:"4%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action'  planId='"+record.ID+"' status=2>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"STATUS3",label:img3,group:"状态",width:"4%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action'  planId='"+record.ID+"' status=3>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"STATUS4",label:img4,group:"状态",width:"4%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action'  planId='"+record.ID+"' status=4>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"STATUS5",label:img5,group:"状态",width:"3%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action'  planId='"+record.ID+"' status=5>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"STATUS6",label:img6,group:"状态",width:"3%",format:function(val,record){
		           		return "<a href='javascript:void(0)' onClick='StatusClick(this)' class='status-action'  planId='"+record.ID+"' status=6>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"EXECUTOR_NAME",label:"负责人",width:"4%"},
		           	{align:"center",key:"USERNAME",label:"创建人",width:"4%"},
		           	{align:"center",key:"CREATE_TIME",label:"创建时间",width:"10%"},
					{align:"center",key:"ID",label:"操作",width:"15%",format:function(val,record){
						var status = record.STATUS ;
						var html = [] ;
						if( status == 1){
							if($add_pp_product)html.push("<a href='#' class='add-outer-product' val='"+val+"'>添加产品</a>&nbsp;") ;
						
							if($export_pp)html.push("<a href='#' class='export-product' val='"+val+"'>导出</a>&nbsp;") ;
							if($print_pp)html.push("<a href='#' class='print-product' val='"+val+"'>打印</a>&nbsp;") ;
							return html.join("") ;
						}
						return "" ;
					}}
		         ],
		         ds:{type:"url",content:contextPath+"/grid/query/<?php echo $flag;?>"},
				 limit:5,
				 pageSizes:[5,10,20,30,40],
				 height:130,
				 title:"筛选列表",
				 indexColumn:false,
				 querys:{executor:loginId,sqlId:sqlKey},
				 loadMsg:"数据加载中，请稍候......",
				 rowClick:function(rowIndex , rowData){
				 	if(isLinkClick){
				 		isLinkClick = false ;
				 		 return ;
				 	}
				 	
				 	var planId = rowData.ID  ;
				 	$(".grid-content-details").llygrid("reload",{planId:planId,status:""}) ;
				 }
			}) ;
			
			var isLinkClick = false ;
			window.StatusClick = function (el){
			 	isLinkClick = true ;
				var planId = $(el).attr("planId") ;
				var status = $(el).attr("status") ;
				
				var params = {} ;
				params.planId = planId ;
				if(status == 1){
					params.status1 = 1 ;
				}else{
					params.status = status ;
				}
				$(".grid-content-details").llygrid("reload",params) ;
				return false ;
			} ;
			
			$(".print-product").live("click",function(){
				var val = $(this).attr("val") ;
				openCenterWindow(contextPath+"/sale/purchaseListPrint/"+val,1000,700) ;
			}) ;
			
			
			$(".export-product").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				$("#exportIframe").attr("src",contextPath+"/sale/exportForPurchasePlanDetails/"+val) ;
			}) ;
			
			
			$(".query-btn").click(function(){
				$(".grid-content").llygrid("reload",{name:$("#name").val(),type:$("#type").val()}) ;
			}) ;
			
			$(".add-outer-product").live("click",function(){
				var val = $(this).attr("val") ;
				//openCenterWindow(contextPath+"/sale/addPurchasePlanOuterProduct/"+val,600,400) ;
				openCenterWindow(contextPath+"/page/forward/Sale.selectPurchaseProduct/"+val,900,600,function(){
					$(".grid-content").llygrid("reload",{},true) ;
				}) ;
			});
			
			$(".add-product").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				openCenterWindow(contextPath+"/sale/selectPurchaseProduct/"+val,1020,600,function(){
					$(".grid-content").llygrid("reload",{},true) ;
				}) ;
			}) ;
			
			$(".edit_purchase_plan").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				openCenterWindow(contextPath+"/sale/createPurchasePlan/"+val,600,440) ;
				return false;
			}) ;
			
			$(".delete_purchase_plan").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				if(window.confirm("确认删除该采购计划吗？")){
					$.dataservice("model:Sale.deletePurchasePlan",{planId:val},function(){
						window.location.reload() ;
					}) ;
					
				}
			}) ;
			
			
			$(".create-plan").click(function(){
				openCenterWindow(contextPath+"/sale/createPurchasePlan/",600,430) ;
			}) ;
			
			$(".grid-content-details").llygrid({
				columns:[
					//{align:"center",key:"ID",label:"编号",width:"4%"},
					{align:"left",key:"ID",label:"操作",forzen:false,width:"3%",format:function(val,record){
						var isSku = record.SKU?true:false ;
						
						var status = record.STATUS ;
						var html = [] ;

						if(status == 4 || status == 6){
							isSku && html.push('<a href="#" title="查看" class="edit-action" val="'+val+'"><img src="/'+fileContextPath+'/app/webroot/img/pre_print.gif"/></a>&nbsp;') ;
						}else{
							isSku && html.push('<a href="#" title="处理" class="edit-action" val="'+val+'"><img src="/'+fileContextPath+'/app/webroot/img/edit.png"/></a>&nbsp;') ;
							
						}
						
						return html.join("") ;	
					}},
					{align:"left",key:"STATUS",label:"状态",forzen:false,width:"7%",format:{type:'json',content:{1:'编辑中',2:'待审批',3:'审批通过',4:'审批不通过，结束采购',5:'已采购',6:'已验收（QC）'}}},
		           	{align:"left",key:"SKU",label:"货品SKU", width:"8%",format:{type:'realSku'}},
		           	{align:"center",key:"IMAGE_URL",label:"Image",width:"4%",forzen:false,align:"left",format:{type:'img'}},
		           	{align:"center",key:"TITLE",label:"标题",width:"10%",forzen:false,align:"left"},
		        	{align:"center",key:"EXECUTOR_NAME",label:"执行用户",width:"6%",forzen:false,align:"left"},
		           	{align:"center",key:"PLAN_NUM",label:"采购数量",width:"6%"},
		           	{align:"center",key:"QUOTE_PRICE",label:"采购价",width:"6%"},
		           	{align:"center",key:"AREA",label:"采购地区",width:"6%",
		           			format:{type:"json",content:{"china":"大陆","taiwan":"台湾","american":"美国"}}},
		          
		           	{align:"center",key:"PROVIDOR_NAME",label:"供应商信息",width:"8%",format:function(val,record){
		           		if(!val) return "";
		           		return "<a href='#' supplier-id='"+record.PROVIDOR+"'>"+val+"</a>" ;
		           	}} ,
		           	{align:"center",key:"SAMPLE",label:"样品",format:{type:"json",content:{'0':'无','1':'准备中','2':'有'}},width:"6%"},
		            {align:"center",key:"SAMPLE_CODE",label:"样品编码",width:"8%"}
		           	
		         ],
		         ds:{type:"url",content:contextPath+"/grid/query"},
				 limit:30,
				 pageSizes:[10,20,30,40],
				 height:function(){
				 	return $(window).height() - 370 ;
				 },
				 title:"",
				 indexColumn:false,
				 querys:{planId:'-----',status:"",sqlId:"sql_purchase_plan_details_listForSKU"},//sql_purchase_plan_details_listForSKU sql_purchase_plan_details_list
				 loadMsg:"数据加载中，请稍候......",
				 loadAfter:function(){
				 	$(".grid-checkbox").each(function(){
						var val = $(this).attr("value") ;
						if( $(".product-list ul li[asin='"+val+"']").length ){
							$(this).attr("checked",true) ;
						}
					}) ;
				 }
			}) ;
			
			$(".cost").live("click",function(){
				var asin = $(this).attr("asin") ;
				var type = $(this).attr("type") ;
				openCenterWindow(contextPath+"/cost/view/"+asin+"/"+type,600,600) ;
				return false ;
			}) ;
			
			$(".edit-action").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				openCenterWindow(contextPath+"/sale/editPurchasePlanProduct/"+val,910,620,function(){
					$(".grid-content-details").llygrid("reload",{},true) ;
				}) ;
			}) ;
			
			$(".paction").live("click",function(){
				
				var val = $(this).attr("val") ;//采购计划ID
				var status =  $(this).attr("status") ;
				var planId =  $(this).attr("planId") ;
				
				var opName = status == '2'?"申请采购":(status=='3'?"审批通过":(status=="4"?"审批不通过":"确认采购"))
				
				if(window.confirm("确认执行该操作【"+opName+"】吗？")){
					$.ajax({
						type:"post",
						url:contextPath+"/sale/updatePurchasePlanProductStatus",
						data:{
							id:val,
							status:status
						},
						cache:false,
						dataType:"text",
						success:function(result,status,xhr){
							$(".grid-content-details").llygrid("reload",{},true) ;
						}
					}); 
				}
			}) ;
			
			$("[supplier-id]").live("click",function(){
				var id = $(this).attr("supplier-id") ;
				viewSupplier(id) ;
				return false ;
			}) ;
			
			$(".del-action").live("click",function(){
				var val = $(this).attr("val") ;//采购计划ID
				var planId = $(this).attr("planId") ;
				var asin = $(this).attr("asin") ;
				if(window.confirm("确认删除该采购产品["+asin+"]吗？")){
					$.ajax({
						type:"post",
						url:contextPath+"/sale/deletePurchasePlanProduct",
						data:{
							id:val
						},
						cache:false,
						dataType:"text",
						success:function(result,status,xhr){
							$(".grid-content-details").llygrid("reload",{planId:planId}) ;
						}
					});
				}
			}) ;
			
			$(".process-action").live("click",function(){
				var val = $(this).attr("val") ;
				openCenterWindow(contextPath+"/sale/productFilter/"+val+"/"+type,900,600) ;
			}) ;
			
   	 });
   	 