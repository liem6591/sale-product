<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="pragma" content="no-cache"/>
	<meta http-equiv="cache-control" content="no-cache"/>

   <?php
  		include_once ('config/config.php');
   
		echo $this->Html->meta('icon');
		echo $this->Html->css('../js/validator/jquery.validation');
		echo $this->Html->css('../js/grid/jquery.llygrid');
		echo $this->Html->css('default/style');

		echo $this->Html->script('jquery');
		echo $this->Html->script('common');
		echo $this->Html->script('jquery.json');
		echo $this->Html->script('validator/jquery.validation');	
		echo $this->Html->script('grid/jquery.llygrid');
		echo $this->Html->script('calendar/WdatePicker');
		echo $this->Html->script('modules/report/orderRealProductList');

		echo $this->Html->script('calendar/WdatePicker');
		
		$user = $this->Session->read("product.sale.user") ;
		$groupCode = $user["GROUP_CODE"] ;
		$loginId = $user['LOGIN_ID'] ;
		
		/**
		 *  create_pp 添加计划产品操作
			add_pp_product 添加审批产品操作
			add_pp_audit_product 导出操作
			export_pp 打印操作
			print_pp 编辑采购产品操作
			edit_pp_product 删除采购产品操作
			delete_pp_product 申请采购操作
			apply_purchase 审批通过操作
			audit_pass_purchase 审批不通过操作
			audit_nopass_purchase
		*/
		
		$SqlUtils  = ClassRegistry::init("SqlUtils") ;
		$security  = ClassRegistry::init("Security") ;

	?>
		<?php 
			ini_set('date.timezone','Asia/Shanghai');
			$printTime = date('Y-m-d');
			?>
	
	<script type="text/javascript">
		var newDate = '<?php echo $printTime; ?>';
	
		$(function(){
			$(".asyn-btn").click(function(){
				if( !$.validation.validate('.asyn-form').errorInfo ) {
					var json = $(".asyn-form").toJson() ;
					var url =contextPath+"/amazon/listOrders/" + json.accountId ;
					url= url +"?LastUpdatedAfter=" + json.LastUpdatedAfter;
					if( json.LastUpdatedBefore ){
						url= url +"&LastUpdatedBefore=" + json.LastUpdatedBefore ;
					}
					if(window.confirm("确认同步？")){
						$.ajax({
							type:"post",
							url: url ,
							data:{},
							cache:false,
							dataType:"text",
							success:function(result,status,xhr){
								alert("执行结束") ;
							}
						});
					}
				}
			}) ;
		}) ;
	</script>

	 <style type="text/css">
		img{
			cursor:pointer;
		}
	</style>
 
</head>
<body>

	<div style="clear:both;height:1px;" ></div>
	<div class="toolbar toolbar-auto">
	  <div class="row-fluid">
	  	<div class="span3">
		<table class="toolbar1">
			<tr>
				<th>
					日期:
				</th>
				<td>
					<input type="text" id="purchaseDate"   data-widget="calendar"  value='<?php echo $printTime;?>'  style="width:100px;"/>
				</td>								
				<td class="toolbar-btns">
					<button class="btn btn-primary query-btn"  data-widget="grid-query"  data-options="{gc:'.grid-content',qc:'.toolbar1'}">查询</button>
				</td>
		</table>
		</div>
		<div class="span9">
		<table class="asyn-form"  data-widget="validator">
				<th>账号：</th>
						<td>
						<select name="accountId" data-validator="required"  style="width:100px;">
				     		<option value="">--选择--</option>
					     	<?php
					     		 $amazonAccount  = ClassRegistry::init("Amazonaccount") ;
				   				 $accounts = $amazonAccount->getAllAccounts(); 
					     		foreach($accounts as $account ){
					     			$account = $account['sc_amazon_account'] ;
					     			echo "<option value='".$account['ID']."'>".$account['NAME']."</option>" ;
					     		} ;
					     	?>
							</select>
						</td>
						<th>开始时间：</th>
						<td>
							<input  type="text"  id="LastUpdatedAfter" data-widget="calendar"  data-options="{isShowWeek:true,dateFmt:'yyyy-MM-dd HH:mm:ss'}"  
									data-validator="required"  style="width:150px;"/>
						</td>
						<th>结束时间：</th>
						<td>
							<input  type="text" data-widget="calendar"   id="LastUpdatedBefore"  style="width:150px;"/>
						</td>
						<td colspan=2>
						<center>
							<button class="btn btn-primary asyn-btn">执行同步</button>
						</center>
						</td>
			</tr>						
		</table>
		</div>
		</div>
	</div>	
	<div class="grid-content" style="margin-top:5px;">
	</div>
</body>
</html>