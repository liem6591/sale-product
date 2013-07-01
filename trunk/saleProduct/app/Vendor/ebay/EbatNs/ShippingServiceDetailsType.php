<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'ShippingPackageCodeType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'ShippingTypeCodeType.php';
require_once 'ShippingServiceCodeType.php';

class ShippingServiceDetailsType extends EbatNs_ComplexType
{
	// start props
	// @var string $Description
	var $Description;
	// @var boolean $ExpeditedService
	var $ExpeditedService;
	// @var boolean $InternationalService
	var $InternationalService;
	// @var token $ShippingService
	var $ShippingService;
	// @var int $ShippingServiceID
	var $ShippingServiceID;
	// @var int $ShippingTimeMax
	var $ShippingTimeMax;
	// @var int $ShippingTimeMin
	var $ShippingTimeMin;
	// @var ShippingServiceCodeType $ShippingServiceCode
	var $ShippingServiceCode;
	// @var ShippingTypeCodeType $ServiceType
	var $ServiceType;
	// @var ShippingPackageCodeType $ShippingPackage
	var $ShippingPackage;
	// @var boolean $DimensionsRequired
	var $DimensionsRequired;
	// @var boolean $ValidForSellingFlow
	var $ValidForSellingFlow;
	// @var boolean $SurchargeApplicable
	var $SurchargeApplicable;
	// end props

/**
 *

 * @return string
 */
	function getDescription()
	{
		return $this->Description;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDescription($value)
	{
		$this->Description = $value;
	}
/**
 *

 * @return boolean
 */
	function getExpeditedService()
	{
		return $this->ExpeditedService;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setExpeditedService($value)
	{
		$this->ExpeditedService = $value;
	}
/**
 *

 * @return boolean
 */
	function getInternationalService()
	{
		return $this->InternationalService;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setInternationalService($value)
	{
		$this->InternationalService = $value;
	}
/**
 *

 * @return token
 */
	function getShippingService()
	{
		return $this->ShippingService;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingService($value)
	{
		$this->ShippingService = $value;
	}
/**
 *

 * @return int
 */
	function getShippingServiceID()
	{
		return $this->ShippingServiceID;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingServiceID($value)
	{
		$this->ShippingServiceID = $value;
	}
/**
 *

 * @return int
 */
	function getShippingTimeMax()
	{
		return $this->ShippingTimeMax;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingTimeMax($value)
	{
		$this->ShippingTimeMax = $value;
	}
/**
 *

 * @return int
 */
	function getShippingTimeMin()
	{
		return $this->ShippingTimeMin;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingTimeMin($value)
	{
		$this->ShippingTimeMin = $value;
	}
/**
 *

 * @return ShippingServiceCodeType
 */
	function getShippingServiceCode()
	{
		return $this->ShippingServiceCode;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setShippingServiceCode($value)
	{
		$this->ShippingServiceCode = $value;
	}
/**
 *

 * @return ShippingTypeCodeType
 * @param  $index 
 */
	function getServiceType($index = null)
	{
		if ($index) {
		return $this->ServiceType[$index];
	} else {
		return $this->ServiceType;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setServiceType($value, $index = null)
	{
		if ($index) {
	$this->ServiceType[$index] = $value;
	} else {
	$this->ServiceType = $value;
	}

	}
/**
 *

 * @return ShippingPackageCodeType
 * @param  $index 
 */
	function getShippingPackage($index = null)
	{
		if ($index) {
		return $this->ShippingPackage[$index];
	} else {
		return $this->ShippingPackage;
	}

	}
/**
 *

 * @return void
 * @param  $value 
 * @param  $index 
 */
	function setShippingPackage($value, $index = null)
	{
		if ($index) {
	$this->ShippingPackage[$index] = $value;
	} else {
	$this->ShippingPackage = $value;
	}

	}
/**
 *

 * @return boolean
 */
	function getDimensionsRequired()
	{
		return $this->DimensionsRequired;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDimensionsRequired($value)
	{
		$this->DimensionsRequired = $value;
	}
/**
 *

 * @return boolean
 */
	function getValidForSellingFlow()
	{
		return $this->ValidForSellingFlow;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setValidForSellingFlow($value)
	{
		$this->ValidForSellingFlow = $value;
	}
/**
 *

 * @return boolean
 */
	function getSurchargeApplicable()
	{
		return $this->SurchargeApplicable;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSurchargeApplicable($value)
	{
		$this->SurchargeApplicable = $value;
	}
/**
 *

 * @return 
 */
	function ShippingServiceDetailsType()
	{
		$this->EbatNs_ComplexType('ShippingServiceDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'Description' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ExpeditedService' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'InternationalService' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingService' =>
				array(
					'required' => false,
					'type' => 'token',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingServiceID' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingTimeMax' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingTimeMin' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ShippingServiceCode' =>
				array(
					'required' => false,
					'type' => 'ShippingServiceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ServiceType' =>
				array(
					'required' => false,
					'type' => 'ShippingTypeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'ShippingPackage' =>
				array(
					'required' => false,
					'type' => 'ShippingPackageCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => true,
					'cardinality' => '0..*'
				),
				'DimensionsRequired' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ValidForSellingFlow' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'SurchargeApplicable' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
