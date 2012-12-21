
$(function(){
	if($inStatus){ //验货完成
		$(".sh").removeAttr("disabled").addClass("btn-success") ;
		$(".rh").removeAttr("disabled")  ;;
	}else{ //未验货完成
		$(".sh").removeAttr("disabled")  ;;
	}
	
	//确认入库
	$(".btn-confirm-in").click(function(){
		if(window.confirm("确认列表产品已入库吗?")){
			$.dataservice("model:Warehouse.In.doIn",{inId:inId},function(result){//确认收货
				//window.location.reload();
			});
		} ;
	}) ;

	$(".report-exception").toggle(function(){
		$(this).parents("tr:first").next().show() ;
	},function(){
		$(this).parents("tr:first").next().hide() ;
	}) ;
	
	$(".sh").click(function(){
		window.location.href = "/saleProduct/index.php/page/forward/Warehouse.In.process/"+inId+"/sh" ;
	}) ;
	
	$(".rh").click(function(){
		window.location.href = "/saleProduct/index.php/page/forward/Warehouse.In.process/"+inId+"/rk" ;
	}) ;

	//确认验货
    $(".btn-validator-product").click(function(){
    	if(window.confirm("确认验货吗?")){
    		var json = $(this).parents("tr:first").next().toJson() ;
    		json.wasteQuantity = json.wasteQuantity||0 ;
			json.genQuantity = json.quantity - (json.wasteQuantity||0) ;
			json.status = 1 ;
			
    		$.dataservice("model:Warehouse.In.doBoxProductStatus",json,function(result){//确认收货
				window.location.reload();
			});
    	}
    }) ;


	$(".btn-confirm").click(function(){
		$.dataservice("model:Warehouse.In.doStatus",{inId:inId,status:1},function(result){//确认收货
			window.opener.openCallback('edit') ;
			window.close();
		});
		return false ;
	}) ;
	
	$(".save-waste").click(function(){
		var json = $(this).parents("tr:first").toJson() ;
		json.genQuantity = json.quantity - (json.wasteQuantity||0) ;
		$.dataservice("model:Warehouse.In.saveBoxProductException",json,function(result){//确认收货
			alert("保存成功！") ;
			window.location.reload();
		});
	}) ;

 });