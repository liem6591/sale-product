<?php   
App :: import('Vendor', 'Ebay');

class EBayController extends AppController   
{   
	public $helpers = array('Html', 'Form');//,'Ajax','Javascript
	var $uses = array('Amazonaccount','Warning','Log','OrderService','EbayModel');
	/**
	 * 固定价格产品操作：
	 * AddFixedPriceItem 用于添加固定价格的产品到ebay，类似于淘宝一口价
	 * ReviseFixedPriceItem 用于更新固定价格产品的属性，如title，price，库存等，适用于multi-variation产品
	 * ReviseInventoryStatus， 只能改变固定价格产品的price和库存
	 * EndFixedPriceItem  清除产品
	 */
	function doFixedPriceItem(){
	}
	
	/**
	 * 获取分类特征
	 * @param unknown $accountId
	 * @param unknown $categoryId
	 * @return CakeResponse
	 */
	function getCategoryFeathers( $accountId , $categoryId  ){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
		
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		$ebay = new Ebay( $ebayParams ) ;
		$result = $ebay->getCategoryFeathers( $categoryId ) ;//"117031"

		ob_clean() ;
		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
		
		return $this->response ;
	}
	
	/**
	 * 可变价格产品
	 * AddItem 用于添加可变价格产品，类似于淘宝上的拍卖价
	 * ReviseItem 更新可变价格产品的属性，如title，price，库存等
	 * EndItem 
	 */
	function doItem($accountId,$listingType){
		
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		$reqMap = $this->requestMap() ;
		$xml = (string)$reqMap['xml'] ;
		
		$ebay = new Ebay( $ebayParams ) ;
		$res = $ebay->doItem($xml,$listingType) ;
		//echo $res;
		$res = $this->parseResopnse($res,$listingType) ;
		
		ob_clean() ;
		
		
		$this->response->type("text") ;
		$this->response->body( json_encode($res) )   ;
		//$this->response->body( $isSuccess?"true":"false" )   ;
		
		return $this->response ;
	}
	
	/**
	 * 获取分类规格
	 * @param unknown $accountId
	 * @param unknown $categoryId
	 * @return CakeResponse
	 */
	public function getCategorySpecials($accountId , $categoryId){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
		
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;

		ob_clean() ;
		$ebay = new Ebay( $ebayParams ) ;
		$result = $ebay->getCategorySpecials( $categoryId ) ;//"117031"
		
		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
		
		return $this->response ;
	}
	
	//获取订单信息
	
	public function getOrders($accountId){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
		
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		//ob_clean() ;
		$ebay = new Ebay( $ebayParams ) ;
		$result = $ebay->getOrders(  ) ;//"117031"

		$this->EbayModel->saveOrders($result) ;

		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
		
		return $this->response ;
	}
	
	public function getFeedBack($accountId){ 
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
	
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
	
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
	
		//ob_clean() ;
		$ebay = new Ebay( $ebayParams ) ;
		$result = $ebay->getFeedback() ;//"117031"
		echo $result ;
	
		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
	
		return $this->response ;
	}
	
	public function getMyMessagesHeader($accountId){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
	
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
	
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
	
		ob_clean() ;
		
		//debug($ebayParams)  ;
		
		$ebay = new Ebay( $ebayParams ) ;
		
		$result = $ebay->getMyMessagesHeader($accountId) ;//"117031"
		
		echo $result ;
		
		$this->EbayModel->saveMessages($result,$accountId) ;
	
		$this->response->type("json") ;
		$this->response->body("")   ;
	
		return $this->response ;
	}
	
	public function getMyMessagesText($accountId){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;
	
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
	
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		
		ob_clean() ;
		$ebay = new Ebay( $ebayParams ) ;
		
		$messagIds = $this->EbayModel->getMessageIdsNoText($accountId) ;
		if( !empty($messagIds) ){
			$result = $ebay->getMyMessagesText( $messagIds ) ;//"117031"
			$this->EbayModel->saveMessagesForText($result,$accountId) ;
			$this->response->type("json") ;
			$this->response->body("") ;//($jsoncallback.'('.json_encode($result).')' )   ;
		}else{
			$this->response->type("json") ;
			$this->response->body($jsoncallback.'()' )   ;
		}
	
		return $this->response ;
	}
	
