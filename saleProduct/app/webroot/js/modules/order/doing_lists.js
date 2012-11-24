function formatGridData(data){
		var records = data.record ;
 		var count   = data.count ;
 		
 		count = count[0][0]["count(*)"] ;
 		
		var array = [] ;
		$(records).each(function(){
			var row = {} ;
			for(var o in this){
				var _ = this[o] ;
				for(var o1 in _){
					row[o1] = _[o1] ;
				}
			}
			array.push(row) ;
		}) ;
	
		var ret = {records: array,totalRecord:count } ;
			
		return ret ;
	}
	var currentPickName = '' ;
	$(function(){
			var currentPickId = '' ;
			//拣货单列表
			$("#picked-grid-content").llygrid({
				 columns:[
		           	{align:"center",key:"NAME",label:"名称",width:"20%",forzen:false,align:"left",format:function(val,record){
		           		return '<a href="#" class="select-product"  pickId="'+record.ID+'">'+img+'</a>&nbsp;'+val+"<strong>（"+record.TOTAL+"）</strong>" ;
		           	}}
		         ],
		         ds:{type:"url",content:"/saleProduct/index.php/grid/query"},
				 limit:20,
				 pageSizes:[10,20,30,40],
				 height:function(){
				 	return $(window).height() - $(".toolbar-auto").height() -55 ;
				 },
				 autoWidth:true,
				 title:"",
				 pagerType:"simple",
				 querys:{sqlId:"sql_order_picked_list"},
				 loadMsg:"数据加载中，请稍候......",
				 rowClick:function(rowIndex , rowData){
				 	currentPickId = rowData.ID ;
				 	currentPickName = rowData.NAME ;
				 	$(".grid-content").llygrid("reload",{pickId:rowData.ID});
				 	renderBtn() ;
				 }

			}) ;
			
			$(".action").live("click",function(){
				var id = $(this).attr("val") ;
				if( $(this).hasClass("add") ){
					openCenterWindow("/saleProduct/index.php/order/editPicked",600,400) ;
				} 
				return false ;
			}) ;
			
			$(".action-btn").click(function(){
				var action = $(this).attr("action");
				var checkedRecords = $(".grid-content").llygrid("getSelectedRecords",{key:"ORDER_ID",checked:true},true) ;
				var status = $(this).attr("status");
				
				if( action == 4 ){//打印拣货单
					openCenterWindow("/saleProduct/index.php/order/printPicked/"+currentPickId,950,650) ;
					return ;
				}else if( action == 5 ){//单品打印拣货单
					openCenterWindow("/saleProduct/index.php/order/rePrintPicked/"+currentPickId+"/1",950,650) ;
					return ;
				}else if( action == 6 ){//多品打印拣货单
					openCenterWindow("/saleProduct/index.php/order/rePrintPicked/"+currentPickId+"/2",950,650) ;
					return ;
				}
			}) ;
			
			function renderBtn(){
				if(currentPickId){
					$(".action-btn").removeAttr("disabled");
				}else{
					$(".action-btn").attr("disabled",true);
				}
			}
			
			renderBtn() ;
			
			$(".select-product").live("click",function(){
				var pickId = $(this).attr("pickId") ;
				openCenterWindow("/saleProduct/index.php/order/selectPickedProduct/"+pickId,1000,600) ;
			})
			
		
			//var sqlId = "sql_order_doing_list" ;
			var sqlId = "sql_order_list_picked" ;
			//拣货单订单列表
			$(".grid-content").llygrid({
				columns:[
					{align:"left",key:"TRACK_NUMBER",label:"Tracking Number", width:"20%"},
		           	//{align:"center",key:"SHIP_SERVICE_LEVEL",label:"SHIP LEVEL", width:"10%"},
		           	{align:"left",key:"ASIN",label:"ASIN", width:"90",format:function(val,record){
			           		var memo = record.MEMO||"" ;
			           		return "<a href='#' class='product-detail' title='"+memo+"' asin='"+val+"' sku='"+record.SKU+"'>"+(val||'')+"</a>" ;
			        }},
		           	{align:"center",key:"LOCAL_URL",label:"Image",width:"6%",forzen:false,align:"left",format:function(val,record){
		           		if(val){
		           			val = val.replace(/%/g,'%25') ;
		           		}else{
		           			return "" ;
		           		}
		           		return "<img src='/saleProduct/"+val+"' onclick='showImg(this)' style='width:25px;height:25px;'>" ;
		           	}},
		           	{align:"center",key:"ORDER_ID",label:"ORDER_ID", width:"15%"},
		           	{align:"center",key:"ORDER_ITEM_ID",label:"ORDER_ITEM_ID", width:"12%"},
		           	{align:"center",key:"SKU",label:"SKU",sort:true, width:"10%"},
		           	{align:"center",key:"PRODUCT_NAME",label:"PRODUCT_NAME", width:"20%"},
		           	{align:"center",key:"PURCHASE_DATE",label:"PURCHASE_DATE",sort:true, width:"20%"},
		           	{align:"center",key:"PAYMENTS_DATE",label:"PAYMENTS_DATE",sort:true, width:"20%"},
		           	{align:"center",key:"BUYER_EMAIL",label:"BUYER_EMAIL", width:"30%"},
		           	{align:"center",key:"BUYER_NAME",label:"BUYER_NAME", width:"10%"},
		           	{align:"center",key:"BUYER_PHONE_NUMBER",label:"BUYER_PHONE_NUMBER", width:"10%"},
		           	{align:"center",key:"QUANTITY_PURCHASED",label:"QUANTITY_PURCHASED", width:"10%"},
		           	{align:"center",key:"CURRENCY",label:"CURRENCY", width:"10%"},
		           	{align:"center",key:"ITEM_PRICE",label:"ITEM_PRICE", width:"10%"},
		           	{align:"center",key:"ITEM_TAX",label:"ITEM_TAX", width:"10%"}
		         ],
		         ds:{type:"url",content:"/saleProduct/index.php/grid/query/"+accountId},
				 limit:20,
				 pageSizes:[10,20,30,40],
				 height:function(){
				 	return $(window).height() - $(".toolbar-auto").height() -185 ;
				 },
				 title:"",
				 indexColumn:false,
				 querys:{sqlId:sqlId,accountId:accountId,status:'',trackNumberNull:"",pickStatus:"9"},
				 loadMsg:"数据加载中，请稍候......"
			}) ;
			
			$(".query").click(function(){
				var json = $(".query-table").toJson() ;
				//if(currentQueryKey)json.sqlId = currentQueryKey ;
				$(".grid-content").llygrid("reload",json,true) ;
			}) ;
   	 });
   	 
   	 var currentQueryKey = "" ;
     //{未审核订单：,合格订单：5，风险订单：2，待退单：3，外购订单：4，加急单：6，特殊单：7}
   	 $(function(){
			var tab = $('#details_tab').tabs( {
				tabs:[
					{label:'处理中',content:"tab-content"},
					//{label:'拣货完成',content:"tab-content"},
					{label:'发货完成',content:"tab-content"}
				] ,
				//height:'500px',
				select:function(event,ui){
					var index = ui.index ;
					renderAction(index);
				}
			} ) ;
		}) ;
   	 
function renderAction(index){
	$(".save-btn").show() ;
	if(index == 0){//拣货中
		$(".save-btn").hide() ;
		$(".grid-content").llygrid("reload",{pickStatus:9,status:'',trackNumberNull:"",trackNumber:""},true) ;
	}else if(index == 1){//拣货完成
		//$(".save-btn").hide() ;
		$(".grid-content").llygrid("reload",{pickStatus:'',status:'',trackNumber:"1",trackNumberNull:""},true) ;
	}
}