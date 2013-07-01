<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_ComplexType.php';

class PictureSetMemberType extends EbatNs_ComplexType
{
	// start props
	// @var anyURI $MemberURL
	var $MemberURL;
	// @var int $PictureHeight
	var $PictureHeight;
	// @var int $PictureWidth
	var $PictureWidth;
	// end props

/**
 *

 * @return anyURI
 */
	function getMemberURL()
	{
		return $this->MemberURL;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setMemberURL($value)
	{
		$this->MemberURL = $value;
	}
/**
 *

 * @return int
 */
	function getPictureHeight()
	{
		return $this->PictureHeight;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPictureHeight($value)
	{
		$this->PictureHeight = $value;
	}
/**
 *

 * @return int
 */
	function getPictureWidth()
	{
		return $this->PictureWidth;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPictureWidth($value)
	{
		$this->PictureWidth = $value;
	}
/**
 *

 * @return 
 */
	function PictureSetMemberType()
	{
		$this->EbatNs_ComplexType('PictureSetMemberType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'MemberURL' =>
				array(
					'required' => false,
					'type' => 'anyURI',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PictureHeight' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PictureWidth' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
