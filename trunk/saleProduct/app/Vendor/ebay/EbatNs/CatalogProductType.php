<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'ReviewDetailsType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'NameValueListArrayType.php';
require_once 'ExternalProductIDType.php';

class CatalogProductType extends EbatNs_ComplexType
{
	// start props
	// @var string $Title
	var $Title;
	// @var anyURI $DetailsURL
	var $DetailsURL;
	// @var anyURI $StockPhotoURL
	var $StockPhotoURL;
	// @var boolean $DisplayStockPhotos
	var $DisplayStockPhotos;
	// @var int $ItemCount
	var $ItemCount;
	// @var ExternalProductIDType $ExternalProductID
	var $ExternalProductID;
	// @var long $ProductReferenceID
	var $ProductReferenceID;
	// @var int $AttributeSetID
	var $AttributeSetID;
	// @var NameValueListArrayType $ItemSpecifics
	var $ItemSpecifics;
	// @var int $ReviewCount
	var $ReviewCount;
	// @var ReviewDetailsType $ReviewDetails
	var $ReviewDetails;
	// end props

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

 * @return anyURI
 */
	function getDetailsURL()
	{
		return $this->DetailsURL;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDetailsURL($value)
	{
		$this->DetailsURL = $value;
	}
/**
 *

 * @return anyURI
 */
	function getStockPhotoURL()
	{
		return $this->StockPhotoURL;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStockPhotoURL($value)
	{
		$this->StockPhotoURL = $value;
	}
/**
 *

 * @return boolean
 */
	function getDisplayStockPhotos()
	{
		return $this->DisplayStockPhotos;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDisplayStockPhotos($value)
	{
		$this->DisplayStockPhotos = $value;
	}
/**
 *

 * @return int
 */
	function getItemCount()
	{
		return $this->ItemCount;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemCount($value)
	{
		$this->ItemCount = $value;
	}
/**
 *

 * @return ExternalProductIDType
 */
	function getExternalProductID()
	{
		return $this->ExternalProductID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setExternalProductID($value)
	{
		$this->ExternalProductID = $value;
	}
/**
 *

 * @return long
 */
	function getProductReferenceID()
	{
		return $this->ProductReferenceID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setProductReferenceID($value)
	{
		$this->ProductReferenceID = $value;
	}
/**
 *

 * @return int
 */
	function getAttributeSetID()
	{
		return $this->AttributeSetID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setAttributeSetID($value)
	{
		$this->AttributeSetID = $value;
	}
/**
 *

 * @return NameValueListArrayType
 */
	function getItemSpecifics()
	{
		return $this->ItemSpecifics;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemSpecifics($value)
	{
		$this->ItemSpecifics = $value;
	}
/**
 *

 * @return int
 */
	function getReviewCount()
	{
		return $this->ReviewCount;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setReviewCount($value)
	{
		$this->ReviewCount = $value;
	}
/**
 *

 * @return ReviewDetailsType
 */
	function getReviewDetails()
	{
		return $this->ReviewDetails;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setReviewDetails($value)
	{
		$this->ReviewDetails = $value;
	}
/**
 *

 * @return 
 */
	function CatalogProductType()
	{
		$this->EbatNs_ComplexType('CatalogProductType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Title' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DetailsURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StockPhotoURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DisplayStockPhotos' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExternalProductID' =>
				array(
					'required' => false,
					'type' => 'ExternalProductIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ProductReferenceID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'AttributeSetID' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemSpecifics' =>
				array(
					'required' => false,
					'type' => 'NameValueListArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReviewCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReviewDetails' =>
				array(
					'required' => false,
					'type' => 'ReviewDetailsType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>