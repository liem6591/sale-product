<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'AbstractResponseType.php';

class FetchTokenResponseType extends AbstractResponseType
{
	// start props
	// @var string $eBayAuthToken
	var $eBayAuthToken;
	// @var dateTime $HardExpirationTime
	var $HardExpirationTime;
	// end props

/**
 *

 * @return string
 */
	function geteBayAuthToken()
	{
		return $this->eBayAuthToken;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function seteBayAuthToken($value)
	{
		$this->eBayAuthToken = $value;
	}
/**
 *

 * @return dateTime
 */
	function getHardExpirationTime()
	{
		return $this->HardExpirationTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setHardExpirationTime($value)
	{
		$this->HardExpirationTime = $value;
	}
/**
 *

 * @return 
 */
	function FetchTokenResponseType()
	{
		$this->AbstractResponseType('FetchTokenResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'eBayAuthToken' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HardExpirationTime' =>
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