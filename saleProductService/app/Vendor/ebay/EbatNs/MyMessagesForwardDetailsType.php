<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'EbatNs_ComplexType.php';

/**
 * This type is deprecated because <b>MyMessagesAlert*</b> are deprecated. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/MyMessagesForwardDetailsType.html
 *
 */
class MyMessagesForwardDetailsType extends EbatNs_ComplexType
{
	/**
	 * @var dateTime
	 */
	protected $UserForwardDate;
	/**
	 * @var string
	 */
	protected $ForwardMessageEncoding;

	/**
	 * @return dateTime
	 */
	function getUserForwardDate()
	{
		return $this->UserForwardDate;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setUserForwardDate($value)
	{
		$this->UserForwardDate = $value;
	}
	/**
	 * @return string
	 */
	function getForwardMessageEncoding()
	{
		return $this->ForwardMessageEncoding;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setForwardMessageEncoding($value)
	{
		$this->ForwardMessageEncoding = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('MyMessagesForwardDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'UserForwardDate' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'ForwardMessageEncoding' =>
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
