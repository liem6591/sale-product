<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_ComplexType.php';
require_once 'FeedbackPeriodArrayType.php';
require_once 'AverageRatingDetailArrayType.php';

class FeedbackSummaryType extends EbatNs_ComplexType
{
	// start props
	// @var FeedbackPeriodArrayType $BidRetractionFeedbackPeriodArray
	var $BidRetractionFeedbackPeriodArray;
	// @var FeedbackPeriodArrayType $NegativeFeedbackPeriodArray
	var $NegativeFeedbackPeriodArray;
	// @var FeedbackPeriodArrayType $NeutralFeedbackPeriodArray
	var $NeutralFeedbackPeriodArray;
	// @var FeedbackPeriodArrayType $PositiveFeedbackPeriodArray
	var $PositiveFeedbackPeriodArray;
	// @var FeedbackPeriodArrayType $TotalFeedbackPeriodArray
	var $TotalFeedbackPeriodArray;
	// @var int $NeutralCommentCountFromSuspendedUsers
	var $NeutralCommentCountFromSuspendedUsers;
	// @var int $UniqueNegativeFeedbackCount
	var $UniqueNegativeFeedbackCount;
	// @var int $UniquePositiveFeedbackCount
	var $UniquePositiveFeedbackCount;
	// @var AverageRatingDetailArrayType $SellerAverageRatingDetailArray
	var $SellerAverageRatingDetailArray;
	// end props

/**
 *

 * @return FeedbackPeriodArrayType
 */
	function getBidRetractionFeedbackPeriodArray()
	{
		return $this->BidRetractionFeedbackPeriodArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setBidRetractionFeedbackPeriodArray($value)
	{
		$this->BidRetractionFeedbackPeriodArray = $value;
	}
/**
 *

 * @return FeedbackPeriodArrayType
 */
	function getNegativeFeedbackPeriodArray()
	{
		return $this->NegativeFeedbackPeriodArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNegativeFeedbackPeriodArray($value)
	{
		$this->NegativeFeedbackPeriodArray = $value;
	}
/**
 *

 * @return FeedbackPeriodArrayType
 */
	function getNeutralFeedbackPeriodArray()
	{
		return $this->NeutralFeedbackPeriodArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNeutralFeedbackPeriodArray($value)
	{
		$this->NeutralFeedbackPeriodArray = $value;
	}
/**
 *

 * @return FeedbackPeriodArrayType
 */
	function getPositiveFeedbackPeriodArray()
	{
		return $this->PositiveFeedbackPeriodArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPositiveFeedbackPeriodArray($value)
	{
		$this->PositiveFeedbackPeriodArray = $value;
	}
/**
 *

 * @return FeedbackPeriodArrayType
 */
	function getTotalFeedbackPeriodArray()
	{
		return $this->TotalFeedbackPeriodArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTotalFeedbackPeriodArray($value)
	{
		$this->TotalFeedbackPeriodArray = $value;
	}
/**
 *

 * @return int
 */
	function getNeutralCommentCountFromSuspendedUsers()
	{
		return $this->NeutralCommentCountFromSuspendedUsers;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNeutralCommentCountFromSuspendedUsers($value)
	{
		$this->NeutralCommentCountFromSuspendedUsers = $value;
	}
/**
 *

 * @return int
 */
	function getUniqueNegativeFeedbackCount()
	{
		return $this->UniqueNegativeFeedbackCount;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setUniqueNegativeFeedbackCount($value)
	{
		$this->UniqueNegativeFeedbackCount = $value;
	}
/**
 *

 * @return int
 */
	function getUniquePositiveFeedbackCount()
	{
		return $this->UniquePositiveFeedbackCount;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setUniquePositiveFeedbackCount($value)
	{
		$this->UniquePositiveFeedbackCount = $value;
	}
/**
 *

 * @return AverageRatingDetailArrayType
 */
	function getSellerAverageRatingDetailArray()
	{
		return $this->SellerAverageRatingDetailArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSellerAverageRatingDetailArray($value)
	{
		$this->SellerAverageRatingDetailArray = $value;
	}
/**
 *

 * @return 
 */
	function FeedbackSummaryType()
	{
		$this->EbatNs_ComplexType('FeedbackSummaryType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'BidRetractionFeedbackPeriodArray' =>
				array(
					'required' => false,
					'type' => 'FeedbackPeriodArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NegativeFeedbackPeriodArray' =>
				array(
					'required' => false,
					'type' => 'FeedbackPeriodArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NeutralFeedbackPeriodArray' =>
				array(
					'required' => false,
					'type' => 'FeedbackPeriodArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PositiveFeedbackPeriodArray' =>
				array(
					'required' => false,
					'type' => 'FeedbackPeriodArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TotalFeedbackPeriodArray' =>
				array(
					'required' => false,
					'type' => 'FeedbackPeriodArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NeutralCommentCountFromSuspendedUsers' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UniqueNegativeFeedbackCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UniquePositiveFeedbackCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SellerAverageRatingDetailArray' =>
				array(
					'required' => false,
					'type' => 'AverageRatingDetailArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>