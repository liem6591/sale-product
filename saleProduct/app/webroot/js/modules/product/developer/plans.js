var currentId="" ;	
$(function(){
			$(".grid-content").llygrid({
				columns:[
		           	{align:"center",key:"NAME",label:"计划名称",width:"20%",forzen:false,align:"left"},
		           	{align:"center",key:"FOLLOW_TOTAL_NUM",label:"总数量",group:"跟卖产品",width:"5%"},
		           	{align:"center",key:"FOLLOW_PER_NUM",label:"人均数量",group:"跟卖产品",width:"5%"},
		           	{align:"center",key:"FOLLOW_SALE_NUM",label:"销量",group:"跟卖产品",width:"5%"},
		        	{align:"center",key:"SELF_TOTAL_NUM",label:"总数量",group:"只有产品",width:"5%"},
		           	{align:"center",key:"SELF_PER_NUM",label:"人均数量",group:"只有产品",width:"5%"},
		           	{align:"center",key:"SELF_SALE_NUM",label:"销量",group:"只有产品",width:"5%"},
		           	{align:"center",key:"TOTAL",label:"总产品",width:"5%"},
		           	{align:"center",key:"STATUS1",label:"自有",group:'开发状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' devstatus='1'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS2",label:"跟卖",group:'开发状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' devstatus='2'>"+(val||'0')+"</a>"
			        }},
		           	{align:"center",key:"STATUS10",label:"标识产品",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='10'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS15",label:"废弃",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='15'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS20",label:"产品分析",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='20'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS30",label:"产品经理审批",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='30'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS40",label:"总监审批",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='40'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS50",label:"货品录入",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='50'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS60",label:"制作Listing",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='60'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS70",label:"Listing审批",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='70'>"+(val||'0')+"</a>"
			        }},
			        {align:"center",key:"STATUS80",label:"结束",group:'流程状态',width:"6%",format:function(val,record){
						return "<a href='#' class='fs-action' status='80'>"+(val||'0')+"</a>"
			        }},
		           	{align:"center",key:"CREATE_TIME",label:"创建时间",width:"8%"},
		           	{align:"center",key:"USERNAME",label:"创建人",width:"8%"},
		           	{align:"center",key:"MEMO",label:"备注",width:"15%"}
		         ],
		         ds:{type:"url",content:contextPath+"/grid/query"},//"/salegrid/filterTask/"+type},
				 limit:20,
				 pageSizes:[10,20,30,40],
				 height:130,
				 title:"开发计划列表",
				 indexColumn:false,
				 querys:{sqlId:'sql_pdev_plan_list'},
				 loadMsg:"数据加载中，请稍候......",
				 rowClick:function(rowIndex , rowData){
				 	var id = rowData.ID  ;
				 	currentId = id ;
				 	$(".grid-content-details").llygrid("reload",{planId:currentId}) ;
				 },loadAfter : function(){
					 $(".fs-action").bind("click",function(event){
						 	var row =  $(this).parents("tr:first").data("record") ;
						    event.preventDefault() ;
						    event.stopPropagation()  ;
							var val = $(this).attr("status") ;
							var devStatus = $(this).attr("devstatus") ;
							if(devStatus){
								$(".grid-content-details").llygrid("reload",{devStatus:devStatus,status:'',planId:row.ID},true) ;
							}else{
								$(".grid-content-details").llygrid("reload",{devStatus:'',status:val,planId:row.ID},true) ;
							}
							return false ;
					}) ;
				}
			}) ;
			
			$(".fs-action").live("click",function(){
				var val = $(this).attr("status") ;
				var devStatus = $(this).attr("devstatus") ;
				if(devStatus){
					$(".grid-content-details").llygrid("reload",{devStatus:devStatus,status:''},true) ;
				}else{
					$(".grid-content-details").llygrid("reload",{devStatus:'',status:val},true) ;
				}
			}) ;
			
			$(".grid-content-details").llygrid({
				columns:[
							{align:"center",key:"TASK_ID",label:"操作",width:"5%",format:function(val,record){
						var status = record.STATUS ;
						return "<a href='#' class='process-action' status='"+status+"' val='"+val+"' asin='"+record.ASIN+"'>处理</a>&nbsp;" ;
					}},
					{align:"center",key:"FLOW_STATUS",label:"流程状态",width:"7%",format:{type:'json',content:{10:'标识状态',15:'废弃',20:'开发分析',30:'产品经理审批',40:'总监审批',50:'录入货品',60:'制作Listing',70:'Listing审批',80:'处理完成'}}},
					{align:"center",key:"DEV_STATUS",label:"开发状态",width:"5%",format:{type:'json',content:{1:'自有',2:'跟卖',3:'废弃'}}},
		           	{align:"center",key:"ASIN",label:"ASIN", width:"8%",format:function(val,record){
		           		return "<a href='#' class='product-detail' asin='"+val+"'>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"LOCAL_URL",label:"",width:"3%",forzen:false,align:"left",format:{type:'img'}},
		           	{align:"center",key:"TITLE",label:"TITLE",width:"20%",forzen:false,align:"left",format:function(val,record){
		           		return "<a href='http://www.amazon.com/gp/offer-listing/"+record.ASIN+"' target='_blank'>"+val+"</a>" ;
		           	}},
		           	{align:"center",key:"PPC_STRATEGY_NAME",label:"竞价排名策略",width:"15%"},
	           		{align:"center",key:"LOGI_STRATEGY",label:"物流策略",width:"10%"},
	           		{align:"center",key:"SPREAD_STRATEGY",label:"推广策略",width:"15%"},
	           		{align:"center",key:"CREATE_TIME",label:"创建时间",width:"10%"},
	           		{align:"center",key:"USERNAME",label:"创建人",width:"6%"}
				         ],
		         ds:{type:"url",content:contextPath+"/grid/query"},
				 limit:30,
				 pageSizes:[10,20,30,40],
				 height:function(){
					 return $(window).height() - 360 ;
				 },
				 title:"产品列表",
				 indexColumn: false,
				 querys:{planId:'----',sqlId:'sql_pdev_filter_details'},//status:$("[name='status']").val(),type:type,
				 loadMsg:"数据加载中，请稍候......"
			}) ;

			$(".process-action").live("click",function(){
				var row =  $(this).parents("tr:first").data("record") ;
				var taskId = $(this).attr("val") ;
				var asin = $(this).attr("asin") ;
		
				openCenterWindow(contextPath+"/sale/details1/"+taskId+"/"+asin,950,650,function(){
					$(".grid-content-details").llygrid("reload",{},true) ;
				}) ;
			}) ;
			
   	 });