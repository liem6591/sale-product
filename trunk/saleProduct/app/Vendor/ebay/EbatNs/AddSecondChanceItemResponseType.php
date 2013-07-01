<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractResponseType.php';
require_once 'ItemIDType.php';

class AddSecondChanceItemResponseType extends AbstractResponseType
{
	// start props
	// @var ItemIDType $ItemID
	var $ItemID;
	// @var dateTime $StartTime
	var $StartTime;
	// @var dateTime $EndTime
	var $EndTime;
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

 * @return dateTime
 */
	function getStartTime()
	{
		return $this->StartTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStartTime($value)
	{
		$this->StartTime = $value;
	}
/**
 *

 * @return dateTime
 */
	function getEndTime()
	{
		return $this->EndTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setEndTime($value)
	{
		$this->EndTime = $value;
	}
/**
 *

 * @return 
 */
	function AddSecondChanceItemResponseType()
	{
		$this->AbstractResponseType('AddSecondChanceItemResponseType', 'urn:ebay:apis:eBLBaseComponents');
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
				'StartTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'EndTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
