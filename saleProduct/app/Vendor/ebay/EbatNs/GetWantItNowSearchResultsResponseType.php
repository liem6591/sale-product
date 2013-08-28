<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractResponseType.php';
require_once 'PaginationResultType.php';
require_once 'WantItNowPostArrayType.php';

class GetWantItNowSearchResultsResponseType extends AbstractResponseType
{
	// start props
	// @var WantItNowPostArrayType $WantItNowPostArray
	var $WantItNowPostArray;
	// @var boolean $HasMoreItems
	var $HasMoreItems;
	// @var int $ItemsPerPage
	var $ItemsPerPage;
	// @var int $PageNumber
	var $PageNumber;
	// @var PaginationResultType $PaginationResult
	var $PaginationResult;
	// end props

/**
 *

 * @return WantItNowPostArrayType
 */
	function getWantItNowPostArray()
	{
		return $this->WantItNowPostArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setWantItNowPostArray($value)
	{
		$this->WantItNowPostArray = $value;
	}
/**
 *

 * @return boolean
 */
	function getHasMoreItems()
	{
		return $this->HasMoreItems;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setHasMoreItems($value)
	{
		$this->HasMoreItems = $value;
	}
/**
 *

 * @return int
 */
	function getItemsPerPage()
	{
		return $this->ItemsPerPage;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemsPerPage($value)
	{
		$this->ItemsPerPage = $value;
	}
/**
 *

 * @return int
 */
	function getPageNumber()
	{
		return $this->PageNumber;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPageNumber($value)
	{
		$this->PageNumber = $value;
	}
/**
 *

 * @return PaginationResultType
 */
	function getPaginationResult()
	{
		return $this->PaginationResult;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPaginationResult($value)
	{
		$this->PaginationResult = $value;
	}
/**
 *

 * @return 
 */
	function GetWantItNowSearchResultsResponseType()
	{
		$this->AbstractResponseType('GetWantItNowSearchResultsResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'WantItNowPostArray' =>
				array(
					'required' => false,
					'type' => 'WantItNowPostArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HasMoreItems' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemsPerPage' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PageNumber' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PaginationResult' =>
				array(
					'required' => false,
					'type' => 'PaginationResultType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>