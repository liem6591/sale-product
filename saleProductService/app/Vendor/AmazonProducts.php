<?php
require_once("amazon/MarketplaceWebServiceProducts/Client.php");
require_once("amazon/MarketplaceWebServiceProducts/Model/GetLowestOfferListingsForASINRequest.php");
require_once("amazon/MarketplaceWebServiceProducts/Model/GetLowestOfferListingsForASINResult.php");
require_once("amazon/MarketplaceWebServiceProducts/Model/ASINListType.php");

require_once("amazon/MarketplaceWebServiceProducts/Exception.php");

class AmazonProducts {
	var $AWS_ACCESS_KEY_ID ; 
	var $AWS_SECRET_ACCESS_KEY ;
	var $APPLICATION_NAME;
	var $APPLICATION_VERSION;
	var $MERCHANT_ID ;
	var $MARKETPLACE_ID ;
	var $MerchantIdentifier ;
	var $APPLICATION_ID ;
	
	public function AmazonProducts( 
		$AWS_ACCESS_KEY_ID, 
		$AWS_SECRET_ACCESS_KEY, 
		$APPLICATION_NAME, 
		$APPLICATION_VERSION, 
		$MERCHANT_ID, 
		$MARKETPLACE_ID,
		$MerchantIdentifier , 
		$APPLICATION_ID = '' 
	){
		$this->AWS_ACCESS_KEY_ID 	= $AWS_ACCESS_KEY_ID ;
		$this->AWS_SECRET_ACCESS_KEY= $AWS_SECRET_ACCESS_KEY ;
		$this->APPLICATION_NAME 	= $APPLICATION_NAME ;
		$this->APPLICATION_VERSION 	= $APPLICATION_VERSION ;
		$this->MERCHANT_ID 			= $MERCHANT_ID ;
		$this->MARKETPLACE_ID 		= $MARKETPLACE_ID ;
		$this->MerchantIdentifier 	= $MerchantIdentifier ;
		$this->APPLICATION_ID       = $APPLICATION_ID;
	}
	
	public function getAccountPlatform($accountId){
		$System = ClassRegistry::init("System") ;
		return $System->getAccountPlatformConfig($accountId ) ;
	}
	
	public function GetLowestOfferListingsForASIN($accountId){
		//获取账户SKU
		$SqlUtils = ClassRegistry::init("SqlUtils") ;
		
		$start = 0 ;
		$limit = 20 ;
		while(true){
			
			try{
				$sql = "select distinct ASIN  from sc_amazon_account_product where status = 'Y' and account_id = '{@#accountId#}'  limit {@#start#},{@#limit#}" ;
				$items = $SqlUtils->exeSqlWithFormat( $sql , array('accountId'=>$accountId,'start'=>$start,'limit'=>$limit) ) ;
					
				$isExist = false ;
				$array = array() ;
				foreach( $items as $item ){
					$array[] = $item['ASIN'] ;
				}
				$this->_GetLowestOfferListingsForASIN( $accountId ,$array) ;
					
				if( count($items) < $limit ){
					//处理完成
					break ;
				}else{
					$start = $start + $limit ;
				}
			}catch(Exception $e){
				//异常
				debug($e) ;
			}
		}
	}
	
