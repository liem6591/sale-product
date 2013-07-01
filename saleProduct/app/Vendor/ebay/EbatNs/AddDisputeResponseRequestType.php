<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'DisputeIDType.php';
require_once 'DisputeActivityCodeType.php';
require_once 'AbstractRequestType.php';

class AddDisputeResponseRequestType extends AbstractRequestType
{
	// start props
	// @var DisputeIDType $DisputeID
	var $DisputeID;
	// @var string $MessageText
	var $MessageText;
	// @var DisputeActivityCodeType $DisputeActivity
	var $DisputeActivity;
	// @var string $ShippingCarrierUsed
	var $ShippingCarrierUsed;
	// @var string $ShipmentTrackNumber
	var $ShipmentTrackNumber;
	// @var dateTime $ShippingTime
	var $ShippingTime;
	// end props

/**
 *

 * @return DisputeIDType
 */
	function getDisputeID()
	{
		return $this->DisputeID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDisputeID($value)
	{
		$this->DisputeID = $value;
	}
/**
 *

 * @return string
 */
	function getMessageText()
	{
		return $this->MessageText;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setMessageText($value)
	{
		$this->MessageText = $value;
	}
/**
 *

 * @return DisputeActivityCodeType
 */
	function getDisputeActivity()
	{
		return $this->DisputeActivity;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDisputeActivity($value)
	{
		$this->DisputeActivity = $value;
	}
/**
 *

 * @return string
 */
	function getShippingCarrierUsed()
	{
		return $this->ShippingCarrierUsed;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingCarrierUsed($value)
	{
		$this->ShippingCarrierUsed = $value;
	}
/**
 *

 * @return string
 */
	function getShipmentTrackNumber()
	{
		return $this->ShipmentTrackNumber;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShipmentTrackNumber($value)
	{
		$this->ShipmentTrackNumber = $value;
	}
/**
 *

 * @return dateTime
 */
	function getShippingTime()
	{
		return $this->ShippingTime;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingTime($value)
	{
		$this->ShippingTime = $value;
	}
/**
 *

 * @return 
 */
	function AddDisputeResponseRequestType()
	{
		$this->AbstractRequestType('AddDisputeResponseRequestType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'DisputeID' =>
				array(
					'required' => false,
					'type' => 'DisputeIDType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'MessageText' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DisputeActivity' =>
				array(
					'required' => false,
					'type' => 'DisputeActivityCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingCarrierUsed' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShipmentTrackNumber' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingTime' =>
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