<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'AbstractResponseType.php';
require_once 'DisputeIDType.php';

/**
 * Type defining the response of the <b>AddDispute</b> call. Upon a successful 
 * call, the response contains a newly created DisputeID value, which confirms that 
 * the the Unpaid Item or Mutually Canceled Transaction case was successfully 
 * created. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/AddDisputeResponseType.html
 *
 */
class AddDisputeResponseType extends AbstractResponseType
{
	/**
	 * @var DisputeIDType
	 */
	protected $DisputeID;

	/**
	 * @return DisputeIDType
	 */
	function getDisputeID()
	{
		return $this->DisputeID;
	}
	/**
	 * @return void
	 * @param DisputeIDType $value 
	 */
	function setDisputeID($value)
	{
		$this->DisputeID = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('AddDisputeResponseType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'DisputeID' =>
					array(
						'required' => false,
						'type' => 'DisputeIDType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					)
				));
	}
}
?>
