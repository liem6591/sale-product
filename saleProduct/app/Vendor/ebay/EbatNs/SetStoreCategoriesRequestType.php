<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'StoreCategoryUpdateActionCodeType.php';
require_once 'StoreCustomCategoryArrayType.php';
require_once 'AbstractRequestType.php';

class SetStoreCategoriesRequestType extends AbstractRequestType
{
	// start props
	// @var StoreCategoryUpdateActionCodeType $Action
	var $Action;
	// @var long $ItemDestinationCategoryID
	var $ItemDestinationCategoryID;
	// @var long $DestinationParentCategoryID
	var $DestinationParentCategoryID;
	// @var StoreCustomCategoryArrayType $StoreCategories
	var $StoreCategories;
	// end props

/**
 *

 * @return StoreCategoryUpdateActionCodeType
 */
	function getAction()
	{
		return $this->Action;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setAction($value)
	{
		$this->Action = $value;
	}
/**
 *

 * @return long
 */
	function getItemDestinationCategoryID()
	{
		return $this->ItemDestinationCategoryID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemDestinationCategoryID($value)
	{
		$this->ItemDestinationCategoryID = $value;
	}
/**
 *

 * @return long
 */
	function getDestinationParentCategoryID()
	{
		return $this->DestinationParentCategoryID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDestinationParentCategoryID($value)
	{
		$this->DestinationParentCategoryID = $value;
	}
/**
 *

 * @return StoreCustomCategoryArrayType
 */
	function getStoreCategories()
	{
		return $this->StoreCategories;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStoreCategories($value)
	{
		$this->StoreCategories = $value;
	}
/**
 *

 * @return 
 */
	function SetStoreCategoriesRequestType()
	{
		$this->AbstractRequestType('SetStoreCategoriesRequestType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Action' =>
				array(
					'required' => false,
					'type' => 'StoreCategoryUpdateActionCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemDestinationCategoryID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DestinationParentCategoryID' =>
				array(
					'required' => false,
					'type' => 'long',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'StoreCategories' =>
				array(
					'required' => false,
					'type' => 'StoreCustomCategoryArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>