	public function _GetLowestOfferListingsForASIN($accountId , $asins){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		$SqlUtils = ClassRegistry::init("SqlUtils") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_PRODUCTS_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new MarketplaceWebServiceProducts_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		$request = new MarketplaceWebServiceProducts_Model_GetLowestOfferListingsForASINRequest();
		$request->setMarketplaceId($this->MARKETPLACE_ID) ;
		$request->setSellerId($this->MERCHANT_ID);
		$request->setItemCondition("New");
		$SellerSKUList = new MarketplaceWebServiceProducts_Model_ASINListType();
		$SellerSKUList->setASIN($asins) ;
		
		$request->setASINList($SellerSKUList) ;
		
		try {
			$response = $service->getLowestOfferListingsForASIN($request);
		
			//echo ("Service Response\n");
			//echo ("=============================================================================\n");
		
			//echo("        GetLowestOfferListingsForASINResponse\n");
			$getLowestOfferListingsForASINResultList = $response->getGetLowestOfferListingsForASINResult();
			foreach ($getLowestOfferListingsForASINResultList as $getLowestOfferListingsForASINResult) {
				
				//debug($getLowestOfferListingsForASINResult) ;
				//print_r($getLowestOfferListingsForASINResult);
				//continue ;
				
				$asin = "" ;
				$landedPrice = 0 ;
				if ($getLowestOfferListingsForASINResult->isSetASIN()) {
					$asin = $getLowestOfferListingsForASINResult->getASIN() ;
				}
				echo $asin ;
				echo '<br/>------------ASIN-----------<br/>';
				
				$priceArray = array() ;
				
				if ($getLowestOfferListingsForASINResult->isSetProduct()) {
					$product = $getLowestOfferListingsForASINResult->getProduct();

					if ($product->isSetLowestOfferListings()) {
						$lowestOfferListings = $product->getLowestOfferListings();
						$lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();
						foreach ($lowestOfferListingList as $lowestOfferListing) {
							$landedPrice = 0 ;
							$fulfillmentChannel = "" ;
							if ($lowestOfferListing->isSetPrice()) {
								$price1 = $lowestOfferListing->getPrice();
								if ($price1->isSetLandedPrice()) {
									$landedPrice1 = $price1->getLandedPrice();
									$landedPrice = $landedPrice1->getAmount() ;
								}
							}
							if ($lowestOfferListing->isSetQualifiers()) {
								$qualifiers = $lowestOfferListing->getQualifiers();
								
								if ($qualifiers->isSetFulfillmentChannel())
								{
									$fulfillmentChannel = $qualifiers->getFulfillmentChannel() ;
								}
							}
							$priceArray[] = array("fulfillmentChannel"=>$fulfillmentChannel , 'landedPrice'=>$landedPrice) ;
						}
					}
				}
				debug($priceArray) ;
				$minPrice = null ;
				$minFbaPrice = null ;
				$mp = 100000 ;
				$mfp = 100000 ;
				foreach($priceArray as $price){
					$mp = min($mp ,$price['landedPrice'] ) ;
					if( $mp == $price['landedPrice']   ){
						$minPrice = $price ;
					}
					
					if( $price['fulfillmentChannel'] == 'Amazon' ){
						$mfp = min($mfp ,$price['landedPrice'] ) ;
						if( $mfp == $price['landedPrice']   ){
							$minFbaPrice = $price ;
						}
					}
				}
				
				if( $mp != 100000 ){
					//最低价格
					//debug($minPrice) ;
					$sql = "update sc_amazon_account_product set lowest_price = '{@#lowestPrice#}' where asin ='{@#asin#}'" ;
					$SqlUtils->exeSql($sql,array('lowestPrice'=>$mp,'asin'=>$asin)) ;
				}else{
					$sql = "update sc_amazon_account_product set lowest_price = null where asin ='{@#asin#}'" ;
					$SqlUtils->exeSql($sql,array('lowestPrice'=>$mp,'asin'=>$asin)) ;
				}
				
				if( $mfp != 100000 ){
					//FBA最低价格
					$sql = "update sc_amazon_account_product set lowest_fba_price = '{@#lowestPrice#}' where asin ='{@#asin#}'" ;
					$SqlUtils->exeSql($sql,array('lowestPrice'=>$mfp,'asin'=>$asin)) ;
				}else{
					$sql = "update sc_amazon_account_product set lowest_fba_price = null where asin ='{@#asin#}'" ;
					$SqlUtils->exeSql($sql,array('lowestPrice'=>$mfp,'asin'=>$asin)) ;
				}
				
			}
		} catch (MarketplaceWebServiceProducts_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
			echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
		}
			
	}
	
}
?>