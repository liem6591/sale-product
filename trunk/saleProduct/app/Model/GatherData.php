<?php
ignore_user_abort(1);
set_time_limit(0);

ini_set("memory_limit", "62M");
ini_set("post_max_size", "24M");

App::import('Model', 'GatherService') ;
App::import('Model', 'Utils') ;
App::import('Model', 'Log') ;
App::import('Model', 'Task') ;

App :: import('Vendor', 'Snoopy');
App :: import('Vendor', 'simple_html_dom');
App :: import('Vendor', 'Amazon');

/**
 * 数据获取执行PHP
 */
class GatherData extends AppModel {
	var $useTable = "sc_product_flow" ;
	/**
	 * 获取ASIN基本信息
	 */
	public function asinInfo($asin,$id=null,$index = null,$logId=null){
		$utils = new Utils() ;
		$service = new GatherService() ;
		$log = new Log() ;
		
		//判断是否为合法的ASIN
		if( strlen(trim($asin)) < 9 || strlen(trim($asin)) >=11 ) {
			return ;
		} ; 
		
		try{
			$url = "http://www.amazon.com/dp/" . $asin;
			$snoopy = new Snoopy ;
			$snoopy->agent =  $this->getAgent($index) ;
			$snoopy->referer = $url ;
			$snoopy->rawheaders["Pragma"] = "no-cache"; 
			
			if( $snoopy->fetch($url) ){
				$Result = $snoopy->results ;
				//debug($Result) ;
				$html = new simple_html_dom();
				$html->load( $Result  ,true ,false );
				
				try{
					//get title
					$title = $utils->getProp($html ,'#btAsinTitle' ) ;

					//byLineReorder
					$brand = "" ;
					foreach( $html->find('.buying a') as $e ){
						$href = $e->href ;
						if( strripos( $href , "brandtextbin" )>0 ){
							$brand = trim( $e->plaintext ) ;
							break;	
						}
					}
					
					$technical = "" ;
					if($html->find("#technical_details",0)!=null){
						$technical = $html->find("#technical_details",0)->parent()->find(".content",0)->plaintext ;
					}
		
					$h2s = $html->find("h2") ;
					$productDetails = '' ;
					$Dimensions = '' ;
					$Weight = '' ;
					foreach(  $html->find("h2") as $e){ 
						if( $e->plaintext == 'Product Details' ) {
							$productDetails = $e->next_sibling ()->plaintext ;
							
							foreach(  $e->next_sibling()->find("b") as $f ){
								if( trim( $f->plaintext ) == "Product Dimensions:" ){
									$Dimensions = $f->parent()->plaintext ;
									$Dimensions = str_replace("Product Dimensions:" ,"",$Dimensions);
								}else if( trim( $f->plaintext ) == "Shipping Weight:" ){
									$Weight = $f->parent()->plaintext ;
									$Weight = str_replace("Shipping Weight:" ,"",$Weight);
									$Weight = str_replace("(View shipping rates and policies)" ,"",$Weight);
								}
							}
						}
			        }  
					
					$productDescription = "" ;
					if( $html->find('#productDescription',0) != null){
						$productDescription = $html->find('#productDescription',0)->find(".content",0)->plaintext ;
					}
					
					$array['asin'] = $asin ;
					$array['title'] = trim($title) ;
					$array['TECHDETAILS'] = trim($technical) ;
					$array['PRODUCTDETAILS'] = trim($productDetails) ;
					$array['DESCRIPTION'] = trim($productDescription) ;
					$array['DIMENSIONS'] = trim($Dimensions) ;
					$array['WEIGHT'] = trim($Weight) ;
					$array['BRAND'] = trim($brand) ;
					//DIMENSIONS
					//WEIGHT
					
					//debug( $array ) ;
					//更新产品基本信息
					$service->updateProduct($array);
					//echo "start get Image...." ;
					///保存图片
					$images = $html->find("#prodImageCell img",0) ;
					if( $images == null ){
						$images = $html->find("#main-image",0) ;
					}
					if( $images!=null ){
						$src = $images->src ;
						$title = $images->alt ;
						
						try{
							$localUrl = "images/amazon/".$asin."/".basename($src) ;
							$utils->downloads($src,$asin) ;
							$service->addImage($asin,$src,$title,$localUrl) ;
						}catch(Exception $e){
							//print_r($e) ;
						}
					}
					//return ;
					//保存竞争信息-----------------------------------------------------
					if( $html != null ){
						//get point
						$rating = $html->find(".acrRating",0) ;
						$point = "" ;
						if($rating != null ){
							$txt = $rating->plaintext ;
							$arry = explode("out of",$txt) ;
							$point = trim( $arry[0] ) ;
						}
						//get review
						$views = $html->find(".acrCount",0) ;
						$reviews = "" ;
						if($views != null ){
							$txt = $views->plaintext ;
							$txt = str_replace( array('"',')','(',","),"",$txt ) ;
							$reviews = trim( $txt ) ;
							$reviews = str_replace( array("reviews","review"),"",$reviews ) ;
							$reviews = trim($reviews) ;
						}
						//get ranking
						$salesRank = $html->find("#SalesRank",0) ;
						$rankArray = array() ;
						if( $salesRank != null ){
							foreach( $salesRank->find(".zg_hrsr_item") as $item ){
								$rank = $item->find(".zg_hrsr_rank",0) ;
								$type = $item->find(".zg_hrsr_ladder",0) ;
								
								$rankText = str_replace("#","",$rank->plaintext) ;
								$typeText = str_replace("in&nbsp;","",$type->plaintext) ;
								
								$rankArray[] = array("rank"=>trim( $rankText ),"type"=>trim($typeText) ) ;
							}
						}
						$service->saveSalePotential($asin,$reviews , $point , $rankArray ) ;
					}else {
						
					}
					//----------------------------------------------------------------
				}catch(Exception $e){
					$log->savelog($logId,"get product[".$asin."] details failed:::: ".$e->getMessage()) ;	
				}
				$html->clear() ;
				unset($html) ;
				$log->savelog($logId,"get product[".$asin."] details success!") ;	
			}
			
			unset($snoopy) ;
		}catch(Exception $e){
			$log->saveException($logId,saveException) ;	
		}
	}
	
