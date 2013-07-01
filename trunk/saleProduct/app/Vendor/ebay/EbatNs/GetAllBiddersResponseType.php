<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'UserIDType.php';
require_once 'ListingStatusCodeType.php';
require_once 'OfferArrayType.php';
require_once 'AbstractResponseType.php';
require_once 'AmountType.php';

class GetAllBiddersResponseType extends AbstractResponseType
{
	// start props
	// @var OfferArrayType $BidArray
	var $BidArray;
	// @var UserIDType $HighBidder
	var $HighBidder;
	// @var AmountType $HighestBid
	var $HighestBid;
	// @var ListingStatusCodeType $ListingStatus
	var $ListingStatus;
	// end props

/**
 *

 * @return OfferArrayType
 */
	function getBidArray()
	{
		return $this->BidArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBidArray($value)
	{
		$this->BidArray = $value;
	}
/**
 *

 * @return UserIDType
 */
	function getHighBidder()
	{
		return $this->HighBidder;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setHighBidder($value)
	{
		$this->HighBidder = $value;
	}
/**
 *

 * @return AmountType
 */
	function getHighestBid()
	{
		return $this->HighestBid;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setHighestBid($value)
	{
		$this->HighestBid = $value;
	}
/**
 *

 * @return ListingStatusCodeType
 */
	function getListingStatus()
	{
		return $this->ListingStatus;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setListingStatus($value)
	{
		$this->ListingStatus = $value;
	}
/**
 *

 * @return 
 */
	function GetAllBiddersResponseType()
	{
		$this->AbstractResponseType('GetAllBiddersResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'BidArray' =>
				array(
					'required' => false,
					'type' => 'OfferArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HighBidder' =>
				array(
					'required' => false,
					'type' => 'UserIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HighestBid' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingStatus' =>
				array(
					'required' => false,
					'type' => 'ListingStatusCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
