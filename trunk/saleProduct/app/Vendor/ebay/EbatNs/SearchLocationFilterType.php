<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'CountryCodeType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'ItemLocationCodeType.php';
require_once 'SearchLocationType.php';
require_once 'CurrencyCodeType.php';

class SearchLocationFilterType extends EbatNs_ComplexType
{
	// start props
	// @var CountryCodeType $CountryCode
	var $CountryCode;
	// @var ItemLocationCodeType $ItemLocation
	var $ItemLocation;
	// @var SearchLocationType $SearchLocation
	var $SearchLocation;
	// @var CurrencyCodeType $Currency
	var $Currency;
	// end props

/**
 *

 * @return CountryCodeType
 */
	function getCountryCode()
	{
		return $this->CountryCode;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCountryCode($value)
	{
		$this->CountryCode = $value;
	}
/**
 *

 * @return ItemLocationCodeType
 */
	function getItemLocation()
	{
		return $this->ItemLocation;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setItemLocation($value)
	{
		$this->ItemLocation = $value;
	}
/**
 *

 * @return SearchLocationType
 */
	function getSearchLocation()
	{
		return $this->SearchLocation;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSearchLocation($value)
	{
		$this->SearchLocation = $value;
	}
/**
 *

 * @return CurrencyCodeType
 */
	function getCurrency()
	{
		return $this->Currency;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setCurrency($value)
	{
		$this->Currency = $value;
	}
/**
 *

 * @return 
 */
	function SearchLocationFilterType()
	{
		$this->EbatNs_ComplexType('SearchLocationFilterType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'CountryCode' =>
				array(
					'required' => false,
					'type' => 'CountryCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ItemLocation' =>
				array(
					'required' => false,
					'type' => 'ItemLocationCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SearchLocation' =>
				array(
					'required' => false,
					'type' => 'SearchLocationType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Currency' =>
				array(
					'required' => false,
					'type' => 'CurrencyCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>