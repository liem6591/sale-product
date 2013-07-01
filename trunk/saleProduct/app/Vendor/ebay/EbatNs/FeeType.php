<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_ComplexType.php';
require_once 'AmountType.php';

class FeeType extends EbatNs_ComplexType
{
	// start props
	// @var string $Name
	var $Name;
	// @var AmountType $Fee
	var $Fee;
	// end props

/**
 *

 * @return string
 */
	function getName()
	{
		return $this->Name;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setName($value)
	{
		$this->Name = $value;
	}
/**
 *

 * @return AmountType
 */
	function getFee()
	{
		return $this->Fee;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setFee($value)
	{
		$this->Fee = $value;
	}
/**
 *

 * @return 
 */
	function FeeType()
	{
		$this->EbatNs_ComplexType('FeeType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Name' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Fee' =>
				array(
					'required' => false,
					'type' => 'AmountType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
