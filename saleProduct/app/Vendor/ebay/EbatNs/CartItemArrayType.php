<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_ComplexType.php';
require_once 'CartItemType.php';

class CartItemArrayType extends EbatNs_ComplexType
{
	// start props
	// @var CartItemType $CartItem
	var $CartItem;
	// end props

/**
 *

 * @return CartItemType
 * @param  $index 
 */
	function getCartItem($index = null)
	{
		if ($index) {
		return $this->CartItem[$index];
	} else {
		return $this->CartItem;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setCartItem($value, $index = null)
	{
		if ($index) {
	$this->CartItem[$index] = $value;
	} else {
	$this->CartItem = $value;
	}

	}
/**
 *

 * @return 
 */
	function CartItemArrayType()
	{
		$this->EbatNs_ComplexType('CartItemArrayType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'CartItem' =>
				array(
					'required' => false,
					'type' => 'CartItemType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				)
			));

	}
}
?>