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

require_once("amazon/FBAInboundServiceMWS/Model/CreateInboundShipmentRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/CreateInboundShipmentResult.php");

require_once("amazon/FBAInboundServiceMWS/Model/UpdateInboundShipmentRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/UpdateInboundShipmentResult.php");

require_once("amazon/FBAInboundServiceMWS/Model/PutTransportContentRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/PutTransportContentResult.php");

require_once("amazon/FBAInboundServiceMWS/Model/GetPackageLabelsRequest.php");
require_once("amazon/FBAInboundServiceMWS/Model/GetPackageLabelsResult.php");


require_once("amazon/FBAInboundServiceMWS/Model/Address.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentPlanRequestItemList.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentPlanRequestItem.php");
require_once("amazon/FBAInboundServiceMWS/Model/ShipmentStatusList.php");


require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentItem.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentItemList.php");
require_once("amazon/FBAInboundServiceMWS/Model/InboundShipmentHeader.php");
require_once("amazon/FBAInboundServiceMWS/Model/TransportDetailInput.php");

require_once("amazon/FBAInboundServiceMWS/Model/PartneredSmallParcelDataInput.php");
require_once("amazon/FBAInboundServiceMWS/Model/NonPartneredSmallParcelDataInput.php");
require_once("amazon/FBAInboundServiceMWS/Model/PartneredLtlDataInput.php");
require_once("amazon/FBAInboundServiceMWS/Model/NonPartneredLtlDataInput.php");
require_once("amazon/FBAInboundServiceMWS/Model/NonPartneredSmallParcelPackageInputList.php");
require_once("amazon/FBAInboundServiceMWS/Model/NonPartneredSmallParcelPackageInput.php");

require_once("amazon/FBAInboundServiceMWS/Model/ShipmentIdList.php");

