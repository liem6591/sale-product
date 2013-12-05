<?php
require_once("amazon/MWSRecommendationsSectionService/Client.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsRequest.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsByNextTokenRequest.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsResult.php");

require_once("amazon/FBAInventoryServiceMWS/Exception.php");

class AmazonRecommendations {
	var $AWS_ACCESS_KEY_ID ; 
	var $AWS_SECRET_ACCESS_KEY ;
	var $APPLICATION_NAME;
	var $APPLICATION_VERSION;
	var $MERCHANT_ID ;
	var $MARKETPLACE_ID ;
	var $MerchantIdentifier ;
	var $APPLICATION_ID ;
	
	public function AmazonRecommendations( 
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
	
	function listRecommendations($accountId){
		$skus = array() ;
		
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;

		$config = array (
				'ServiceURL' =>  $platform['AMAZON_RECOMMENDATIONS_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new MWSRecommendationsSectionService_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		
		$request = new MWSRecommendationsSectionService_Model_ListRecommendationsRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setMarketplaceId( $this->MARKETPLACE_ID );
		
		
		try {
			$response = $service->ListRecommendations($request);
			if ($response->isSetListRecommendationsResult()) {
				$result = $response->getListRecommendationsResult();
				//删除所有的推荐
				$this->_doDelete(array('accountId'=>$accountId)) ;
				$skus = $this->_doListRecommendationsResponse($result,$accountId  ) ;
			}
			/*echo ("Service Response\n");
			echo ("=============================================================================\n");
		
			$dom = new DOMDocument();
			$dom->loadXML($response->toXML());
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			debug( $dom->saveXML() );
			echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");*/
		
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
	
	function listRecommendationsByNextToken($nextToken,$accountId){
		$platform = $this->getAccountPlatform($accountId) ;
		$System = ClassRegistry::init("System") ;
		
		$config = array (
				'ServiceURL' =>  $platform['AMAZON_RECOMMENDATIONS_URL'],// "https://mws.amazonservices.com",
				'ProxyHost' => null,
				'ProxyPort' => -1,
				'MaxErrorRetry' => 3
		);
		
		$service = new MWSRecommendationsSectionService_Client(
				$this->AWS_ACCESS_KEY_ID,
				$this->AWS_SECRET_ACCESS_KEY,
				$this->APPLICATION_NAME,
				$this->APPLICATION_VERSION,
				$config);
		
		$request = new MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenRequest() ;
		//$request = new FBAInventoryServiceMWS_Model_ListInventorySupplyByNextTokenRequest();
		$request->setSellerId( $this->MERCHANT_ID );
		$request->setNextToken( $nextToken ) ;
		
		$skus = array();
		try {
			
			$response = $service->ListRecommendationsByNextToken($request);
			if ($response->isSetListRecommendationsByNextTokenResult()) {
				$result = $response->getListRecommendationsByNextTokenResult();
				
				$skus = $this->_doListRecommendationsResponse($result,$accountId  ) ;
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

	
	function _doListRecommendationsResponse($result,$accountId ){
				$skus = array();
				$inventorySupplyList = $result->getInventoryRecommendations();
				//debug($inventorySupplyList) ;
				
				//$memberList = $inventorySupplyList->getmember();
				foreach ($inventorySupplyList as $member) {
					/*
					 *  'LastUpdated' => array('FieldValue' => null, 'FieldType' => 'string'),
            'ItemIdentifier' => array('FieldValue' => null, 'FieldType' => 'MWSRecommendationsSectionService_Model_ProductIdentifier'),
            'ItemName' => array('FieldValue' => null, 'FieldType' => 'string'),
            'FulfillmentChannel' => array('FieldValue' => null, 'FieldType' => 'string'),
            'SalesForTheLast14Days' => array('FieldValue' => null, 'FieldType' => 'int'),
            'SalesForTheLast30Days' => array('FieldValue' => null, 'FieldType' => 'int'),
            'AvailableQuantity' => array('FieldValue' => null, 'FieldType' => 'int'),
            'DaysUntilStockRunsOut' => array('FieldValue' => null, 'FieldType' => 'int'),
            'InboundQuantity' => array('FieldValue' => null, 'FieldType' => 'int'),
            'RecommendedInboundQuantity' => array('FieldValue' => null, 'FieldType' => 'int'),
            'DaysOutOfStockLast30Days' => array('FieldValue' => null, 'FieldType' => 'int'),
            'LostSalesInLast30Days' => array('FieldValue' => null, 'FieldType' => 'int'),
            'RecommendationId' => array('FieldValue' => null, 'FieldType' => 'string'),
            'RecommendationReason' => array('FieldValue' => null, 'FieldType' => 'string'),
             'Asin' => array('FieldValue' => null, 'FieldType' => 'string'),
            'Sku' => array('FieldValue' => null, 'FieldType' => 'string'),
            'Upc' => array('FieldValue' => null, 'FieldType' => 'string'),
            */
					$item = array() ;
					$item['accountId'] = $accountId ;
					$item['lastUpdated'] = $member->getLastUpdated() ;
					$itemIdentifier =  $member->getItemIdentifier() ;
					$item['asin'] = $itemIdentifier->getAsin() ;
					$item['sku'] = $itemIdentifier->getSku() ;
					$item['upc'] = $itemIdentifier->getUpc() ;
					$item['itemName'] = $member->getItemName() ;
					$item['fulfillmentChannel'] = $member->getFulfillmentChannel() ;
					$item['salesForTheLast14Days'] = $member->getSalesForTheLast14Days() ;
					$item['salesForTheLast30Days'] = $member->getSalesForTheLast30Days() ;
					$item['availableQuantity'] = $member->getAvailableQuantity() ;
					$item['daysUntilStockRunsOut'] = $member->getDaysUntilStockRunsOut() ;
					$item['inboundQuantity'] = $member->getInboundQuantity() ;
					$item['recommendedInboundQuantity'] = $member->getRecommendedInboundQuantity() ;
					$item['daysOutOfStockLast30Days'] = $member->getDaysOutOfStockLast30Days() ;
					$item['lostSalesInLast30Days'] = $member->getLostSalesInLast30Days() ;
					$item['recommendationId'] = $member->getRecommendationId() ;
					$item['recommendationReason'] = $member->getRecommendationReason() ;
					debug($item) ;
					$this->_doSave($item) ;
				}
	
			if ($result->isSetNextToken())
			{
				$nextToken = $result->getNextToken() ;
				$skus_ = $this->listRecommendationsByNextToken($nextToken, $accountId) ;
			}
			return $skus ;
	}
	
	function _doDelete($detail){
		$deleteSql=" delete from sc_amazon_recommendations where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils  = ClassRegistry::init("Utils") ;
		$utils->exeSql($deleteSql,$detail) ;
	}

	function _doSave($item){
		$utils  = ClassRegistry::init("Utils") ;
		$insertSql=" INSERT INTO  sc_amazon_recommendations 
					(ACCOUNT_ID, 
					ASIN, 
					SKU, 
					UPC, 
					LAST_UPDATED, 
					ITEM_NAME, 
					FULFILLMENT_CHANNEL, 
					SALES_FOR_THELAST14DAYS, 
					SALES_FOR_THELAST30DAYS, 
					AVAILABLE_QUANTITY, 
					DAYS_UNTIL_STOCK_RUNSOUT, 
					INBOUND_QUANTITY, 
					RECOMMENDED_INBOUND_QUANTITY, 
					DAYS_OUTOFSTOCK_LAST30DAYS, 
					LOST_SALES_IN_LAST30DAYS, 
					RECOMMENDATION_ID, 
					RECOMMENDATION_REASON
					)
					VALUES
					('{@#accountId#}', 
					'{@#asin#}', 
					'{@#sku#}', 
					'{@#upc#}', 
					'{@#lastUpdated#}', 
					'{@#itemName#}', 
					'{@#fulfillmentChannel#}', 
					'{@#salesForTheLast14Days#}', 
					'{@#salesForTheLast30Days#}', 
					'{@#availableQuantity#}', 
					'{@#daysUntilStockRunsOut#}', 
					'{@#inboundQuantity#}', 
					'{@#recommendedInboundQuantity#}', 
					'{@#daysOutOfStockLast30Days#}', 
					'{@#lostSalesInLast30Days#}', 
					'{@#recommendationId#}', 
					'{@#recommendationReason#}'
					)" ;
		
		$utils->exeSql($insertSql,$item) ;
	}
}
?>