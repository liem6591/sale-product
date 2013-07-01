<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractResponseType.php';
require_once 'StoreType.php';

class GetStoreResponseType extends AbstractResponseType
{
	// start props
	// @var StoreType $Store
	var $Store;
	// end props

/**
 *

 * @return StoreType
 */
	function getStore()
	{
		return $this->Store;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStore($value)
	{
		$this->Store = $value;
	}
/**
 *

 * @return 
 */
	function GetStoreResponseType()
	{
		$this->AbstractResponseType('GetStoreResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Store' =>
				array(
					'required' => false,
					'type' => 'StoreType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
