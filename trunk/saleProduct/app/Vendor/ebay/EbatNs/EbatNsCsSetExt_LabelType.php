<?php
// autogenerated file 23.02.2007 11:57
// $Id$
// $Log$
//
require_once 'EbatNs_ComplexType.php';

class EbatNsCsSetExt_LabelType extends EbatNs_ComplexType
{
	// start props
	// @var string $Name
	var $Name;
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

 * @return 
 */
	function EbatNsCsSetExt_LabelType()
	{
		$this->EbatNs_ComplexType('EbatNsCsSetExt_LabelType', 'http://www.w3.org/2001/XMLSchema');
		$this->_elements = array_merge($this->_elements,
			array(
				'Name' =>
				array(
					'required' => true,
					'type' => 'string',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '1..1'
				)
			));
	$this->_attributes = array_merge($this->_attributes,
		array(
			'visible' =>
			array(
				'name' => 'visible',
				'type' => 'boolean',
				'use' => 'required'
			),
			'align' =>
			array(
				'name' => 'align',
				'type' => 'string',
				'use' => 'required'
			),
			'color' =>
			array(
				'name' => 'color',
				'type' => 'string',
				'use' => 'required'
			),
			'face' =>
			array(
				'name' => 'face',
				'type' => 'string',
				'use' => 'required'
			),
			'size' =>
			array(
				'name' => 'size',
				'type' => 'string',
				'use' => 'required'
			),
			'bold' =>
			array(
				'name' => 'bold',
				'type' => 'boolean',
				'use' => 'required'
			)
		));

	}
}
?>