	/**
	 * 获取ASIN竞争信息
	 */
	public function asinCompetition($asin ,$id = null,$index=null,$logId = null ){
		$utils = new Utils() ;
		$service = new GatherService() ;
		$log = new Log() ;
		
		$d = date("U") ;
		$url =  "http://www.amazon.com/gp/offer-listing/".$asin."?ie=UTF8&dd=$d"  ;
		
		//echo $url ;
		$snoopy = new Snoopy ;
		$snoopy->agent =  $this->getAgent($index) ;
		$snoopy->referer = $url ;
		$snoopy->rawheaders["Pragma"] = "no-cache"; 

		if( $snoopy->fetch($url) ){
			
			$Result = $snoopy->results ;
			
			$html = new simple_html_dom();
			$html->load( $Result ,true ,false );
			try{
				//$html = file_get_html($url); 
				
				$h2s = $html->find("h2") ;
				
				$base = array('FM_NUM'=>'0','NM_NUM'=>'0','UM_NUM'=>'0') ;
				$details = array() ;
				
				foreach(  $html->find("h2") as $e){ 
					if( $e->plaintext == 'Featured Merchants' ) {//1-5 of 15 offers 
						$returns = $utils->_processRowCompetetion($e,$details,"F" ,$base , 'FM_NUM') ;
						$details = $returns[0] ;
						$base = $returns[1] ;
					}else if( $e->plaintext == 'New' ) {
						$returns = $utils->_processRowCompetetion($e,$details,"N" ,$base , 'NM_NUM') ;
						$details = $returns[0] ;
						$base = $returns[1] ;
					}else if( $e->plaintext == 'Used' ) {
						$returns = $utils->_processRowCompetetion($e,$details,"U" ,$base , 'UM_NUM') ;
						$details = $returns[0] ;
						$base = $returns[1] ;
					}
		        } 
				//print_r($details) ;
		        $service->saveCompetions($asin , $base , $details) ;
			}catch(Exception $e){
				$log->saveException($logId, $e );
			}
			$html->clear() ;
			unset($html) ;
		}
		unset($snoopy) ;
	}
	
	/**
	 * 获取ASIN FBA竞争信息
	 */
	public function asinFbas($asin ,$id = null ,$index=null,$logId = null){
		$utils = new Utils() ;
		$service = new GatherService() ;
		$log = new Log() ;
		
		$d = date("U") ;
		$url = "http://www.amazon.com/gp/offer-listing/$asin?shipPromoFilter=1&dd=$d" ;
		
		$snoopy = new Snoopy ;
		$snoopy->agent =  $this->getAgent($index) ;
		$snoopy->referer = $url ;
		$snoopy->rawheaders["Pragma"] = "no-cache"; 

		if( $snoopy->fetch($url) ){
			$Result = $snoopy->results ;
			$html = new simple_html_dom();
			$html->load( $Result ,true ,false );
			try{
				$h2s = $html->find("h2") ;
				
				$base = array() ;
				$details = array() ;
		
				$count = 0 ;
				foreach(  $html->find("h2") as $e){ 
					if( $e->plaintext == 'Featured Merchants' ) {//1-5 of 15 offers 
						$count++ ;
						$returns = $utils->_processRowCompetetion($e,$details,"FBA" ,$base , 'FBA_NUM') ;
						$details = $returns[0] ;
						$base = $returns[1] ;
					}
		        }  
		        
		        if($count > 0 ){
			        $service->saveFba($asin , $base , $details) ;
		        }
			        			
			}catch(Exception $e){
				$log->saveException($logId, $e );
			}
			$html->clear() ;
			unset($html) ;
		}
		unset($snoopy) ;
	}	
	
