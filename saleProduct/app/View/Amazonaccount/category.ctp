<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <?php echo $this->Html->charset(); ?>
    <title>llygrid demo</title>
    <meta http-equiv="pragma" content="no-cache"/>
	<meta http-equiv="cache-control" content="no-cache"/>

   <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('../grid/redmond/ui');
		echo $this->Html->css('../kissu/widgets/core/tree/ui.tree');
		echo $this->Html->css('../js/validator/jquery.validation');
		echo $this->Html->css('style-all');
		echo $this->Html->script('../kissu/scripts/jquery');
		echo $this->Html->script('../kissu/scripts/jquery.utils');
		echo $this->Html->script('jquery.json');
		echo $this->Html->script('../kissu/widgets/core/tree/jquery.tree');

	?>	
	
  
   <style>
   		*{
   			font:12px "微软雅黑";
   		}

		.rule-content-item{
			clear:both;
		}

		.item-label,.item-relation,.item-value,.item-value{
			float:left;
		}
   </style>

   <script>
    var treeData = {id:"root",text:"产品分类",isExpand:true,childNodes:[]} ;
    var treeMap  = {} ;
	var accountId = '<?php echo $accountId;?>' ;

    <?php
    	$index = 0 ;
		foreach( $categorys as $Record ){
			$sfs = $Record['sc_amazon_product_category']  ;
			$id   = $sfs['ID'] ;
			$name = $sfs['NAME'] ;
			$pid  = $sfs['PARENT_ID'] ;
			echo " var item$index = {id:'$id',pid:'$pid',text:'$name',memo:'".$sfs['MEMO']."',gatherLevel:'".$sfs['GATHER_LEVEL']."',isExpand:true} ;" ;
			echo " treeMap['id_$id'] = item$index  ;" ;
			$index++ ;
		} ;
		
		$index = 0 ;
		foreach( $categorys as $Record ){
			$sfs = $Record['sc_amazon_product_category']  ;
			$id   = $sfs['ID'] ;
			$name = $sfs['NAME'] ;
			$pid  = $sfs['PARENT_ID'] ;
			
			if(empty($pid)){
				echo " item$index ['childNodes'] = item$index ['childNodes']||[] ;" ;
				echo "treeData.childNodes.push( item$index ) ;" ;
			}else{
				echo " item$index ['childNodes'] = item$index ['childNodes']||[] ;" ;
				echo " treeMap['id_$pid'].childNodes = treeMap['id_$pid'].childNodes||[] ;" ;
				echo " treeMap['id_$pid'].childNodes.push( item$index ) ;" ;
			}
			$index++ ;
		} ;
		
	?>
   
	$(function(){
		$(".update-category-tree").tree({//tree为容器ID
				source:'array',
				data:treeData ,
				onNodeClick:function(id, text, record,node){
					if(id == 'root'){
						id = "" ;
						text = "" ;
					}
					$("#up-category .parentName").val(text) ;
					$("#up-category .parentId").val(id) ;
				}
        }) ;

		$('#default-tree').tree({//tree为容器ID
				source:'array',
				data:treeData ,
				onNodeClick:function(id, text, record,node){
					var pid =record.pid ;
					var pname = "" ;
					if(pid){
						var pRecord = treeMap['id_'+pid] ;
						pname = pRecord.text;
					}
					if(id == 'root'){
						$("#xj-category .parentName").val("") ;
						$("#xj-category .parentId").val("") ;
					}else{
						$("#xj-category .parentName").val(text) ;
						$("#xj-category .parentId").val(id) ;
					}
					$("#up-category .parentName").val(pname) ;
					$("#up-category .parentId").val(pid) ;
					$("#up-category .id").val(id) ;
					$("#up-category .name").val(text) ;
					$("#up-category .memo").val(record.memo) ;
					$("#up-category input:radio[value='"+record.gatherLevel+"']").attr("checked",true) ;
					
					//不能选择自己的下级节点作为父节点
					$("[nodeid]",".update-category-tree").parent().show() ;
					$("[nodeid='"+id+"']",".update-category-tree").parent().hide() ;
				}
           }) ;
           
        $(".save-category").click(function(){
        	var ids = $('#xj-category').toJson() ;
        	
        	if(!ids.name){
        		alert("分类名称不能为空");
        		return ;
        	}
        	
        	$.ajax({
				type:"post",
				url:"/saleProduct/index.php/amazonaccount/saveCategory/"+accountId,
				data:ids,
				cache:false,
				dataType:"text",
				success:function(result,status,xhr){
					window.location.reload() ;
				}
			}); 
        }) ;
        
        $(".update-category-btn").toggle(function(){
        	$(".update-category-tree").show() ;
        },function(){
        	$(".update-category-tree").hide() ;
        }) ;
        
        $(".update-category").click(function(){
        	var ids = $('#up-category').toJson() ;
        	if(!ids.name){
        		alert("分类名称不能为空");
        		return ;
        	}
        	
        	$.ajax({
				type:"post",
				url:"/saleProduct/index.php/amazonaccount/saveCategory/"+accountId,
				data:ids,
				cache:false,
				dataType:"text",
				success:function(result,status,xhr){
					window.location.reload() ;
				}
			}); 
        }) ;
		
	})
   </script>

</head>
<body>
<div id='content-default' class='demo' style="padding:10px;">
	<div class="row-fluid">
		<div id="default-tree" class="tree span3" style="padding: 5px; "></div>
		<div class="span4">
			<fieldset id="xj-category">
				<legend>添加下级分类</legend>
				
				<label>上级分类:</label>
				<input type="text" readonly class="parentName" id="parentName"/>
				<input type="hidden" class="parentId" id="parentId"/>
			
				<label>分类名称:</label>
				<input type="text" class="name" id="name" class="span4"/>
				
				<label>分类备注:</label>
				<textarea id="memo" class="memo" style="height:50px;" class="span4"></textarea>
				
				<label>采集类别</label>
				<input type="radio" name="gatherLevel" value="" />不采集
				<input type="radio" name="gatherLevel" value="A" />A
				<input type="radio" name="gatherLevel" value="B" />B
				<input type="radio" name="gatherLevel" value="C" />C
				<input type="radio" name="gatherLevel" value="D" />D
				
				<br/><br/>
				<button class="btn save-category">保存分类</button>
				
			</fieldset>
		
				
		</div>
		<div class="span4">
			<fieldset id="up-category">
				<legend>修改当前分类</legend>
				<input type="hidden" class="id" id="id"/>
				
				<label>上级分类:<button class="update-category-btn">修改上级分类</button></label>
				<div class="update-category-tree" style="overflow:auto;max-height:100px;display:none;border:1px solid #CCC;margin-bottom:3px;">
				</div>
				<input type="text" readonly class="parentName" id="parentName"/>
				<input type="hidden" class="parentId" id="parentId"/>
			
				<label>分类名称:</label>
				<input type="text" class="name" id="name" class="span4"/>
				
				<label>分类备注:</label>
				<textarea id="memo" class="memo" style="height:50px;" class="span4"></textarea>
				<label>采集类别</label>
				<input type="radio" name="gatherLevel" value="" />不采集
				<input type="radio" name="gatherLevel" value="A" />A
				<input type="radio" name="gatherLevel" value="B" />B
				<input type="radio" name="gatherLevel" value="C" />C
				<input type="radio" name="gatherLevel" value="D" />D
				<br/><br/>
				<button class="btn update-category">修改分类</button>
				
			</fieldset>
		</div>
	</div>
	
</div>



</html>