require_once("amazon/FBAInboundServiceMWS/Model/Contact.php");


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
		
		//$planSkus = $System->exeSqlWithFormat("select * from sc_fba_inbound_local_plan_items where plan_id='{@#planId#}'",array('planId'=>$planId) );
		$planSkus = $System->exeSqlWithFormat("sql_warehouse_box_products_byInId",array('inId'=>$plan['inId']) );
		
		$array = array();
		foreach( $planSkus as $sku ){
			$InboundShipmentPlanRequestItem = new FBAInboundServiceMWS_Model_InboundShipmentPlanRequestItem() ;
			$InboundShipmentPlanRequestItem->setSellerSKU( $sku['LISTING_SKU'] ) ;
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
	function createInboundShipment($accountId,$shipmentId){

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
		
		
		$request = new FBAInboundServiceMWS_Model_CreateInboundShipmentRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setShipmentId( $shipmentId ) ;
		
		$ship = $System->getObject("select * from sc_fba_inbound_plan
					where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",array("shipmentId"=>$shipmentId,"accountId"=>$accountId)) ;
		
		$planId = $ship['PLAN_ID'] ;
		
		if( empty($planId) ) return "planId not exists,action failed!";
		
		$plan =  $System->getObject("select * from sc_fba_inbound_local_plan
					where plan_id= '{@#planId#}' ",array("planId"=>$planId)) ;
		
		$header = new FBAInboundServiceMWS_Model_InboundShipmentHeader() ;
		$header->setShipmentName( $ship['SHIPMENT_NAME'] ) ;
		$header->setDestinationFulfillmentCenterId( $ship['DESTINATION_FULFILLMENT_CENTER_ID'] ) ;//destinationFulfillmentCenterId
		$header->setAreCasesRequired(false) ;
		$header->setShipmentStatus("WORKING") ;
		$header->setLabelPrepPreference( $ship['LABEL_PREP_TYPE'] ) ;
		
		$Address = new FBAInboundServiceMWS_Model_Address() ;
		$Address->setName( $plan['NAME'] ) ;
		$Address->setAddressLine1(  $plan['ADDRESS_LINE1']  ) ;
		$Address->setAddressLine2(  $plan['ADDRESS_LINE2'] ) ;
		$Address->setDistrictOrCounty(  $plan['DISTRICT_OR_COUNTY'] ) ;
		$Address->setCity(  $plan['CITY'] ) ;
		$Address->setStateOrProvinceCode(  $plan['STATE_OR_PROVINCE_CODE'] ) ;
		$Address->setCountryCode(  $plan['COUNTRY_CODE'] ) ;
		$Address->setPostalCode(  $plan['POSTAL_CODE'] ) ;
		
		$header->setShipFromAddress($Address) ;
		$request->setInboundShipmentHeader($header) ;
		
		
		
		$items = new FBAInboundServiceMWS_Model_InboundShipmentItemList() ;
		$memberArray = array();
		$skuMembers = $System->exeSqlWithFormat("select * from sc_fba_inbound_plan_items
				where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",array("shipmentId"=>$shipmentId,"accountId"=>$accountId)) ;
		foreach ($skuMembers as $skumember) {
			$si = new FBAInboundServiceMWS_Model_InboundShipmentItem() ;
			$si->setSellerSKU($skumember['SELLER_SKU']) ;
			
			$quantity = $skumember['QUANTITY_SHIPPED'] ;
			if( !empty( $skumember['QUANTITY']  ) ){
				$quantity = $skumember['QUANTITY']  ;
			}
			$si->setQuantityShipped( $quantity ) ;
			$memberArray[] = $si ;
		}
		$items->setmember($memberArray) ;
		$request->setInboundShipmentItems($items) ;
		
		try {
			$response = $service->CreateInboundShipment($request);
				
			if ($response->isSetCreateInboundShipmentResult()) {
				$result = $response->getCreateInboundShipmentResult();
				$shipId = $result->getShipmentId() ;
				
				$this->listInboundShipmentsByShipmentId($accountId, $shipmentId) ;
				$this->listInboundShipmentItemsByShipmentId($accountId, $shipmentId) ;
				return $shipId ;
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
	 * 获取label
	 */
	function  getPackageLabels($accountId,$shipmentId,$pageType,$NumberOfPackages){

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
		
		
		$request = new FBAInboundServiceMWS_Model_GetPackageLabelsRequest() ;
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setShipmentId($shipmentId) ;
		$request->setPageType($pageType) ;
		$request->setNumberOfPackages($NumberOfPackages) ;

		try {
			$response = $service->getPackageLabels($request) ;//CreateInboundShipmentPlan($request);
		
			if ($response->isSetGetPackageLabelsResult()) {
				$result = $response->getGetPackageLabelsResult();
				$result = $result->getTransportDocument() ;
				$pdfDocument = $result->getPdfDocument() ;
				//保存document到数据库
				$System->exeSql("update sc_fba_inbound_plan
						set label = '{@#pdfDocument#}'
					where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",
						array("shipmentId"=>$shipmentId,"accountId"=>$accountId,'pdfDocument'=>$pdfDocument)) ;
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
	 * 获取TrackNumber状态
	 */
	function getTransportContent(){

	}
	
	/**
	 * step 3
	 */
	function putTransportContent($accountId,$shipmentId){
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
		
		
		$request = new FBAInboundServiceMWS_Model_PutTransportContentRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		
		$shippmentType = "SP" ;
		$isPartnered = false ;
		
		$ship = $System->getObject("select * from sc_fba_inbound_plan
					where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",array("shipmentId"=>$shipmentId,"accountId"=>$accountId)) ;
		
		//true or false 
		$request->setIsPartnered( $ship['IS_PARTNERED'] ) ;
		$request->setShipmentId($shipmentId) ;
		/**
		    SP – Small Parcel
			LTL – Less Than Truckload/Full Truckload (LTL/FTL)
		 */
		$request->setShipmentType( $ship['SHIPMENT_TYPE'] ) ;
		$transportDetailInput = new  FBAInboundServiceMWS_Model_TransportDetailInput() ;
		
		if( $shippmentType == 'SP'  ){
			if( $isPartnered ){
				/*$detailData = new FBAInboundServiceMWS_Model_PartneredSmallParcelDataInput() ;
				$spInputList = new FBAInboundServiceMWS_Model_PartneredSmallParcelPackageInputList() ;
				$spInput= new FBAInboundServiceMWS_Model_PartneredSmallParcelPackageInput() ;
				$spInputList->setmember($value) ;
				$detailData->setPackageList($spInputList) ;
				$transportDetailInput->setPartneredSmallParcelData($detailData) ;*/
			}else{
				$detailData = new FBAInboundServiceMWS_Model_NonPartneredSmallParcelDataInput() ;
				$detailData->setCarrierName( $ship['CARRIER_NAME'] ) ;
				
				$spInputList = new FBAInboundServiceMWS_Model_NonPartneredSmallParcelPackageInputList() ;
				
				$spInput= new FBAInboundServiceMWS_Model_NonPartneredSmallParcelPackageInput() ;
				$spInput->setTrackingId("") ;
				
				$detailData->setPackageList($value) ;
				$transportDetailInput->setNonPartneredSmallParcelData($detailData) ;
			}
		}/*else if( $shippmentType == 'LTL'  ){
			if( $isPartnered ){
				$detailData1 = new FBAInboundServiceMWS_Model_PartneredLtlDataInput() ;
				$contact = new FBAInboundServiceMWS_Model_Contact() ;
				$contact->setEmail($value) ;
				$contact->setFax($value) ;
				$contact->setName($value) ;
				$contact->setPhone($value) ;
				$detailData1->setContact($contact) ;
				$detailData1->setBoxCount($value) ;
				$detailData1->setFreightReadyDate($value) ;
				$transportDetailInput->setPartneredLtlData($detailData1) ;
			}else{
				$detailData2 = new FBAInboundServiceMWS_Model_NonPartneredLtlDataInput() ;
				$detailData2->setCarrierName($value) ;
				$detailData2->setProNumber($value) ;
				$transportDetailInput->setNonPartneredLtlData($detailData2) ;
			}
		}*/
		
		$request->setTransportDetails($value) ;
	}
	
	/**
	 * step 4
	 */
	function updateInboundShipment($accountId , $shipmentId  ){
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
		
		$request = new FBAInboundServiceMWS_Model_UpdateInboundShipmentRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setShipmentId($shipmentId) ;
		//通过shippmentId获取header
		$ship = $System->getObject("select * from sc_fba_inbound_plan 
					where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",array("shipmentId"=>$shipmentId,"accountId"=>$accountId)) ;
		
		$header = new FBAInboundServiceMWS_Model_InboundShipmentHeader() ;
		$header->setShipmentName( $ship['SHIPMENT_NAME'] ) ;
		$header->setDestinationFulfillmentCenterId( $ship['DESTINATION_FULFILLMENT_CENTER_ID'] ) ;
		$header->setShipmentStatus($ship['FIX_SHIP_STATUS']) ;
		$header->setLabelPrepPreference( $ship['LABEL_PREP_TYPE'] ) ;
		
		$Address = new FBAInboundServiceMWS_Model_Address() ;
		$Address->setName( $ship['NAME'] ) ;
		$Address->setAddressLine1(  $ship['ADDRESS_LINE1']  ) ;
		$Address->setAddressLine2(  $ship['ADDRESS_LINE2'] ) ;
		$Address->setDistrictOrCounty(  $ship['DISTRICT_OR_COUNTY'] ) ;
		$Address->setCity(  $ship['CITY'] ) ;
		$Address->setStateOrProvinceCode(  $ship['STATE_OR_PROVINCE_CODE'] ) ;
		$Address->setCountryCode(  $ship['COUNTRY_CODE'] ) ;
		$Address->setPostalCode(  $ship['POSTAL_CODE'] ) ;
		$header->setShipFromAddress($Address) ;
		
		$request->setInboundShipmentHeader($header) ;
		//通过ID获取items
		$items = new FBAInboundServiceMWS_Model_InboundShipmentItemList() ;
		$memberArray = array();
		$skuMembers = $System->exeSqlWithFormat("select * from sc_fba_inbound_plan_items
				where shipment_id= '{@#shipmentId#}' and account_id = '{@#accountId#}' ",array("shipmentId"=>$shipmentId,"accountId"=>$accountId)) ;
		foreach ($skuMembers as $skumember) {
			$si = new FBAInboundServiceMWS_Model_InboundShipmentItem() ;
			$si->setSellerSKU($skumember['SELLER_SKU']) ;
			
			$quantity = $skumember['QUANTITY_SHIPPED'] ;
			if( !empty( $skumember['QUANTITY']  ) ){
				$quantity = $skumember['QUANTITY']  ;
			}
			$si->setQuantityShipped( $quantity ) ;
			$memberArray[] = $si ;
		}
		$items->setmember($memberArray) ;
		$request->setInboundShipmentItems($items) ;
		
	    try {
	        $response = $service->UpdateInboundShipment($request);
	        
	        $this->listInboundShipmentsByShipmentId($accountId, $shipmentId) ;
	        $this->listInboundShipmentItemsByShipmentId($accountId, $shipmentId) ;
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
				$skus = $this->_doListInboundShipmentsResponse($result,$accountId  ) ;
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
	
	function listInboundShipmentsByShipmentId($accountId,$shipmentId){
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
		
		$idList = new FBAInboundServiceMWS_Model_ShipmentIdList() ;
		$array = array() ;
		$array[] = $shipmentId ;
		$idList->setmember($array) ;
		$request->setShipmentIdList($idList) ;
		
		try {
			$response = $service->ListInboundShipments($request);
			if ($response->isSetListInboundShipmentsResult()) {
				$result = $response->getListInboundShipmentsResult();
				//删除所有的推荐
				$skus = $this->_doListInboundShipmentsResponse($result,$accountId  ) ;
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
	
	function listInboundShipmentItemsByShipmentId($accountId,$shipmentId){
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
		$request->setShipmentId($shipmentId) ;
	
		try {
			$response = $service->ListInboundShipmentItems($request);
			if ($response->isSetListInboundShipmentItemsResult()) {
				$result = $response->getListInboundShipmentItemsResult();
				$skus = $this->_doListInboundShipmentItemsResponse($result,$accountId ,$shipmentId ) ;
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
				$skus = $this->_doListInboundShipmentItemsResponse($result,$accountId  ) ;
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
		$index = 0 ;
		
		$date = date("m/d/y h:i A") ; 
		
		foreach ($memberList as $member) {
			$index++ ;
			$item = array() ;
			$item['accountId'] = $accountId ;
			$item['planId'] = $planId ;
			$item['shipmentId'] = $member->getShipmentId() ;
				
			$itemIdentifier =  $member->getShipToAddress() ;
			$item['toName'] = $itemIdentifier->getName() ;
			$item['toAddressLine1'] = $itemIdentifier->getAddressLine1() ;
			$item['toAddressLine2'] = $itemIdentifier->getAddressLine2() ;
			$item['toDistrictOrCounty'] = $itemIdentifier->getDistrictOrCounty() ;
			$item['toCity'] = $itemIdentifier->getCity() ;
			$item['toStateOrProvinceCode'] = $itemIdentifier->getStateOrProvinceCode() ;
			$item['toCountryCode'] = $itemIdentifier->getCountryCode() ;
			$item['toPostalCode'] = $itemIdentifier->getPostalCode() ;
			
			//default shipName
			$shipName = "FBA ($date) - $index" ;//m/d/y h:i A
			
			$item['shipmentName'] = $shipName ;
			$item['destinationFulfillmentCenterId'] = $member->getDestinationFulfillmentCenterId() ;
			$item['labelPrepType'] = $member->getLabelPrepType() ;
			$item['fixShipStatus'] = "0" ;
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
			
			//$this->createInboundShipment($accountId,$itemIdentifier,$item,$skuMembers) ;
		}
	}
	
	function _doListInboundShipmentItemsResponse($result,$accountId ,$shipmentId=null){

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
			$shipmentId1 = $member->getShipmentId()  ;
			
			$shipmentId = empty($shipmentId1)?$shipmentId:$shipmentId ;
			
			$item = array() ;
			$item['accountId'] = $accountId ;
			$item['shipmentId'] = $shipmentId ;
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
								QUANTITY
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
		$utils  = ClassRegistry::init("Utils") ;
		
		if(isset($item['planId'])){
			$plan = $utils->getObject("select * from sc_fba_inbound_local_plan where account_id = '{@#accountId#}' and plan_id = '{@#planId#}' ",$item) ;
			if(!empty($plan)){
				$item['shipmentType'] = $plan['SHIPMENT_TYPE'] ;
				$item['isPartnered'] = $plan['IS_PARTNERED'] ;
				$item['carrierName'] = $plan['CARRIER_NAME'] ;
			}
		}
		
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
							DISTRICT_OR_COUNTY, 
							CITY, 
							STATE_OR_PROVINCE_CODE, 
							COUNTRY_CODE, 
							POSTAL_CODE, 
							CREATE_DATE,
							PLAN_ID,
							SHIPMENT_TYPE,
							IS_PARTNERED,
							CARRIER_NAME,
							FIX_SHIP_STATUS,
							TO_NAME, 
							TO_ADDRESS_LINE1, 
							TO_ADDRESS_LINE2, 
							TO_DISTRICT_OR_COUNTY, 
							TO_CITY, 
							TO_STATE_OR_PROVINCE_CODE, 
							TO_COUNTRY_CODE, 
							TO_POSTAL_CODE
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
							'{@#planId#}',
							'{@#shipmentType#}',
							'{@#isPartnered#}',
							'{@#carrierName#}',
							'{@#fixShipStatus#}',
							'{@#toName#}', 
							'{@#toAddressLine1#}', 
							'{@#toAddressLine2#}', 
							'{@#toDistrictOrCounty#}', 
							'{@#toCity#}', 
							'{@#toStateOrProvinceCode#}', 
							'{@#toCountryCode#}', 
							'{@#toPostalCode#}'
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
					DISTRICT_OR_COUNTY = '{@#districtOrCounty#}' , 
					CITY = '{@#city#}' , 
					STATE_OR_PROVINCE_CODE = '{@#stateOrProvinceCode#}' , 
					COUNTRY_CODE = '{@#countryCode#}' , 
					POSTAL_CODE = '{@#postalCode#}' 
				WHERE
					ACCOUNT_ID = '{@#accountId#}' AND 
					SHIPMENT_ID = '{@#shipmentId#}' 
				" ;

		
		
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