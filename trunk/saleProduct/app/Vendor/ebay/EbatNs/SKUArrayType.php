<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'SKUType.php';
require_once 'EbatNs_ComplexType.php';

class SKUArrayType extends EbatNs_ComplexType
{
	// start props
	// @var SKUType $SKU
	var $SKU;
	// end props

/**
 *

 * @return SKUType
 * @param  $index 
 */
	function getSKU($index = null)
	{
		if ($index) {
		return $this->SKU[$index];
	} else {
		return $this->SKU;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setSKU($value, $index = null)
	{
		if ($index) {
	$this->SKU[$index] = $value;
	} else {
	$this->SKU = $value;
	}

	}
/**
 *

 * @return 
 */
	function SKUArrayType()
	{
		$this->EbatNs_ComplexType('SKUArrayType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'SKU' =>
				array(
					'required' => false,
					'type' => 'SKUType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)
			));

	}
}
?>
