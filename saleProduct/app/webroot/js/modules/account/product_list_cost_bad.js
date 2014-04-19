
	
	var currentCategoryId = "" ;
	var currentCategoryText = "" ;
	$(function(){

			function loadStatis(){
				$.dataservice("sqlId:sql_account_product_cost_bad_statics",{},function(result){
					$(".flow-node").find(".count").html("(0)") ;
					$(result).each(function(index,item){
						item = item.t ;
						$(".flow-node[status='"+item.STATUS+"']").find(".count").html("("+item.COUNT+")") ;
					});
				},{noblock:true}) ;
			}
			loadStatis() ;
	       
	       var gridConfig = {
					columns:[
						
						{align:"center",key:"IS_ANALYSIS",label:"供应需求", width:"10%",format:function(val,record){
							var html = [] ;
							if(val == 1){
								return "<span style='color:green'>可计算</span>" ;
							}else{
								return "<span style='color:green'>不可计算</span>" ;
							}
							return html.join("") ;
						}},
						{align:"left",key:"ACCOUNT_NAME",label:"账号",width:"8%"},
						{align:"left",key:"SKU",label:"产品SKU",width:"8%"},
						{align:"left",key:"REAL_SKU",label:"货品SKU",width:"8%",format:function(val,record){
							return "<a href='#' product-edit='"+record.REAL_ID+"'>"+(val||"")+"</a>" ;
						}},
			           	{align:"left",key:"ASIN",label:"ASIN", width:"90",format:function(val,record){
			           		return "<a href='#' offer-listing='"+val+"'>"+(val||"")+"</a>" ;
			           	}},
			           	{align:"center",key:"IMAGE_URL",label:"图片",width:"3%",forzen:false,align:"left",format:{type:'img'}},
			           	{align:"center",key:"NAME",label:"产品标题",width:"10%",forzen:false,align:"left"},
			           	{align:"center",key:"DAY_PAGEVIEWS",label:"每日PV",width:"8%",format:function(val){
			           		if(!val) return '-' ;
			           		return Math.round(val) ;
			           	}},
			           	{align:"center",key:"FULFILLMENT_CHANNEL",label:"销售渠道",width:"8%"},
			           	{align:"center",key:"ITEM_CONDITION",label:"使用程度",width:"8%",format:function(val){
			           		if(val == 1) return "Used" ;
			           		if(val == 11) return 'New' ;
			           		return '' ;
			           	}},
			           	{align:"center",key:"IS_FM",label:"FM产品",width:"8%" },
			           	{align:"center",key:"QUANTITY",label:"库存",width:"6%"},
			        	{align:"center",key:"SUPPLY_CYCLE",label:"供应周期",width:"8%" },
			        	{align:"center",key:"REQ_ADJUST",label:"需求调整系数",width:"8%" }
			         ],
			         //ds:{type:"url",content:contextPath+"/amazongrid/product/"+accountId},
			         ds:{type:"url",content:contextPath+"/grid/query"},
					 limit:30,
					 pageSizes:[15,20,30,40],
					 height:function(){
						 return $(window).height()-170;
					 },
					 title:"",
					 indexColumn:false,
					 querys:{status1:1,sqlId:"sql_account_product_list_cost_bad"},
					 loadMsg:"数据加载中，请稍候......",
					 loadAfter:function(records){
						 $(".grid-content").uiwidget();
						 
						 $realIds = [] ;
							$(records).each(function(){
								this.REAL_ID && $realIds.push(this.REAL_ID) ;
							}) ;
							
					 }
				} ;
	       
			setTimeout(function(){
				$(".grid-content").llygrid(gridConfig) ;
			},200) ;
			
			$(".flow-node").click(function(){
				var baseParams = {"status1":"","status2":"","status3":"","status4":"","status5":"","status6":"","status7":"","status8":"","status9":""} ;
				
				var status = $(this).attr("status");
				baseParams['status'+status] = 1 ;
				$(".flow-node").removeClass("active").addClass("disabled");
				$(this).removeClass("disabled").addClass("active");
				$(".grid-content").llygrid("reload",baseParams,true);
			}) ;
   	 });