<?php
class AmazonFeedProcess extends AppModel {
	var $useTable = "sc_election_rule" ;
	
	function process( $reportType,$productItem ,$HeadArray,$accountId ){
		if( !empty( $reportType ) && $reportType == '_GET_FLAT_FILE_OPEN_LISTINGS_DATA_' ){
			$this->_process_GET_FLAT_FILE_OPEN_LISTINGS_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_MERCHANT_LISTINGS_DATA_' ){
			$this->_process_GET_MERCHANT_LISTINGS_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_AFN_INVENTORY_DATA_' ){
			$this->_process_GET_AFN_INVENTORY_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_FLAT_FILE_ORDERS_DATA_' ){
			$this->_process_GET_FLAT_FILE_ORDERS_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_' ){
			$this->_process_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_PADS_PRODUCT_PERFORMANCE_OVER_TIME_DAILY_DATA_TSV_' ){
			$this->_process_GET_PADS_PRODUCT_PERFORMANCE_OVER_TIME_DAILY_DATA_TSV_($reportType, $productItem, $HeadArray, $accountId) ;
		}else if( !empty( $reportType ) && $reportType == '_GET_MERCHANT_LISTINGS_DEFECT_DATA_' ){
			$this->_process_GET_MERCHANT_LISTINGS_DEFECT_DATA_($reportType, $productItem, $HeadArray, $accountId) ;
		}//
	}
	
	function _process_GET_MERCHANT_LISTINGS_DEFECT_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		debug( $productItem ) ;
	}
	
	function _process_GET_PADS_PRODUCT_PERFORMANCE_OVER_TIME_DAILY_DATA_TSV_( $reportType,$productItem ,$HeadArray,$accountId ){
		debug( $productItem ) ;
	}
	
	/**
	 * 保存订单项  
	 * @param unknown_type $reportType
	 * @param unknown_type $productItem
	 * @param unknown_type $HeadArray
	 * @param unknown_type $accountId
	 */
	function _process_GET_FLAT_FILE_ORDERS_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		
		//debug( $productItem ) ;
		
		$NOrderService = ClassRegistry::init("NOrderService") ;
		$log  = ClassRegistry::init("Log") ;
	
		/*
		$asin 		= $productItem['asin'] ;
		$sku  		= $productItem['sku'] ;
		$quantity  	= $productItem['quantity'] ;
		$price  	= $productItem['price'] ;
	
		if(empty($asin)){
			$log->savelog("account_asyn_$accountId" ,json_encode($productItem) ) ;
		}*/
	
		$NOrderService->saveOrderItem( $productItem , true ) ;
	}
	
	function _process_GET_FLAT_FILE_OPEN_LISTINGS_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		$amazonAccount  = ClassRegistry::init("Amazonaccount") ;
		$log  = ClassRegistry::init("Log") ;
		
		
		$asin 		= $productItem['asin'] ;
		$sku  		= $productItem['sku'] ;
		$quantity  	= $productItem['quantity'] ;
		$price  	= $productItem['price'] ;
		
		if(!empty($asin)){
			$log->savelog("account_asyn__process_GET_FLAT_FILE_OPEN_LISTINGS_DATA_$accountId" ,json_encode($productItem) ) ;
		}else{
			return ;
		}
		
		$amazonAccount->saveAccountProductByAsyn(array(
				'ASIN'=>$asin,
				'SKU'=>$sku,
				'accountId'=>$accountId,
				'price'=>$price,
				'quantity'=>$quantity
		),1) ;
	}
	
	function _process_GET_MERCHANT_LISTINGS_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		$amazonAccount  = ClassRegistry::init("Amazonaccount") ;
		$log  = ClassRegistry::init("Log") ;
		
		$asin 		= $productItem['asin1'] ;
		if( empty($asin) ){
			$asin = $productItem['product-id'] ;
		}
		$sku  		= $productItem['seller-sku'] ;
		$listingId  = $productItem['listing-id'] ;
		$quantity  	= $productItem['quantity'] ;
		$price  	= $productItem['price'] ;
		$fulfillment  = $productItem['fulfillment-channel'] ;
		$pendingQuantity  = $productItem['pending-quantity'] ;
		$itemCondition = $productItem['item-condition'] ;
		
		if( trim($fulfillment) == 'DEFAULT' )
			$fulfillment = "Merchant" ;
		
		if(!empty($asin)){
			$log->savelog("account_asyn__process_GET_MERCHANT_LISTINGS_DATA_$accountId" ,json_encode($productItem) ) ;
		}else{
			return ;
		}
		
		$amazonAccount->saveAccountProductByAsyn(array(
				'ASIN'=>$asin,
				'SKU'=>$sku,
				'accountId'=>$accountId,
				'listingId'=>$listingId,
				'price'=>$price,
				'fulfillment'=>$fulfillment,
				'quantity'=>$quantity,
				'pendingQuantity'=>$pendingQuantity,
				'itemCondition'=>$itemCondition
		),2) ;
	}
	
	function _process_GET_AFN_INVENTORY_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		$amazonAccount  = ClassRegistry::init("Amazonaccount") ;
		$log  = ClassRegistry::init("Log") ;
		
		
		$asin 		= $productItem['asin'] ;
		$sku  		= $productItem['seller-sku'] ;
		$fcsku  		= $productItem['fulfillment-channel-sku'] ;
		$quantity  	= $productItem['Quantity Available'] ;
		$sellable 	= $productItem['Warehouse-Condition-code'] ;
		
		$fulfillment = "AMAZON_NA" ;
		
		if( 'SELLABLE' == $sellable ){
			if(!empty($asin)){
				$log->savelog("account_asyn__process_GET_AFN_INVENTORY_DATA_$accountId" ,json_encode($productItem) ) ;
			}
		
			$amazonAccount->saveAccountProductForFBAByAsyn(array(
					'ASIN'=>$asin,
					'SKU'=>$sku,
					'FC_SKU'=>$fcsku,
					'accountId'=>$accountId,
					'FBA_SELLABLE'=>$sellable,
					'fulfillment'=>$fulfillment,
					'quantity'=>$quantity
			),3) ;
		}
	}
	
	function _process_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_( $reportType,$productItem ,$HeadArray,$accountId ){
		debug($reportType) ;
		debug($productItem) ;
		debug($HeadArray) ;
		debug($accountId) ;
	}

}