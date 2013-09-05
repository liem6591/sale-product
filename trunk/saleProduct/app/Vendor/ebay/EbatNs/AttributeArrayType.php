<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AttributeType.php';
require_once 'EbatNs_ComplexType.php';

class AttributeArrayType extends EbatNs_ComplexType
{
	// start props
	// @var AttributeType $Attribute
	var $Attribute;
	// end props

/**
 *

 * @return AttributeType
 * @param  $index 
 */
	function getAttribute($index = null)
	{
		if ($index) {
		return $this->Attribute[$index];
	} else {
		return $this->Attribute;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setAttribute($value, $index = null)
	{
		if ($index) {
	$this->Attribute[$index] = $value;
	} else {
	$this->Attribute = $value;
	}

	}
/**
 *

 * @return 
 */
	function AttributeArrayType()
	{
		$this->EbatNs_ComplexType('AttributeArrayType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Attribute' =>
				array(
					'required' => false,
					'type' => 'AttributeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)
			));

	}
}
?>