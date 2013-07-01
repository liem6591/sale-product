<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'BestOfferStatusCodeType.php';
require_once 'AmountType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'UserType.php';
require_once 'BestOfferTypeCodeType.php';
require_once 'BestOfferIDType.php';

class BestOfferType extends EbatNs_ComplexType
{
	// start props
	// @var BestOfferIDType $BestOfferID
	var $BestOfferID;
	// @var dateTime $ExpirationTime
	var $ExpirationTime;
	// @var UserType $Buyer
	var $Buyer;
	// @var AmountType $Price
	var $Price;
	// @var BestOfferStatusCodeType $Status
	var $Status;
	// @var int $Quantity
	var $Quantity;
	// @var string $BuyerMessage
	var $BuyerMessage;
	// @var string $SellerMessage
	var $SellerMessage;
	// @var BestOfferTypeCodeType $BestOfferCodeType
	var $BestOfferCodeType;
	// @var string $CallStatus
	var $CallStatus;
	// end props

/**
 *

 * @return BestOfferIDType
 */
	function getBestOfferID()
	{
		return $this->BestOfferID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBestOfferID($value)
	{
		$this->BestOfferID = $value;
	}
/**
 *

 * @return dateTime
 */
	function getExpirationTime()
	{
		return $this->ExpirationTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setExpirationTime($value)
	{
		$this->ExpirationTime = $value;
	}
/**
 *

 * @return UserType
 */
	function getBuyer()
	{
		return $this->Buyer;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBuyer($value)
	{
		$this->Buyer = $value;
	}
/**
 *

 * @return AmountType
 */
	function getPrice()
	{
		return $this->Price;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPrice($value)
	{
		$this->Price = $value;
	}
/**
 *

 * @return BestOfferStatusCodeType
 */
	function getStatus()
	{
		return $this->Status;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStatus($value)
	{
		$this->Status = $value;
	}
/**
 *

 * @return int
 */
	function getQuantity()
	{
		return $this->Quantity;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setQuantity($value)
	{
		$this->Quantity = $value;
	}
/**
 *

 * @return string
 */
	function getBuyerMessage()
	{
		return $this->BuyerMessage;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBuyerMessage($value)
	{
		$this->BuyerMessage = $value;
	}
/**
 *

 * @return string
 */
	function getSellerMessage()
	{
		return $this->SellerMessage;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSellerMessage($value)
	{
		$this->SellerMessage = $value;
	}
/**
 *

 * @return BestOfferTypeCodeType
 */
	function getBestOfferCodeType()
	{
		return $this->BestOfferCodeType;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBestOfferCodeType($value)
	{
		$this->BestOfferCodeType = $value;
	}
/**
 *

 * @return string
 */
	function getCallStatus()
	{
		return $this->CallStatus;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCallStatus($value)
	{
		$this->CallStatus = $value;
	}
/**
 *

 * @return 
 */
	function BestOfferType()
	{
		$this->EbatNs_ComplexType('BestOfferType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'BestOfferID' =>
				array(
					'required' => false,
					'type' => 'BestOfferIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExpirationTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Buyer' =>
				array(
					'required' => false,
					'type' => 'UserType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Price' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Status' =>
				array(
					'required' => false,
					'type' => 'BestOfferStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Quantity' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BuyerMessage' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellerMessage' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'BestOfferCodeType' =>
				array(
					'required' => false,
					'type' => 'BestOfferTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CallStatus' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
