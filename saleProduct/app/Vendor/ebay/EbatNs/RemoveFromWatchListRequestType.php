<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractRequestType.php';
require_once 'ItemIDType.php';

class RemoveFromWatchListRequestType extends AbstractRequestType
{
	// start props
	// @var ItemIDType $ItemID
	var $ItemID;
	// @var boolean $RemoveAllItems
	var $RemoveAllItems;
	// end props

/**
 *

 * @return ItemIDType
 * @param  $index 
 */
	function getItemID($index = null)
	{
		if ($index) {
		return $this->ItemID[$index];
	} else {
		return $this->ItemID;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setItemID($value, $index = null)
	{
		if ($index) {
	$this->ItemID[$index] = $value;
	} else {
	$this->ItemID = $value;
	}

	}
/**
 *

 * @return boolean
 */
	function getRemoveAllItems()
	{
		return $this->RemoveAllItems;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setRemoveAllItems($value)
	{
		$this->RemoveAllItems = $value;
	}
/**
 *

 * @return 
 */
	function RemoveFromWatchListRequestType()
	{
		$this->AbstractRequestType('RemoveFromWatchListRequestType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'ItemID' =>
				array(
					'required' => false,
					'type' => 'ItemIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'RemoveAllItems' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>