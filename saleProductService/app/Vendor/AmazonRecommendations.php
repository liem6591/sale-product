<?php
require_once("amazon/MWSRecommendationsSectionService/Client.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsRequest.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsByNextTokenRequest.php");
require_once("amazon/MWSRecommendationsSectionService/Model/ListRecommendationsResult.php");
require_once("amazon/MWSRecommendationsSectionService/Model/Price.php");

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
		/*
		 * 
		 Inventory
		Selection
		Pricing
		Fulfillment
		ListingQuality
		*/
		//$request->setRecommendationCategory("Pricing") ;
		
		
		try {
			$response = $service->ListRecommendations($request);
			if ($response->isSetListRecommendationsResult()) {
				$result = $response->getListRecommendationsResult();
				//print_r($result) ;
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
			
			//print_r($result);
			$this->_doPricingRecommendations($result, $accountId) ;
			$this->_doInventoryRecommendations($result, $accountId) ;
			$this->_doSelectionRecommendations($result, $accountId) ;
			$this->_doFulfillmentRecommendations($result, $accountId) ;
			$this->_doListingQualityRecommendations($result, $accountId) ;
			if ($result->isSetNextToken())
			{
				$nextToken = $result->getNextToken() ;
				echo "<br>************nextToken start*******************<br>" ;
				debug($nextToken );
				$skus_ = $this->listRecommendationsByNextToken($nextToken, $accountId) ;

			}
			return $skus ;
	}
	
	function _doListingQualityRecommendations($result,$accountId){
		$inventorySupplyList = $result->getListingQualityRecommendations();
		echo "<br>listingquality count::".count($inventorySupplyList)."<br>" ;
		foreach ($inventorySupplyList as $member) {
			$item = array() ;

			$item['ACCOUNT_ID'] = $accountId ;
			$itemIdentifier =  $member->getItemIdentifier() ;
			$item['ASIN'] = $itemIdentifier->getAsin() ;
			$item['SKU'] = $itemIdentifier->getSku() ;
			$item['UPC'] = $itemIdentifier->getUpc() ;
			$item['ITEM_NAME'] =$member->getItemName() ;
			
			$item['QUALITY_SET'] = $member->getQualitySet() ;
			$item['DEFECT_GROUP'] = $member->getDefectGroup() ;
			$item['DEFECT_ATTRIBUTE'] = $member->getDefectAttribute() ; 
			
			$item['RECOMMENDATION_ID'] = $member->getRecommendationId()  ;
			$item['RECOMMENDATION_REASON'] = $member->getRecommendationReason()  ;
			
			$this->_doSaveListingQuality($item) ;
		}
	}
	
	function _doFulfillmentRecommendations($result,$accountId){
		$inventorySupplyList = $result->getFulfillmentRecommendations();
		echo "<br>fulfillment count::".count($inventorySupplyList)."<br>" ;
		foreach ($inventorySupplyList as $member) {
			$item = array() ;

			$item['ACCOUNT_ID'] = $accountId ;
			$itemIdentifier =  $member->getItemIdentifier() ;
			$item['ASIN'] = $itemIdentifier->getAsin() ;
			$item['SKU'] = $itemIdentifier->getSku() ;
			$item['UPC'] = $itemIdentifier->getUpc() ;
			$item['LAST_UPDATED'] =  $member->getLastUpdated() ;
			$item['ITEM_NAME'] =$member->getItemName() ;
			
			$item['BRAND_NAME'] = $member->getBrandName() ;
			$item['PRODUCT_CATEGORY'] = $member->getProductCategory() ;
			$item['SALES_RANK'] = $member->getSalesRank() ; 
			$price =  $member->getBuyboxPrice() ;
			if(!empty($price))$item['BUYBOX_PRICE'] =  $price->getAmount() ;
			$item['NUMBER_OF_OFFERS'] = $member->getNumberOfOffers()  ;
			$item['AVERAGE_CUSTOMER_REVIEW'] = $member->getAverageCustomerReview()  ;
			$item['NUMBER_OF_CUSTOMER_REVIEWS'] = $member->getNumberOfCustomerReviews()  ;
			$item['NUMBER_OF_OFFERS_FULFILLED_BY_AMAZON'] = $member->getNumberOfOffersFulfilledByAmazon()  ;
			$item['ITEM_DIMENSIONS'] = $member->getItemDimensions()  ;
			
			$item['RECOMMENDATION_ID'] = $member->getRecommendationId()  ;
			$item['RECOMMENDATION_REASON'] = $member->getRecommendationReason()  ;
			
			$this->_doSaveFulfillment($item) ;
		}
	}
	
	function _doSelectionRecommendations($result,$accountId){

		$inventorySupplyList = $result->getSelectionRecommendations();
		echo "<br>selection count::".count($inventorySupplyList)."<br>" ;
		foreach ($inventorySupplyList as $member) {
			$item = array() ;

			$item['ACCOUNT_ID'] = $accountId ;
			$itemIdentifier =  $member->getItemIdentifier() ;
			$item['ASIN'] = $itemIdentifier->getAsin() ;
			$item['SKU'] = $itemIdentifier->getSku() ;
			$item['UPC'] = $itemIdentifier->getUpc() ;
			$item['LAST_UPDATED'] =  $member->getLastUpdated() ;
			$item['ITEM_NAME'] =$member->getItemName() ;
			
			$item['BRAND_NAME'] = $member->getBrandName() ;
			$item['PRODUCT_CATEGORY'] = $member->getProductCategory() ;
			$item['SALES_RANK'] = $member->getSalesRank() ; 
			$price =  $member->getBuyboxPrice() ;
			if(!empty($price))$item['BUYBOX_PRICE'] =  $price->getAmount() ;
			$item['NUMBER_OF_OFFERS'] = $member->getNumberOfOffers()  ;
			$item['AVERAGE_CUSTOMER_REVIEW'] = $member->getAverageCustomerReview()  ;
			$item['NUMBER_OF_CUSTOMER_REVIEWS'] = $member->getNumberOfCustomerReviews()  ;
			
			$item['RECOMMENDATION_ID'] = $member->getRecommendationId()  ;
			$item['RECOMMENDATION_REASON'] = $member->getRecommendationReason()  ;
			
			$this->_doSaveSelection($item) ;
		}
	}
	
	function _doPricingRecommendations($result,$accountId){
		$inventorySupplyList = $result->getPricingRecommendations();
		$index=0 ;
		echo "<br>pricing count::".count($inventorySupplyList)."<br>" ;
		foreach ($inventorySupplyList as $member) {
			$item = array() ;
			$item['ACCOUNT_ID'] = $accountId ;
			$itemIdentifier =  $member->getItemIdentifier() ;
			$item['ASIN'] = $itemIdentifier->getAsin() ;
			$item['SKU'] = $itemIdentifier->getSku() ;
			$item['UPC'] = $itemIdentifier->getUpc() ;
			$item['LAST_UPDATED'] =  $member->getLastUpdated() ;
			$item['ITEM_NAME'] =$member->getItemName() ;
			$item['FULFILLMENT_CHANNEL'] = $member->getFulfillmentChannel() ;
			$price =  $member->getYourPricePlusShipping() ;
			if(!empty($price))$item['YOUR_PRICE_PLUS_SHIPPING'] = $price->getAmount() ;
			
			$price =  $member->getYourPricePlusShipping() ;
			if(!empty($price))$item['LOWEST_PRICE_PLUS_SHIPPING'] = $price->getAmount() ; 

			$price =  $member->getPriceDifferenceToLowPrice() ;
			if(!empty($price))$item['PRICE_DIFFERENCE_TO_LOW_PRICE'] = $price->getAmount()  ;

			$price =  $member->getMedianPricePlusShipping() ;
			if(!empty($price))$item['MEDIAN_PRICE_PLUS_SHIPPING'] = $price->getAmount()  ;

			$price =  $member->getLowestMerchantFulfilledOfferPrice() ;
			if(!empty($price))$item['LOWEST_MERCHANT_FULFILLED_OFFER_PRICE'] = $price->getAmount()  ;

			$price =  $member->getLowestAmazonFulfilledOfferPrice() ;
			if(!empty($price))$item['LOWEST_AMAZON_FULFILLED_OFFER_PRICE'] = $price->getAmount()  ;
			$item['NUMBER_OF_OFFERS'] = $member->getNumberOfOffers()  ;
			$item['NUMBER_OF_MERCHANT_FULFILLED_OFFERS'] = $member->getNumberOfMerchantFulfilledOffers()  ;
			$item['NUMBER_OF_AMAZON_FULFILLED_OFFERS'] = $member->getNumberOfAmazonFulfilledOffers()  ;
			$item['RECOMMENDATION_ID'] = $member->getRecommendationId()  ;
			$item['RECOMMENDATION_REASON'] = $member->getRecommendationReason()  ;
			//debug($item) ;
			$this->_doSavePricing($item) ;
		}
	}
	
	function _doInventoryRecommendations($result,$accountId){
		$inventorySupplyList = $result->getInventoryRecommendations();
		echo "<br>inventory count::".count($inventorySupplyList)."<br>" ;
		foreach ($inventorySupplyList as $member) {
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
			//debug($item) ;
			$this->_doSaveInventory($item) ;
		}
	}
	
	function _doDelete($detail){
		$utils  = ClassRegistry::init("Utils") ;
		$deleteSql=" delete from sc_amazon_recommendations where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils->exeSql($deleteSql,$detail) ;
		$deleteSql=" delete from sc_amazon_recommendations_fulfillment where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils->exeSql($deleteSql,$detail) ;
		$deleteSql=" delete from sc_amazon_recommendations_listing_quality where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils->exeSql($deleteSql,$detail) ;
		$deleteSql=" delete from sc_amazon_recommendations_pricing where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils->exeSql($deleteSql,$detail) ;
		$deleteSql=" delete from sc_amazon_recommendations_selection where ACCOUNT_ID = '{@#accountId#}'  " ;
		$utils->exeSql($deleteSql,$detail) ;
		
		/*sc_amazon_recommendations_fulfillment
sc_amazon_recommendations_listing_quality
sc_amazon_recommendations_pricing
sc_amazon_recommendations_selection*/
	}
	
	function _doSaveSelection($item){
		$utils  = ClassRegistry::init("Utils") ;
		$insertSql="INSERT INTO sc_amazon_recommendations_selection 
			(ACCOUNT_ID, 
			ASIN, 
			SKU, 
			UPC,
			LAST_UPDATED, 
			ITEM_NAME, 
			BRAND_NAME, 
			PRODUCT_CATEGORY, 
			SALES_RANK, 
			BUYBOX_PRICE, 
			NUMBER_OF_OFFERS, 
			AVERAGE_CUSTOMER_REVIEW, 
			NUMBER_OF_CUSTOMER_REVIEWS, 
			RECOMMENDATION_ID, 
			RECOMMENDATION_REASON
			)
			VALUES
			('{@#ACCOUNT_ID#}', 
			'{@#ASIN#}', 
			'{@#SKU#}', 
			'{@#UPC#}', 
			'{@#LAST_UPDATED#}', 
			'{@#ITEM_NAME#}', 
			'{@#BRAND_NAME#}', 
			'{@#PRODUCT_CATEGORY#}', 
			'{@#SALES_RANK#}', 
			'{@#BUYBOX_PRICE#}', 
			'{@#NUMBER_OF_OFFERS#}', 
			'{@#AVERAGE_CUSTOMER_REVIEW#}', 
			'{@#NUMBER_OF_CUSTOMER_REVIEWS#}', 
			'{@#RECOMMENDATION_ID#}', 
			'{@#RECOMMENDATION_REASON#}'
			)" ;
	
		$utils->exeSql($insertSql,$item) ;
	}
	
	function _doSaveListingQuality($item){
		$utils  = ClassRegistry::init("Utils") ;
		$insertSql=" INSERT INTO sc_amazon_recommendations_listing_quality 
				(ACCOUNT_ID, 
				ASIN, 
				SKU, 
					UPC, 
				QUALITY_SET, 
				DEFECT_GROUP, 
				DEFECT_ATTRIBUTE, 
				ITEM_NAME, 
				RECOMMENDATION_ID, 
				RECOMMENDATION_REASON
				)
				VALUES
				('{@#ACCOUNT_ID#}', 
				'{@#ASIN#}', 
				'{@#SKU#}', 
			'{@#UPC#}', 
				'{@#QUALITY_SET#}', 
				'{@#DEFECT_GROUP#}', 
				'{@#DEFECT_ATTRIBUTE#}', 
				'{@#ITEM_NAME#}', 
				'{@#RECOMMENDATION_ID#}', 
				'{@#RECOMMENDATION_REASON#}'
				)" ;
				
		$utils->exeSql($insertSql,$item) ;
	}
	
	function _doSaveFulfillment($item){
		$utils  = ClassRegistry::init("Utils") ;
		$insertSql=" 
INSERT INTO sc_amazon_recommendations_fulfillment 
	(ACCOUNT_ID, 
	ASIN, 
	SKU, 
					UPC, 
	LAST_UPDATED, 
	ITEM_NAME, 
	BRAND_NAME, 
	PRODUCT_CATEGORY, 
	SALES_RANK, 
	BUYBOX_PRICE, 
	NUMBER_OF_OFFERS, 
	NUMBER_OF_OFFERS_FULFILLED_BY_AMAZON, 
	AVERAGE_CUSTOMER_REVIEW, 
	NUMBER_OF_CUSTOMER_REVIEWS, 
	ITEM_DIMENSIONS, 
	RECOMMENDATION_ID, 
	RECOMMENDATION_REASON
	)
	VALUES
	('{@#ACCOUNT_ID#}', 
	'{@#ASIN#}', 
	'{@#SKU#}', 
			'{@#UPC#}', 
	'{@#LAST_UPDATED#}', 
	'{@#ITEM_NAME#}', 
	'{@#BRAND_NAME#}', 
	'{@#PRODUCT_CATEGORY#}', 
	'{@#SALES_RANK#}', 
	'{@#BUYBOX_PRICE#}', 
	'{@#NUMBER_OF_OFFERS#}', 
	'{@#NUMBER_OF_OFFERS_FULFILLED_BY_AMAZON#}', 
	'{@#AVERAGE_CUSTOMER_REVIEW#}', 
	'{@#NUMBER_OF_CUSTOMER_REVIEWS#}', 
	'{@#ITEM_DIMENSIONS#}', 
	'{@#RECOMMENDATION_ID#}', 
	'{@#RECOMMENDATION_REASON#}'
	)" ;
	
		$utils->exeSql($insertSql,$item) ;
	}
	
	function _doSavePricing($item){
		$utils  = ClassRegistry::init("Utils") ;
		$insertSql=" INSERT INTO sc_amazon_recommendations_pricing 
					(ACCOUNT_ID, 
					ASIN, 
					SKU, 
					UPC, 
					LAST_UPDATED, 
					ITEM_NAME, 
					FULFILLMENT_CHANNEL, 
					YOUR_PRICE_PLUS_SHIPPING, 
					LOWEST_PRICE_PLUS_SHIPPING, 
					PRICE_DIFFERENCE_TO_LOW_PRICE, 
					MEDIAN_PRICE_PLUS_SHIPPING, 
					LOWEST_MERCHANT_FULFILLED_OFFER_PRICE, 
					LOWEST_AMAZON_FULFILLED_OFFER_PRICE, 
					NUMBER_OF_OFFERS, 
					NUMBER_OF_MERCHANT_FULFILLED_OFFERS, 
					NUMBER_OF_AMAZON_FULFILLED_OFFERS, 
					RECOMMENDATION_ID, 
					RECOMMENDATION_REASON
					)
					VALUES
					('{@#ACCOUNT_ID#}', 
					'{@#ASIN#}', 
					'{@#SKU#}', 
					'{@#UPC#}', 
					'{@#LAST_UPDATED#}', 
					'{@#ITEM_NAME#}', 
					'{@#FULFILLMENT_CHANNEL#}', 
					'{@#YOUR_PRICE_PLUS_SHIPPING#}', 
					'{@#LOWEST_PRICE_PLUS_SHIPPING#}', 
					'{@#PRICE_DIFFERENCE_TO_LOW_PRICE#}', 
					'{@#MEDIAN_PRICE_PLUS_SHIPPING#}', 
					'{@#LOWEST_MERCHANT_FULFILLED_OFFER_PRICE#}', 
					'{@#LOWEST_AMAZON_FULFILLED_OFFER_PRICE#}', 
					'{@#NUMBER_OF_OFFERS#}', 
					'{@#NUMBER_OF_MERCHANT_FULFILLED_OFFERS#}', 
					'{@#NUMBER_OF_AMAZON_FULFILLED_OFFERS#}', 
					'{@#RECOMMENDATION_ID#}', 
					'{@#RECOMMENDATION_REASON#}'
					)" ;
	
		$utils->exeSql($insertSql,$item) ;
	}

	function _doSaveInventory ($item){
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