<?php   
App :: import('Vendor', 'Ebay');

class EBayController extends AppController   
{   
	public $helpers = array('Html', 'Form');//,'Ajax','Javascript
	var $uses = array('Amazonaccount','Warning','Log','OrderService');
	/**
	 * 固定价格产品操作：
	 * AddFixedPriceItem 用于添加固定价格的产品到ebay，类似于淘宝一口价
	 * ReviseFixedPriceItem 用于更新固定价格产品的属性，如title，price，库存等，适用于multi-variation产品
	 * ReviseInventoryStatus， 只能改变固定价格产品的price和库存
	 * EndFixedPriceItem  清除产品
	 */
	function doFixedPriceItem(){
		
	}
	
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
		
		$res = $this->parseResopnse($res) ;
		
		
		$this->response->type("text") ;
		$this->response->body( json_encode($res) )   ;
		//$this->response->body( $isSuccess?"true":"false" )   ;
		
		return $this->response ;
	}
	
	/*
	 * <?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
 <soapenv:Body>
  <AddFixedPriceItemResponse xmlns="urn:ebay:apis:eBLBaseComponents">
   <Timestamp>2013-07-29T13:08:25.990Z</Timestamp>
   <Ack>Success</Ack>
   <Version>833</Version>
   <Build>E833_UNI_API5_16246498_R1</Build>
   <ItemID>110120484396</ItemID>
   <StartTime>2013-07-29T13:08:25.583Z</StartTime>
   <EndTime>2013-08-01T13:08:25.583Z</EndTime>
   <Fees>
    <Fee>
  </AddFixedPriceItemResponse>
 </soapenv:Body>
</soapenv:Envelope>

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
	function parseResopnse($res){
		//echo 
		$pos = strrpos($res, "<Ack>Success</Ack>");
		if ($pos === false) { // note: three equal signs
			$res = str_replace("soapenv:Envelope", "soapenvEnvelope", $res) ;
			$res = str_replace("soapenv:Body", "soapenvBody", $res) ;
			
			$xml = new  SimpleXMLElement($res);
			
			$error = (string)$xml->soapenvBody ->AddFixedPriceItemResponse ->Errors->LongMessage ;
			
			
		    return array( "isSuccess"=>"false" , "message"=> $error ) ;
		}
		return array( "isSuccess"=>"true" , "message"=> "" ) ;
	}
} 