	/**
	 * 标记消息状态
	 * 
	 * @param unknown $accountId
	 * @return CakeResponse
	 */
	public function reviseMyMessages($accountId){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;

		//标记指定账号消息状态
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		$ebay = new Ebay( $ebayParams ) ;
		
		//获取可读和可标记的记录
		$messageIds = $this->EbayModel->getMessagesNoReadAndNoFlagged($accountId) ;
		$tempIds = array() ;
		foreach($messageIds as $m){
			$tempIds[] = $m['MessageID'] ;
		}
		if( count($tempIds) >0 ){
			$result = $ebay->reviseMyMessages( $tempIds,true,true ) ;
			$result = $ebay->getMyMessagesHeaderByMessageIds($tempIds) ;
			$this->EbayModel->saveMessages($result,$accountId) ;
		}
		
		//获取可读的记录
		$messageIds = $this->EbayModel->getMessagesNoRead($accountId) ;
		$tempIds = array() ;
		foreach($messageIds as $m){
			$tempIds[] = $m['MessageID'] ;
		}
		if( count($tempIds) >0 ){
			$result = $ebay->reviseMyMessages( $tempIds,true ) ; 
			$result = $ebay->getMyMessagesHeaderByMessageIds($tempIds) ;
			$this->EbayModel->saveMessages($result,$accountId) ;
		}		
		
		//获取可标记的记录
		$messageIds = $this->EbayModel->getMessagesNoFlagged($accountId) ;
		$tempIds = array() ;
		foreach($messageIds as $m){
			$tempIds[] = $m['MessageID'] ;
		}
		if( count($tempIds) >0 ){
			$result = $ebay->reviseMyMessages( $tempIds,null,true ) ;
			$result = $ebay->getMyMessagesHeaderByMessageIds($tempIds) ;
			$this->EbayModel->saveMessages($result,$accountId) ;
		}		
		
		$this->EbayModel->saveMessages($result,$accountId) ;
		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
		
		return $this->response ;
	}
	
	public function responseMessages($accountId=null){
		$reqMap = $this->requestMap() ;
		$jsoncallback = $reqMap['jsonpcallback'] ;

		//标记指定账号消息状态
		$account = $this->Amazonaccount->getAccount($accountId) ;
		$account = $account[0]['sc_amazon_account'] ;
		
		$ebayParams = array(
				'appMode'=>$account['EBAY_APP_MODE'],
				'siteId'=>$account['EBAY_SITE_ID'],
				'devId'=>$account['EBAY_DEV_ID'],
				'appId'=>$account['EBAY_APP_ID'],
				'certId'=>$account['EBAY_CERT_ID'],
				'token'=>$account['EBAY_TOKEN']
		) ;
		
		$ebay = new Ebay( $ebayParams ) ;
		
		//获取可读和可标记的记录
		$NoResponseMessages = $this->EbayModel->getMessagesNoResponse($accountId) ;
		
		$tempIds = array() ;
		
		foreach($NoResponseMessages as $nrm){
			
			$tempIds[] = $nrm['MessageID'] ;
			//ItemID   Body   RecipientID   Subject
			$temp = array() ;
			$temp['ItemID'] = $nrm['ItemID'] ;
			$temp['Subject'] = $nrm['LCOAL_Subject'] ;
			$temp['Body'] = $nrm['LOCAL_RESPONSE_BODY'] ;
			$temp['RecipientID'] = $nrm['Sender'] ;
			$temp['MessageID'] = $nrm['MessageID'] ;
			$ebay->responseMessage($temp) ;
		}
		
		if( count($tempIds) >0 ){
			$result = $ebay->getMyMessagesHeaderByMessageIds($tempIds) ;
			$this->EbayModel->saveMessages($result,$accountId) ;
		}
		
		$this->response->type("json") ;
		$this->response->body($jsoncallback.'('.json_encode($result).')' )   ;
		
		return $this->response ;
	}

	/*
	 *
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
 <soapenv:Body>
  <AddFixedPriceItemResponse xmlns="urn:ebay:apis:eBLBaseComponents">
   <Timestamp>2013-07-29T13:13:46.888Z</Timestamp>
   <Ack>Failure</Ack>
   <Errors>
    <ShortMessage>Listing violates the Duplicate Listing policy.</ShortMessage>
    <LongMessage>This Listing is a duplicate of your item: 66666666666622222222222 (110120484396). Under the Duplicate Listing policy, sellers can茂驴陆t have multiple Fixed Price listings, multiple Auction-style (with the Buy It Now option) listings, or in both the Fixed Price and Auction-style (with the Buy It Now option) listings for identical items at the same time. We recommend you create a multiple quantity Fixed Price listing to sell identical items.</LongMessage>
    <ErrorCode>21919067</ErrorCode>
    <SeverityCode>Error</SeverityCode>
    <ErrorParameters ParamID="0">
     <Value>66666666666622222222222</Value>
    </ErrorParameters>
    <ErrorParameters ParamID="1">
     <Value>110120484396</Value>
    </ErrorParameters>
    <ErrorClassification>RequestError</ErrorClassification>
   </Errors>
   <Version>833</Version>
   <Build>E833_UNI_API5_16226159_R1</Build>
  </AddFixedPriceItemResponse>
 </soapenv:Body>
</soapenv:Envelope>
*/
	
	function parseResopnse($res,$listingType){
		//echo 
		$pos = strrpos($res, "<Ack>Success</Ack>");
		if ($pos === false) { // note: three equal signs
			$res = str_replace("soapenv:Envelope", "soapenvEnvelope", $res) ;
			$res = str_replace("soapenv:Body", "soapenvBody", $res) ;
			
			$xml = new  SimpleXMLElement($res);
			
				$error = (string)$xml->soapenvBody ->AddFixedPriceItemResponse ->Errors->LongMessage ;
				if( empty($error) ){
					$error = (string)$xml->soapenvBody ->AddItemResponse ->Errors->LongMessage ;
				}
			
			
		    return array( "isSuccess"=>"false" , "message"=> $error ) ;
		}
		return array( "isSuccess"=>"true" , "message"=> "" ) ;
	}
} 