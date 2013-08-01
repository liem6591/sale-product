<?php
	
require_once 'ebay/EbatNs/EbatNs_ServiceProxy.php';
require_once 'ebay/EbatNs/EbatNs_Logger.php';
require_once 'ebay/EbatNs/VerifyAddItemRequestType.php';
require_once 'ebay/EbatNs/AddItemRequestType.php';
require_once 'ebay/EbatNs/AddFixedPriceItemRequestType.php';
require_once 'ebay/EbatNs/ItemType.php';
require_once 'ebay/EbatNs/ShippingDetailsType.php';
require_once 'ebay/EbatNs/ReturnPolicyDetailsType.php';
require_once 'ebay/EbatNs/RefundDetailsType.php';
require_once 'ebay/EbatNs/ReturnsAcceptedDetailsType.php';


require_once 'ebay/EbatNs/GetCategorySpecificsRequestType.php';
require_once 'ebay/EbatNs/GetCategoryFeaturesRequestType.php';
require_once 'ebay/EbatNs/DetailLevelCodeType.php';
require_once 'ebay/EbatNs/AbstractRequestType.php';
require_once 'ebay/EbatNs/GetCategoryFeaturesResponseType.php';

class Ebay {
	var $session ;
	var $cs ;
	
	public function Ebay( $array ){
		$this->session  = new EbatNs_Session();
		$user = 'hideout12';
		$this->session->setRequestUser("testebay001");
		$this->session->setRequestPassword("Tebay@2011");
		$this->session ->setSiteId( $array['siteId'] );
		$this->session ->setDevId( $array['devId'] );
		$this->session ->setAppId( $array['appId'] );
		$this->session ->setCertId( $array['certId'] );
		
		$this->session ->setAppMode($array['appMode']);
		
		$this->session ->setTokenMode(true);
		//$session->setTokenPickupFile("test.token");
		//$session->setTokenUsePickupFile(true);
		$this->session ->setRequestToken( $array['token'] );
		
		$this->cs = new EbatNs_ServiceProxy( $this->session );
		//$this->cs->attachLogger(new EbatNs_Logger());
	}
	
	public function getCategoryFeathers( $categoryId){
		
		$req = new GetCategoryFeaturesRequestType();
		//$req->categoryID = $categoryId;
		
		$req->setCategoryID($categoryId ) ;
		$req->addDetailLevel( DetailLevelCodeType::CodeType_ReturnAll );
	
		//$req->addFeatureID("ConditionEnabled") ;//condition
		//$req->addFeatureID("ConditionValues") ;//condition
		
		$req->setOutputSelector( array(
			"Category.ConditionEnabled",
			"Category.ConditionValues.Condition.ID",
			"Category.ConditionValues.Condition.DisplayName" ));
	//	$req->setLevelLimit(10);
		
		$res = $this->cs->GetCategoryFeatures($req);
		
		$res = str_replace("soapenv:Envelope", "soapenvEnvelope", $res) ;
		$res = str_replace("soapenv:Body", "soapenvBody", $res) ;
		
		$xml = new  SimpleXMLElement($res);
		
		$category = $xml->soapenvBody ->GetCategoryFeaturesResponse ->Category ;
		
		$conditionEnabled = (string)$category->ConditionEnabled  ;
		
		
		
		if( $conditionEnabled == "Required" ){
			$conditions = $category->ConditionValues->Condition   ;
			$cons = array() ;
			foreach($conditions as $condition){
				$id = (string)$condition->ID ;
				$name = (string)$condition->DisplayName ;
				$cons[] = array("id"=>$id,"name"=>$name) ;
			}
			return $cons ;
		}else{
			return null ;
		}
	}
	
	/**
	 * 添加产品到Ebay
	 * 
	 * @param unknown_type $product_data
	 */
	public function addItem( $ItemXml ){
		$req = new AddItemRequestType();
		$req->Item =  new ItemType();
		$res = $this->cs->AddItemBody($req,$ItemXml);
		
		return $res ;
	}
	
	public function addFixedPriceItem( $ItemXml ){

		$req = new AddFixedPriceItemRequestType();
		$req->Item =  new ItemType();
		$res = $this->cs->AddFixedPriceItemBody($req,$ItemXml);
	
		return $res ;
	}
	
	/**
	 * <GeteBayDetailsRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <!-- Call-specific Input Fields -->
  <DetailName> DetailNameCodeType </DetailName>
  <!-- ... more DetailName values allowed here ... -->
  <!-- Standard Input Fields -->
  <ErrorLanguage> string </ErrorLanguage>
  <MessageID> string </MessageID>
  <Version> string </Version>
  <WarningLevel> WarningLevelCodeType </WarningLevel>
</GeteBayDetailsRequest>
	 */
	public function getCategorySpecials($categoryId){
		$req = new GetCategorySpecificsRequestType();
		
		$req->setCategoryID($categoryId ) ;
		
		$res = $this->cs->GetCategorySpecifics($req);
		
		$res = str_replace("soapenv:Envelope", "soapenvEnvelope", $res) ;
		$res = str_replace("soapenv:Body", "soapenvBody", $res) ;
	
		$xml = new  SimpleXMLElement($res);
		
		$recommendations = $xml->soapenvBody ->GetCategorySpecificsResponse ->Recommendations   ;
		
		return $recommendations ;
	}
	
	/**
	 * 添加产品到Ebay
	 *
	 * @param unknown_type $product_data
	 */
	public function doItem( $ItemXml , $listingType ){
		if( $listingType == 'Chinese' ){
			return $this->addItem($ItemXml) ;
		}else{
			return $this->addFixedPriceItem($ItemXml) ;
		}
	}
}