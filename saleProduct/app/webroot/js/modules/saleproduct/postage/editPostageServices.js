$(function(){
	$("button").click(function(){
		if( !$.validation.validate('#personForm').errorInfo ) {
			var json = $("#personForm").toJson() ;
			
			$.dataservice("model:RealProduct.Postage.doSaveServices",json,function(result){
					window.opener.openCallback('services') ;
					window.close();
			});
		/*
			$.ajax({
				type:"post",
				url:"/saleProduct/index.php/users/saveFunctoin",
				data:json,
				cache:false,
				dataType:"text",
				success:function(result,status,xhr){
					window.opener.openCallback() ;
					window.close() ;
				}
			}); */
		}
	})
}) ;