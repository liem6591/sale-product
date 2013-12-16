<?php
require_once("amazon/FBAInventoryServiceMWS/Client.php");
require_once("amazon/FBAInventoryServiceMWS/Model/ListInventorySupplyRequest.php");
require_once("amazon/FBAInventoryServiceMWS/Model/ListInventorySupplyByNextTokenRequest.php");
require_once("amazon/FBAInventoryServiceMWS/Model/ListInventorySupplyResult.php");

require_once("amazon/FBAInventoryServiceMWS/Exception.php");

class AmazonFulfillment {
	var $AWS_ACCESS_KEY_ID ; 
	var $AWS_SECRET_ACCESS_KEY ;
	var $APPLICATION_NAME;
	var $APPLICATION_VERSION;
	var $MERCHANT_ID ;
	var $MARKETPLACE_ID ;
	var $MerchantIdentifier ;
	var $APPLICATION_ID ;
	
	public function AmazonFulfillment( 
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
	
	function listInventorySupply($accountId){
		$skus = array() ;
		
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;

		$config = array (
				'ServiceURL' =>  $platform['AMAZON_FULFILLMENT_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new FBAInventoryServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$config,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION
				 ) ;
		
		$request = new FBAInventoryServiceMWS_Model_ListInventorySupplyRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setResponseGroup('Detailed');
		$time = new DateTime('now', new DateTimeZone('UTC')) ;
		//$time->modify(  TIME_ZONE_DIFFERENCE );
		
		$request->setQueryStartDateTime( $time->format('c') ) ;
		try {
			$response = $service->listInventorySupply($request);
			if ($response->isSetListInventorySupplyResult()) {
				$result = $response->getListInventorySupplyResult();
				$skus = $this->_doListInventorySupplyResponse($result,$accountId  ) ;
			}
		
		} catch (FBAInventoryServiceMWS_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
		}
		
	}
	
	function listInventorySupplyByNextToken($nextToken,$accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_FULFILLMENT_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new FBAInventoryServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$config,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION
		) ;
		
		$request = new FBAInventoryServiceMWS_Model_ListInventorySupplyByNextTokenRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setNextToken( $nextToken ) ;
		
		$skus = array();
		try {
			
			$response = $service->listInventorySupplyByNextToken($request);
			if ($response->isSetListInventorySupplyByNextTokenResult()) {
				$result = $response->getListInventorySupplyByNextTokenResult();
				$skus = $this->_doListInventorySupplyResponse($result,$accountId,$skus) ;
			}
		
		} catch (FBAInventoryServiceMWS_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
		}
		
		return $skus ;
		
	}

	
	function _doListInventorySupplyResponse($result,$accountId ){
				$skus = array();
				$inventorySupplyList = $result->getInventorySupplyList();
				$memberList = $inventorySupplyList->getmember();
				foreach ($memberList as $member) {
					$item = array();
					$item['accountId'] = $accountId ;
					$sellerSku = "" ;
					if ($member->isSetSellerSKU()){
						$item['sellerSku'] = $member->getSellerSKU()  ;
						$skus[] = $member->getSellerSKU()   ;
						$sellerSku = $member->getSellerSKU()   ;
					}
					if ($member->isSetFNSKU()){
						$item['fnsku'] = $member->getFNSKU()  ;
					}
					if ($member->isSetASIN()){
						$item['asin'] = $member->getASIN()  ;
					}
					if ($member->isSetCondition()){
						$item['condition'] = $member->getCondition()  ;
					}
					if ($member->isSetTotalSupplyQuantity()){
						$item['totalSupplyQuantity'] = $member->getTotalSupplyQuantity()  ;
					}
					if ($member->isSetInStockSupplyQuantity())
					{
						$item['inStockSupplyQuantity'] = $member->getInStockSupplyQuantity()  ;
					}
					if ($member->isSetEarliestAvailability()) {
						$earliestAvailability = $member->getEarliestAvailability();
						if ($earliestAvailability->isSetTimepointType())
						{
							$item['earliestTimepointType'] = $earliestAvailability->getTimepointType()  ;
						}
						if ($earliestAvailability->isSetDateTime())
						{
							$item['earliestDateTime'] = $earliestAvailability->getDateTime()  ;
						}
					}
					
					//删除所有的Item
					$this->_doDeleteDetails($item) ;
					if ($member->isSetSupplyDetail()) {
						$supplyDetail = $member->getSupplyDetail();
						$member1List = $supplyDetail->getmember();
						echo count($member1List) ;
						$item['quantityInStock'] = 0 ;
						$item['quantityTransfer'] = 0 ;
						$item['quantityInbound'] = 0 ;
						foreach ($member1List as $member1) {
							$detailItem = array() ;
							$detailItem['accountId'] = $accountId ;
							$detailItem['sellerSku'] = $sellerSku ;
							$supplyType = "" ;
							if ($member1->isSetSupplyType())
							{
								$detailItem['supplyType'] = $member1->getSupplyType()  ;
								$supplyType = $member1->getSupplyType()  ;
							}
							if ($member1->isSetQuantity())
							{
								$detailItem['quantity'] = $member1->getQuantity()  ;
								if($supplyType == 'InStock'){
									$item['quantityInStock'] = $item['quantityInStock'] + $member1->getQuantity()  ;
								}else if($supplyType == 'Transfer'){
									$item['quantityTransfer'] =$item['quantityTransfer']  + $member1->getQuantity()  ;
								}else if($supplyType == 'Inbound'){
									$item['quantityInbound'] = $item['quantityInbound']  + $member1->getQuantity()  ;
								}
							}
							if ($member1->isSetEarliestAvailableToPick()) {
								$earliestAvailableToPick = $member1->getEarliestAvailableToPick();
								if ($earliestAvailableToPick->isSetTimepointType())
								{
									$detailItem['earliestTimepointType'] = $earliestAvailableToPick->getTimepointType()  ;
								}
								if ($earliestAvailableToPick->isSetDateTime())
								{
									$detailItem['earliestDateTime'] = $earliestAvailableToPick->getDateTime()  ;
								}
							}
							if ($member1->isSetLatestAvailableToPick()) {
								$latestAvailableToPick = $member1->getLatestAvailableToPick();
								if ($latestAvailableToPick->isSetTimepointType())
								{
									$detailItem['latestTimepointType'] = $latestAvailableToPick->getTimepointType()  ;
								}
								if ($latestAvailableToPick->isSetDateTime())
								{
									$detailItem['latestDateTime'] = $latestAvailableToPick->getDateTime()  ;
								}
							}
							
							$this->_doSaveDetails($detailItem) ;
							debug($detailItem) ;
						}
					}
					$this->_doSave($item) ;
						
				}
	
			if ($result->isSetNextToken())
			{
				$nextToken = $result->getNextToken() ;
				$skus_ = $this->listInventorySupplyByNextToken($nextToken, $accountId) ;
				foreach ( $skus_ as $sku ){
					$skus[]= $sku ;
				}
			}
			return $skus ;
			/*
		if ($response->isSetResponseMetadata()) {
			echo("            ResponseMetadata\n");
			$responseMetadata = $response->getResponseMetadata();
			if ($responseMetadata->isSetRequestId())
			{
				echo("                RequestId\n");
				echo("                    " . $responseMetadata->getRequestId() . "\n");
			}
		}*/
	}
	
	function _doSaveDetails($detail){
		$insertSql=" INSERT INTO sc_fba_supply_inventory_details 
						(ACCOUNT_ID, 
						SELLER_SKU, 
						QUANTITY, 
						SUPPLY_TYPE, 
						EARLIEST_TIMEPOINT_TYPE, 
						EARLIEST_DATETIME, 
						LATEST_DATETIME, 
						LATEST_TIMEPOINT_TYPE
						)
						VALUES
						('{@#accountId#}', 
						'{@#sellerSku#}', 
						'{@#quantity#}', 
						'{@#supplyType#}', 
						'{@#earliestTimepointType#}', 
						'{@#earliestDatetime#}', 
						'{@#latestDatetime#}', 
						'{@#latestTimepointType#}'
						)" ;
		$utils  = ClassRegistry::init("Utils") ;
		$utils->exeSql($insertSql,$detail) ;
	}
	
	function _doDeleteDetails($detail){
		$deleteSql=" delete from sc_fba_supply_inventory_details where ACCOUNT_ID = '{@#accountId#}' AND SELLER_SKU = '{@#sellerSku#}'   " ;
		$utils  = ClassRegistry::init("Utils") ;
		$utils->exeSql($deleteSql,$detail) ;
	}
	
	function _doSave($item){
		$querySql = "select * from sc_fba_supply_inventory where ACCOUNT_ID = '{@#accountId#}' AND SELLER_SKU = '{@#sellerSku#}' " ;
		
		$updateSql= "UPDATE sc_fba_supply_inventory 
				SET
				`CONDITION` = '{@#condition#}' , 
				TOTAL_SUPPLY_QUANTITY = '{@#totalSupplyQuantity#}' , 
				IN_STOCK_SUPPLY_QUANTITY = '{@#inStockSupplyQuantity#}' , 
				EARLIEST_TIMEPOINT_TYPE = '{@#earliestTimepointType#}' , 
				EARLIEST_DATETIME = '{@#earliestDatetime#}',
				QUANTITY_IN_STOCK='{@#quantityInStock:0#}', 
				QUANTITY_INBOUND='{@#quantityInbound:0#}', 
				QUANTITY_TRANSFER='{@#quantityTransfer:0#}'
				WHERE ACCOUNT_ID = '{@#accountId#}' AND SELLER_SKU = '{@#sellerSku#}' " ;
		
		$insertSql = "INSERT INTO sc_fba_supply_inventory 
			(
			ACCOUNT_ID, 
			SELLER_SKU, 
			FNSKU, 
			ASIN, 
			`CONDITION`, 
			TOTAL_SUPPLY_QUANTITY, 
			IN_STOCK_SUPPLY_QUANTITY, 
			EARLIEST_TIMEPOINT_TYPE, 
			EARLIEST_DATETIME,
			QUANTITY_IN_STOCK,
				QUANTITY_INBOUND,
				QUANTITY_TRANSFER
			)
			VALUES
			('{@#accountId#}', 
			'{@#sellerSku#}', 
			'{@#fnsku#}', 
			'{@#asin#}', 
			'{@#condition#}', 
			'{@#totalSupplyQuantity#}', 
			'{@#inStockSupplyQuantity#}', 
			'{@#earliestTimepointType#}', 
			'{@#earliestDatetime#}',
			'{@#quantityInStock:0#}', 
			'{@#quantityInbound:0#}', 
			'{@#quantityTransfer:0#}'
			)" ;
		
		$utils  = ClassRegistry::init("Utils") ;
		$obj = $utils->getObject($querySql,$item) ;
		if(empty($obj)){
			$utils->exeSql($insertSql,$item) ;
		}else{
			$utils->exeSql($updateSql,$item) ;
		}
		
		$amazonAccount  = ClassRegistry::init("Amazonaccount") ;
		$amazonAccount->saveAccountProductForFBAByAsyn(array(
				'ASIN'=>$item['asin'],
				'SKU'=>$item['sellerSku'],
				'FC_SKU'=>$item['fnsku'],
				'accountId'=>$item['accountId'],
				'FBA_SELLABLE'=>$item['inStockSupplyQuantity'],
				'fulfillment'=>'AMAZON_NA',
				'quantity'=>$item['totalSupplyQuantity']
		),3) ;
	}
}
?>