	/**
	 * 获取ASIN价格信息
	 */
	public function asinPrice($asin,$code,$condition,$id=null,$index = null,$logId=null) {
		$utils = new Utils() ;
		$service = new GatherService() ;
		$log = new Log() ;
		
		try{
			$url = "http://www.amazon.com/gp/offer-listing/$asin/?condition=$condition&me=$code" ;
	
			$d = date("U") ;
			$url = $url."&ddd=$d" ;
				
			$snoopy = new Snoopy;
			$snoopy->agent =  $this->getAgent($index) ;
			$snoopy->referer = $url ;
			$snoopy->rawheaders["Pragma"] = "no-cache"; 

			if( $snoopy->fetch($url) ){
				$Result = $snoopy->results ;

				$html = new simple_html_dom();
				$html->load( $Result  ,true ,false );
				
				$arrays = array() ;
				try{
					//////////////////////////////////////////////////////////////////////////////////////////
					
					foreach(  $html->find("h2") as $e){ 
						if( $e->plaintext == 'Featured Merchants' ) {//1-5 of 15 offers 
							$arrays = $utils->_processRowPrice($id,$e,'11',$arrays,"FM") ;
						}else if( $e->plaintext == 'New' ) {
							$arrays = $utils->_processRowPrice($id,$e,'11',$arrays,"NEW") ;
						}else if( $e->plaintext == 'Used' ) {
							$arrays = $utils->_processRowPrice($id,$e,'1',$arrays,"") ;
						}
			        }  
					//////////////////////////////////////////////////////////////////////////////////////////
					//更新产品基本信息
					$service->updateAmazonProductShipping($asin,$id,$arrays);
					
					
				}catch(Exception $e){
					$log->savelog($logId,"get product[".$asin."] price failed:::: ".$e->getMessage()) ;	
				}
				$html->clear() ;
				unset($html) ;
				$log->savelog($logId,"get product[".$asin."] price success!".json_encode($arrays).">>[$url]") ;	
				unset($arrays) ;
			}else{
			}
			unset($snoopy) ;
		}catch( Exception $e){
			$log->saveException($logId,saveException) ;
		}
	}

	/////////////////////////////////////////////////////
	///////////////////////获取产品///////////////////////
	/////////////////////////////////////////////////////
	/**
	 * 通过URL获取产品
	 */
	public function sellerAsins($id,$logId=null){
		$utils = new Utils() ;
		$service = new GatherService() ;
		$log = new Log() ;
		$task = new Task() ;
		
		$index = 0 ;
		$sellerurl = $service->getSellerUrl($id);
		$url = $sellerurl[0]['sc_seller']['url'];
		
		
		for ($j = 1; $j < 200; $j++) {
			$log->savelog($logId,"from [".($url . "&page=" . $j)."] get products") ;
			$snoopy = new Snoopy;
			$snoopy->agent =  $this->getAgent($j) ;
			$snoopy->referer = $url ;
			$snoopy->rawheaders["Pragma"] = "no-cache";
			echo $url . "&page=" . $j;
			if( $snoopy->fetch($url . "&page=" . $j) ){
				$Result = $snoopy->results ;
				
				$html = new simple_html_dom();
				$html->load( $Result ,true ,false );
				//$html = file_get_html($url . "&page=" . $j); 
				try{
					$products = $html->find('.product,.prod');
					
					if (count($products) <= 0) {
						break;
					}
		
					for ($i = 0; $i < count($products); $i++) {
						$productName = $products[$i]->name;
						$log->savelog($logId,'find productName:::::::::::'.$productName) ;
						$index = $index + 1 ;
						$log->savelog($logId,"find product[ index: ".$index." ]: ".$productName) ;
						if (empty ($productName))
							continue;
						try {
							if( strlen(trim($productName)) < 9 || strlen(trim($productName)) >=11 ) {
								continue ;
							} ;
							$service->saveGatherAsin($id, trim($productName) ) ;
						} catch (Exception $e) {
							$log->savelog($logId,$productName." has exists!") ;
						}
					}
				}catch(Exception $e){
					$log->saveException($logId, $e );
				}
				$html->clear() ;
				unset($html) ;
			}else{
				$log->savelog($logId,"error fetching document: ".$snoopy->error) ;
			}
			unset($snoopy) ;
		}
	}
}