<?php
require_once("amazon/FBAInboundServiceMWS/Client.php");
require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentsRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentsByNextTokenRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentsResult.php");

require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentItemsRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentItemsByNextTokenRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/ListInboundShipmentItemsResult.php");


require_once("amazon/FBAInboundServiceMWS/Model/CreateInboundShipmentPlanRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/CreateInboundShipmentPlanResult.php");


require_once("amazon/FBAInboundServiceMWS/Model/Address.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentPlanRequestItemList.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentPlanRequestItem.php");
require_once("amazon/FBAInboundServiceMWS/Model/ShipmentStatusList.php");

require_once("amazon/FBAInboundServiceMWS/Exception.php");

class AmazonInbound {
	var $AWS_ACCESS_KEY_ID ; 
	var $AWS_SECRET_ACCESS_KEY ;
	var $APPLICATION_NAME;
	var $APPLICATION_VERSION;
	var $MERCHANT_ID ;
	var $MARKETPLACE_ID ;
	var $MerchantIdentifier ;
	var $APPLICATION_ID ;
	
	public function AmazonInbound( 
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
	
	/**
	 * step 1
	 */
	function  createInboundShipmentPlan($accountId,$planId){
		$System = ClassRegistry::init("System") ;
		
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_INBOUND_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new FBAInboundServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		
		$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentPlanRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		
		//获取计划信息
		$plan = $System->getObject("sql_supplychain_inbound_local_plan_getByPlanId", array('planId'=>$planId) ) ;
		
		$Address = new FBAInboundServiceMWS_Model_Address() ;
		$Address->setName( $plan['NAME'] ) ;
		$Address->setAddressLine1(  $plan['ADDRESS_LINE1']  ) ;
		$Address->setAddressLine2(  $plan['ADDRESS_LINE2'] ) ;
		$Address->setDistrictOrCounty(  $plan['DISTRICT_OR_COUNTY'] ) ;
		$Address->setCity(  $plan['CITY'] ) ;
		$Address->setStateOrProvinceCode(  $plan['STATE_OR_PROVINCE_CODE'] ) ;
		$Address->setCountryCode(  $plan['COUNTRY_CODE'] ) ;
		$Address->setPostalCode(  $plan['POSTAL_CODE'] ) ;
		$request->setShipFromAddress($Address) ;
		
		$InboundShipmentPlanRequestItemList =  new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItemList() ;
		
		//获取计划产品
		$planSkus = $System->exeSqlWithFormat("select * from sc_fba_inbound_local_plan_items where plan_id='{@#planId#}'",array('planId'=>$planId) );
		
		$array = array();
		foreach( $planSkus as $sku ){
			$InboundShipmentPlanRequestItem = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItem() ;
			$InboundShipmentPlanRequestItem->setSellerSKU($sku['SELLER_SKU']) ;
			$InboundShipmentPlanRequestItem->setQuantity($sku['QUANTITY']) ;
			$array[] = $InboundShipmentPlanRequestItem ;
		}
		
		$InboundShipmentPlanRequestItemList->setmember($array) ;
		$request->setInboundShipmentPlanRequestItems($InboundShipmentPlanRequestItemList) ;
		
		try {
			$response = $service->CreateInboundShipmentPlan($request);
			
			if ($response->isSetCreateInboundShipmentPlanResult()) {
				$result = $response->getCreateInboundShipmentPlanResult();
				$skus = $this->_doCreateInboundShipmentPlanResponse($result,$accountId,$planId  ) ;
			}
		
		
		} catch (FBAInboundServiceMWS_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
			echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
		}
		
	}
	
	/**
	 * step 2
	 */
	function createInboundShipment(){
		
	}
	
	/**
	 * step 3
	 */
	function putTransportContent(){
	
	}
	
	/**
	 * step 4
	 */
	function updateInboundShipment(){
		
	}
	
	
	
	function listInboundShipments($accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_INBOUND_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new FBAInboundServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		
		$request = new FBAInboundServiceMWS_Model_ListInboundShipmentsRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		//$request->setLastUpdatedBefore() ;
		//$request->setLastUpdatedAfter();
		
		//"+8 hour +40 minute +31 second"
		$time1 = new DateTime('now', new DateTimeZone('UTC')) ;
		$time1->modify(  "-48 hour" );
		$request->setLastUpdatedAfter( $time1->format("c") );
		
		$time = new DateTime('now', new DateTimeZone('UTC')) ;
		$time->modify(  TIME_ZONE_DIFFERENCE );
		$request->setLastUpdatedBefore( $time->format("c")   );
		//$request->setMarketplaceId( $this->MARKETPLACE_ID );
		
		
		$status = array() ;
		$status[] = "WORKING" ;
		$status[] = "SHIPPED" ;
		$status[] = "IN_TRANSIT" ;
		$status[] = "DELIVERED" ;
		$status[] = "CHECKED_IN" ;
		$status[] = "RECEIVING" ;
		$status[] = "CLOSED" ;
		$status[] = "CANCELLED" ;
		$status[] = "DELETED" ;
		$status[] = "ERROR" ;
		$statusList = new FBAInboundServiceMWS_Model_ShipmentStatusList() ;
		$statusList->setmember($status) ;
		
		$request->setShipmentStatusList($statusList) ;
		
		
		try {
			$response = $service->ListInboundShipments($request);
			if ($response->isSetListInboundShipmentsResult()) {
				$result = $response->getListInboundShipmentsResult();
				//删除所有的推荐
				$this->_doDelete(array('accountId'=>$accountId)) ;
				$skus = $this->_doListInboundShipmentsResponse($result,$accountId  ) ;
			}
		
		} catch (MWSRecommendationsSectionService_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
			echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
		}
	}
	

	function listInboundShipmentsByNextToken($nextToken,$accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
	
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_INBOUND_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
	
		$service = new FBAInboundServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
	
		$request = new FBAInboundServiceMWS_Model_ListInboundShipmentsByNextTokenRequest() ;
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setNextToken( $nextToken ) ;
	
		$skus = array();
		try {
				
			$response = $service->ListInboundShipmentsByNextToken($request);
			if ($response->isSetListInboundShipmentsByNextTokenResult()) {
				$result = $response->getListInboundShipmentsByNextTokenResult();
	
				$this->_doListInboundShipmentsResponse($result,$accountId  ) ;
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
	
	
	function listInboundShipmentItems($accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_INBOUND_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new FBAInboundServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		$request = new FBAInboundServiceMWS_Model_ListInboundShipmentItemsRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		
		$time1 = new DateTime('now', new DateTimeZone('UTC')) ;
		$time1->modify(  "-48 hour" );
		$request->setLastUpdatedAfter( $time1->format("c") );
		
		$time = new DateTime('now', new DateTimeZone('UTC')) ;
		$time->modify(  TIME_ZONE_DIFFERENCE );
		$request->setLastUpdatedBefore( $time->format("c")   );
		
		//$request->setMarketplaceId( $this->MARKETPLACE_ID );
		
		
		try {
			$response = $service->ListInboundShipmentItems($request);
			if ($response->isSetListInboundShipmentItemsResult()) {
				$result = $response->getListInboundShipmentItemsResult();
				//删除所有的推荐
				$this->_doDelete(array('accountId'=>$accountId)) ;
				$skus = $this->_doListInboundShipmentItemsResponse($result,$accountId  ) ;
			}
		
		} catch (MWSRecommendationsSectionService_Exception $ex) {
			echo("Caught Exception: " . $ex->getMessage() . "\n");
			echo("Response Status Code: " . $ex->getStatusCode() . "\n");
			echo("Error Code: " . $ex->getErrorCode() . "\n");
			echo("Error Type: " . $ex->getErrorType() . "\n");
			echo("Request ID: " . $ex->getRequestId() . "\n");
			echo("XML: " . $ex->getXML() . "\n");
			echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
		}
	}
	
	function listInboundShipmentItemsByNextToken($nextToken,$accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
	
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_INBOUND_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
	
		$service = new FBAInboundServiceMWS_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
	
		$request = new FBAInboundServiceMWS_Model_ListInboundShipmentItemsByNextTokenRequest() ;
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setNextToken( $nextToken ) ;
	
		$skus = array();
		try {
	
			$response = $service->ListInboundShipmentItemsByNextToken($request);
			if ($response->isSetListInboundShipmentItemsByNextTokenResult()) {
				$result = $response->getListInboundShipmentItemsByNextTokenResult();
	
				$this->_doListInboundShipmentItemsResponse($result,$accountId  ) ;
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
	
	function _doCreateInboundShipmentPlanResponse($result,$accountId,$planId ){

		$inventorySupplyList = $result->getInboundShipmentPlans();
	
		$memberList = $inventorySupplyList->getmember();
		foreach ($memberList as $member) {
			
			$item = array() ;
			$item['accountId'] = $accountId ;
			$item['planId'] = $planId ;
			$item['shipmentId'] = $member->getShipmentId() ;
				
			$itemIdentifier =  $member->getShipFromAddress() ;
			$item['name'] = $itemIdentifier->getName() ;
			$item['addressLine1'] = $itemIdentifier->getAddressLine1() ;
			$item['addressLine2'] = $itemIdentifier->getAddressLine2() ;
			$item['districtOrCounty'] = $itemIdentifier->getDistrictOrCounty() ;
			$item['city'] = $itemIdentifier->getCity() ;
			$item['stateOrProvinceCode'] = $itemIdentifier->getStateOrProvinceCode() ;
			$item['countryCode'] = $itemIdentifier->getCountryCode() ;
			$item['postalCode'] = $itemIdentifier->getPostalCode() ;
			
			$item['shipmentName'] = $member->getShipmentName() ;
			$item['destinationFulfillmentCenterId'] = $member->getDestinationFulfillmentCenterId() ;
			$item['labelPrepType'] = $member->getLabelPrepType() ;
			$this->_doSaveInboundShipments($item) ;
			
			$planProducts = $member->getItems() ;
			$skuMembers = $planProducts->getmember() ;
			foreach ($skuMembers as $skumember) {
				$item1 = array() ;
				$item1['accountId'] = $accountId ;
				$item1['shipmentId'] = $member->getShipmentId() ;
				$item1['sellerSku'] = $skumember->getSellerSKU() ;
				$item1['quantity'] = $skumember->getQuantity() ;
				$item1['fulfillmentNetworkSku'] = $skumember->getFulfillmentNetworkSKU() ;
					
				$this->_doSaveInboundShipmentItems($item1) ;
			}
		}
	}
	
	function _doListInboundShipmentItemsResponse($result,$accountId ){

		$inventorySupplyList = $result->getItemData();
		//debug($inventorySupplyList) ;
	
		$memberList = $inventorySupplyList->getmember();
		foreach ($memberList as $member) {
			/*''ShipmentId' => array('FieldValue' => null, 'FieldType' => 'string'),
				'SellerSKU' => array('FieldValue' => null, 'FieldType' => 'string'),
				'FulfillmentNetworkSKU' => array('FieldValue' => null, 'FieldType' => 'string'),
				'QuantityShipped' => array('FieldValue' => null, 'FieldType' => 'int'),
				'QuantityReceived' => array('FieldValue' => null, 'FieldType' => 'int'),
				'QuantityInCase' => array('FieldValue' => null, 'FieldType' => 'int'),
				*/
			$item = array() ;
			$item['accountId'] = $accountId ;
			$item['shipmentId'] = $member->getShipmentId() ;
			$item['sellerSku'] = $member->getSellerSKU() ;
			$item['fulfillmentNetworkSku'] = $member->getFulfillmentNetworkSKU() ;
			$item['quantityShipped'] = $member->getQuantityShipped() ;
			$item['quantityReceived'] = $member->getQuantityReceived() ;
			$item['quantityInCase'] = $member->getQuantityInCase() ;
			
			$this->_doSaveInboundShipmentItems($item) ;
		}
	
		if ($result->isSetNextToken())
		{
			$nextToken = $result->getNextToken() ;
			$this->listInboundShipmentItemsByNextToken($nextToken, $accountId) ;
		}
	}
	
	function _doListInboundShipmentsResponse($result,$accountId ){
	
		$inventorySupplyList = $result->getShipmentData();
	
		$memberList = $inventorySupplyList->getmember();
		foreach ($memberList as $member) {
			/*'ShipmentId' => array('FieldValue' => null, 'FieldType' => 'string'),
			 'ShipmentName' => array('FieldValue' => null, 'FieldType' => 'string'),
			'ShipFromAddress' => array('FieldValue' => null, 'FieldType' => 'FBAInboundServiceMWS_Model_Address'),
			'DestinationFulfillmentCenterId' => array('FieldValue' => null, 'FieldType' => 'string'),
			'ShipmentStatus' => array('FieldValue' => null, 'FieldType' => 'string'),
			'LabelPrepType' => array('FieldValue' => null, 'FieldType' => 'string'),
			'AreCasesRequired' => array('FieldValue' => null, 'FieldType' => 'bool'),
	
			'Name' => array('FieldValue' => null, 'FieldType' => 'string'),
			'AddressLine1' => array('FieldValue' => null, 'FieldType' => 'string'),
			'AddressLine2' => array('FieldValue' => null, 'FieldType' => 'string'),
			'DistrictOrCounty' => array('FieldValue' => null, 'FieldType' => 'string'),
			'City' => array('FieldValue' => null, 'FieldType' => 'string'),
			'StateOrProvinceCode' => array('FieldValue' => null, 'FieldType' => 'string'),
			'CountryCode' => array('FieldValue' => null, 'FieldType' => 'string'),
			'PostalCode' => array('FieldValue' => null, 'FieldType' => 'string'),
			*/
				
			$item = array() ;
			$item['accountId'] = $accountId ;
			$item['shipmentId'] = $member->getShipmentId() ;
				
			$itemIdentifier =  $member->getShipFromAddress() ;
			$item['name'] = $itemIdentifier->getName() ;
			$item['addressLine1'] = $itemIdentifier->getAddressLine1() ;
			$item['addressLine2'] = $itemIdentifier->getAddressLine2() ;
			$item['districtOrCounty'] = $itemIdentifier->getDistrictOrCounty() ;
			$item['city'] = $itemIdentifier->getCity() ;
			$item['stateOrProvinceCode'] = $itemIdentifier->getStateOrProvinceCode() ;
			$item['countryCode'] = $itemIdentifier->getCountryCode() ;
			$item['postalCode'] = $itemIdentifier->getPostalCode() ;
				
			$item['shipmentName'] = $member->getShipmentName() ;
			$item['destinationFulfillmentCenterId'] = $member->getDestinationFulfillmentCenterId() ;
			$item['shipmentStatus'] = $member->getShipmentStatus() ;
			$item['labelPrepType'] = $member->getLabelPrepType() ;
			$item['areCasesRequired'] = $member->getAreCasesRequired() ;
				
			$this->_doSaveInboundShipments($item) ;
		}
	
		if ($result->isSetNextToken())
		{
			$nextToken = $result->getNextToken() ;
			$this->listInboundShipmentsByNextToken($nextToken, $accountId) ;
		}
	}
	
	function _doSaveInboundShipmentItems($item){
		$existSql = "select * from sc_fba_inbound_plan_items where account_id = '{@#accountId#}' and shipment_id = '{@#shipmentId#}' and seller_sku ='{@#sellerSku#}'" ;
	
		$insertSql="  INSERT INTO sc_fba_inbound_plan_items 
								(ACCOUNT_ID, 
								SHIPMENT_ID, 
								SELLER_SKU, 
								FULFILLMENT_NETWORK_SKU, 
								QUANTITY_SHIPPED, 
								QUANTITY_RECEIVED, 
								QUANTITY_IN_CASE,
								QUANTITY,
								)
								VALUES
								('{@#accountId#}',
								'{@#shipmentId#}',
								'{@#sellerSku#}', 
								'{@#fulfillmentNetworkSku#}', 
								'{@#quantityShipped#}', 
								'{@#quantityReceived#}', 
								'{@#quantityInCase#}',
								'{@#quantity#}'
								)";
	
		$updateSql = "
					UPDATE sc_fba_inbound_plan_items 
						SET
						FULFILLMENT_NETWORK_SKU = '{@#fulfillmentNetworkSku#}' , 
						QUANTITY_SHIPPED = '{@#quantityShipped#}' , 
						QUANTITY_RECEIVED = '{@#quantityReceived#}' , 
						QUANTITY_IN_CASE = '{@#quantityInCase#}'
						WHERE
						account_id = '{@#accountId#}' and shipment_id = '{@#shipmentId#}' and seller_sku ='{@#sellerSku#}'" ;
	
		$utils  = ClassRegistry::init("Utils") ;
	
		$obj = $utils->getObject($existSql , $item) ;
		if( empty($obj) ){
			$utils->exeSql($insertSql,$item) ;
		}else{
			$utils->exeSql($updateSql,$item) ;
		}
	}
	
	function _doSaveInboundShipments($item){
		$existSql = "select * from sc_fba_inbound_plan where account_id = '{@#accountId#}' and shipment_id = '{@#shipmentId#}' " ;
		
		$insertSql="  INSERT INTO sc_fba_inbound_plan 
							(ACCOUNT_ID, 
							SHIPMENT_ID, 
							SHIPMENT_NAME, 
							DESTINATION_FULFILLMENT_CENTER_ID, 
							SHIPMENT_STATUS, 
							LABEL_PREP_TYPE, 
							ARE_CASES_REQUIRED, 
							NAME, 
							ADDRESS_LINE1, 
							ADDRESS_LINE2, 
							DISTRICT_OR_COUNTRY, 
							CITY, 
							STATE_OR_PROVINCE_CODE, 
							COUNTRY_CODE, 
							POSTAL_CODE, 
							CREATE_DATE,
							PLAN_ID
							)
							VALUES
							('{@#accountId#}', 
							'{@#shipmentId#}', 
							'{@#shipmentName#}', 
							'{@#destinationFulfillmentCenterId#}', 
							'{@#shipmentStatus#}', 
							'{@#labelPrepType#}', 
							'{@#areCasesRequired#}', 
							'{@#name#}', 
							'{@#addressLine1#}', 
							'{@#addressLine2#}', 
							'{@#districtOrCounty#}', 
							'{@#city#}', 
							'{@#stateOrProvinceCode#}', 
							'{@#countryCode#}', 
							'{@#postalCode#}', 
							NOW(),
							'{@#planId#}'
							)" ;
	
		$updateSql = "UPDATE sc_fba_inbound_plan 
				SET 
					SHIPMENT_NAME = '{@#shipmentName#}' , 
					DESTINATION_FULFILLMENT_CENTER_ID = '{@#destinationFulfillmentCenterId#}' , 
					SHIPMENT_STATUS = '{@#shipmentStatus#}' , 
					LABEL_PREP_TYPE = '{@#labelPrepType#}' , 
					ARE_CASES_REQUIRED = '{@#areCasesRequired#}' , 
					NAME = '{@#name#}' , 
					ADDRESS_LINE1 = '{@#addressLine1#}' , 
					ADDRESS_LINE2 = '{@#addressLine2#}' , 
					DISTRICT_OR_COUNTRY = '{@#districtOrCounty#}' , 
					CITY = '{@#city#}' , 
					STATE_OR_PROVINCE_CODE = '{@#stateOrProvinceCode#}' , 
					COUNTRY_CODE = '{@#countryCode#}' , 
					POSTAL_CODE = '{@#postalCode#}' 
				WHERE
				ACCOUNT_ID = '{@#accountId#}' AND 
				SHIPMENT_ID = '{@#shipmentId#}' 
				" ;

		$utils  = ClassRegistry::init("Utils") ;
		
		$obj = $utils->getObject($existSql , $item) ;
		if( empty($obj) ){
			$utils->exeSql($insertSql,$item) ;
		}else{
			$utils->exeSql($updateSql,$item) ;
		}
	}
	
	function _doDelete($detail){
		$deleteSql=" delete from sc_amazon_recommendations where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils  = ClassRegistry::init("Utils") ;
		$utils->exeSql($deleteSql,$detail) ;
	}
}
?>