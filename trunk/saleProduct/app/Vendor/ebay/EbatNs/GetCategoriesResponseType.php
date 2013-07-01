<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractResponseType.php';
require_once 'CategoryArrayType.php';

class GetCategoriesResponseType extends AbstractResponseType
{
	// start props
	// @var CategoryArrayType $CategoryArray
	var $CategoryArray;
	// @var int $CategoryCount
	var $CategoryCount;
	// @var dateTime $UpdateTime
	var $UpdateTime;
	// @var string $CategoryVersion
	var $CategoryVersion;
	// @var boolean $ReservePriceAllowed
	var $ReservePriceAllowed;
	// @var double $MinimumReservePrice
	var $MinimumReservePrice;
	// @var boolean $ReduceReserveAllowed
	var $ReduceReserveAllowed;
	// end props

/**
 *

 * @return CategoryArrayType
 */
	function getCategoryArray()
	{
		return $this->CategoryArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCategoryArray($value)
	{
		$this->CategoryArray = $value;
	}
/**
 *

 * @return int
 */
	function getCategoryCount()
	{
		return $this->CategoryCount;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCategoryCount($value)
	{
		$this->CategoryCount = $value;
	}
/**
 *

 * @return dateTime
 */
	function getUpdateTime()
	{
		return $this->UpdateTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setUpdateTime($value)
	{
		$this->UpdateTime = $value;
	}
/**
 *

 * @return string
 */
	function getCategoryVersion()
	{
		return $this->CategoryVersion;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCategoryVersion($value)
	{
		$this->CategoryVersion = $value;
	}
/**
 *

 * @return boolean
 */
	function getReservePriceAllowed()
	{
		return $this->ReservePriceAllowed;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setReservePriceAllowed($value)
	{
		$this->ReservePriceAllowed = $value;
	}
/**
 *

 * @return double
 */
	function getMinimumReservePrice()
	{
		return $this->MinimumReservePrice;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setMinimumReservePrice($value)
	{
		$this->MinimumReservePrice = $value;
	}
/**
 *

 * @return boolean
 */
	function getReduceReserveAllowed()
	{
		return $this->ReduceReserveAllowed;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setReduceReserveAllowed($value)
	{
		$this->ReduceReserveAllowed = $value;
	}
/**
 *

 * @return 
 */
	function GetCategoriesResponseType()
	{
		$this->AbstractResponseType('GetCategoriesResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'CategoryArray' =>
				array(
					'required' => false,
					'type' => 'CategoryArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CategoryCount' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'UpdateTime' =>
				array(
					'required' => false,
					'type' => 'dateTime',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'CategoryVersion' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReservePriceAllowed' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MinimumReservePrice' =>
				array(
					'required' => false,
					'type' => 'double',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReduceReserveAllowed' =>
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
