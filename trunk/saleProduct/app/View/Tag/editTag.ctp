<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <?php echo $this->Html->charset(); ?>
    <title>用户编辑</title>
    <meta http-equiv="pragma" content="no-cache"/>
	<meta http-equiv="cache-control" content="no-cache"/>

   <?php
   include_once ('config/config.php');
   
		echo $this->Html->meta('icon');
		echo $this->Html->css('../js/validator/jquery.validation');
		echo $this->Html->css('default/style');

		echo $this->Html->script('jquery');
		echo $this->Html->script('common');
		echo $this->Html->script('jquery.json');
		echo $this->Html->script('validator/jquery.validation');
		
		$typeId = $params['arg1'] ;
		$tagId = $params['arg2'] ;
		$SqlUtils  = ClassRegistry::init("SqlUtils") ;
		$tag = null ;
		if( $tagId ){
			$tag = $SqlUtils->getObject("select * from sc_tag where id = '{@#tagId#}'",array("tagId"=>$tagId)) ;
		}
		 
	?>
  
</head>

<script>
$(function(){
	$(".save-tag").click(function(){
		if( !$.validation.validate('#personForm').errorInfo ) {
			var json = $("#personForm").toJson() ;
			json.typeId = '<?php echo $typeId ;?>' ;
			$.dataservice("model:Tag.saveTag",json,function(result){
					window.close();
			});
		}
	})
}) ;
</script>

<body class="container-popup">
	<!-- apply 主场景 -->
	<div class="apply-page">
		<!-- 页面标题 -->
		<div class="page-title">
			<h2>用户信息</h2>
		</div>
		<div class="container-fluid">

	        <form id="personForm" action="#" data-widget="validator,ajaxform" class="form-horizontal" >
	        	<input type="hidden" id="id" value="<?php echo $tag['ID'];?>"/>
				<!-- panel 头部内容  此场景下是隐藏的-->
				<div class="panel apply-panel">
					<!-- panel 中间内容-->
					<div class="panel-content">
						<!-- 数据列表样式 -->
						<table class="form-table " >
							<caption>基本信息</caption>
							<tbody>										   
								<tr>
									<th>标签名称：</th>
									<td><input type="text"  data-validator="required"
										id="name" value="<?php echo  $tag['NAME'];?>"
										<?php if( !empty($tag['NAME']) ) echo "disabled" ;?>
										/></td>
								</tr>
								<tr>
									<th>描述：</th><td>
									<textarea style="width:90%;height:50px;" id="description"><?php echo  $tag['DESCRIPTION'];?></textarea>
									</td>
								</tr>
								
							</tbody>
						</table>
					</div>
					
					<!-- panel脚部内容-->
                    <div class="panel-foot">
						<div class="form-actions ">
							<button type="button" class="btn btn-primary save-tag">提&nbsp;交</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>