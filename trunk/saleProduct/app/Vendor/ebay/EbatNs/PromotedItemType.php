<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'ListingTypeCodeType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'PromotionItemSelectionCodeType.php';
require_once 'PromotionDetailsType.php';
require_once 'ItemIDType.php';

class PromotedItemType extends EbatNs_ComplexType
{
	// start props
	// @var ItemIDType $ItemID
	var $ItemID;
	// @var string $PictureURL
	var $PictureURL;
	// @var int $Position
	var $Position;
	// @var PromotionItemSelectionCodeType $SelectionType
	var $SelectionType;
	// @var string $Title
	var $Title;
	// @var ListingTypeCodeType $ListingType
	var $ListingType;
	// @var PromotionDetailsType $PromotionDetails
	var $PromotionDetails;
	// @var duration $TimeLeft
	var $TimeLeft;
	// end props

/**
 *

 * @return ItemIDType
 */
	function getItemID()
	{
		return $this->ItemID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemID($value)
	{
		$this->ItemID = $value;
	}
/**
 *

 * @return string
 */
	function getPictureURL()
	{
		return $this->PictureURL;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPictureURL($value)
	{
		$this->PictureURL = $value;
	}
/**
 *

 * @return int
 */
	function getPosition()
	{
		return $this->Position;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPosition($value)
	{
		$this->Position = $value;
	}
/**
 *

 * @return PromotionItemSelectionCodeType
 */
	function getSelectionType()
	{
		return $this->SelectionType;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSelectionType($value)
	{
		$this->SelectionType = $value;
	}
/**
 *

 * @return string
 */
	function getTitle()
	{
		return $this->Title;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTitle($value)
	{
		$this->Title = $value;
	}
/**
 *

 * @return ListingTypeCodeType
 */
	function getListingType()
	{
		return $this->ListingType;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setListingType($value)
	{
		$this->ListingType = $value;
	}
/**
 *

 * @return PromotionDetailsType
 * @param  $index 
 */
	function getPromotionDetails($index = null)
	{
		if ($index) {
		return $this->PromotionDetails[$index];
	} else {
		return $this->PromotionDetails;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setPromotionDetails($value, $index = null)
	{
		if ($index) {
	$this->PromotionDetails[$index] = $value;
	} else {
	$this->PromotionDetails = $value;
	}

	}
/**
 *

 * @return duration
 */
	function getTimeLeft()
	{
		return $this->TimeLeft;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTimeLeft($value)
	{
		$this->TimeLeft = $value;
	}
/**
 *

 * @return 
 */
	function PromotedItemType()
	{
		$this->EbatNs_ComplexType('PromotedItemType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PictureURL' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Position' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SelectionType' =>
				array(
					'required' => false,
					'type' => 'PromotionItemSelectionCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Title' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ListingType' =>
				array(
					'required' => false,
					'type' => 'ListingTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PromotionDetails' =>
				array(
					'required' => false,
					'type' => 'PromotionDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'TimeLeft' =>
				array(
					'required' => false,
					'type' => 'duration',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>