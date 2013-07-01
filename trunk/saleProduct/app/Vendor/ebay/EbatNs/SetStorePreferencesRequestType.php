<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'StorePreferencesType.php';
require_once 'AbstractRequestType.php';

class SetStorePreferencesRequestType extends AbstractRequestType
{
	// start props
	// @var StorePreferencesType $StorePreferences
	var $StorePreferences;
	// end props

/**
 *

 * @return StorePreferencesType
 */
	function getStorePreferences()
	{
		return $this->StorePreferences;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setStorePreferences($value)
	{
		$this->StorePreferences = $value;
	}
/**
 *

 * @return 
 */
	function SetStorePreferencesRequestType()
	{
		$this->AbstractRequestType('SetStorePreferencesRequestType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'StorePreferences' =>
				array(
					'required' => false,
					'type' => 'StorePreferencesType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
