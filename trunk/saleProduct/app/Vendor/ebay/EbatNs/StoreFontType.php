<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'StoreFontSizeCodeType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'StoreFontFaceCodeType.php';

class StoreFontType extends EbatNs_ComplexType
{
	// start props
	// @var StoreFontFaceCodeType $NameFace
	var $NameFace;
	// @var StoreFontSizeCodeType $NameSize
	var $NameSize;
	// @var string $NameColor
	var $NameColor;
	// @var StoreFontFaceCodeType $TitleFace
	var $TitleFace;
	// @var StoreFontSizeCodeType $TitleSize
	var $TitleSize;
	// @var string $TitleColor
	var $TitleColor;
	// @var StoreFontFaceCodeType $DescFace
	var $DescFace;
	// @var StoreFontSizeCodeType $DescSize
	var $DescSize;
	// @var string $DescColor
	var $DescColor;
	// end props

/**
 *

 * @return StoreFontFaceCodeType
 */
	function getNameFace()
	{
		return $this->NameFace;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNameFace($value)
	{
		$this->NameFace = $value;
	}
/**
 *

 * @return StoreFontSizeCodeType
 */
	function getNameSize()
	{
		return $this->NameSize;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNameSize($value)
	{
		$this->NameSize = $value;
	}
/**
 *

 * @return string
 */
	function getNameColor()
	{
		return $this->NameColor;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setNameColor($value)
	{
		$this->NameColor = $value;
	}
/**
 *

 * @return StoreFontFaceCodeType
 */
	function getTitleFace()
	{
		return $this->TitleFace;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTitleFace($value)
	{
		$this->TitleFace = $value;
	}
/**
 *

 * @return StoreFontSizeCodeType
 */
	function getTitleSize()
	{
		return $this->TitleSize;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTitleSize($value)
	{
		$this->TitleSize = $value;
	}
/**
 *

 * @return string
 */
	function getTitleColor()
	{
		return $this->TitleColor;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTitleColor($value)
	{
		$this->TitleColor = $value;
	}
/**
 *

 * @return StoreFontFaceCodeType
 */
	function getDescFace()
	{
		return $this->DescFace;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDescFace($value)
	{
		$this->DescFace = $value;
	}
/**
 *

 * @return StoreFontSizeCodeType
 */
	function getDescSize()
	{
		return $this->DescSize;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDescSize($value)
	{
		$this->DescSize = $value;
	}
/**
 *

 * @return string
 */
	function getDescColor()
	{
		return $this->DescColor;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setDescColor($value)
	{
		$this->DescColor = $value;
	}
/**
 *

 * @return 
 */
	function StoreFontType()
	{
		$this->EbatNs_ComplexType('StoreFontType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'NameFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NameSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'NameColor' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TitleColor' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescFace' =>
				array(
					'required' => false,
					'type' => 'StoreFontFaceCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescSize' =>
				array(
					'required' => false,
					'type' => 'StoreFontSizeCodeType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'DescColor' =>
				array(
					'required' => false,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
