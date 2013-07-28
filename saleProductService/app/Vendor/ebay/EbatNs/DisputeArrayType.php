<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'EbatNs_ComplexType.php';
require_once 'DisputeType.php';

/**
 * Represents a list of disputes. Can hold zero or more Disputetypes, each of which 
 * describes a dispute. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/DisputeArrayType.html
 *
 */
class DisputeArrayType extends EbatNs_ComplexType
{
	/**
	 * @var DisputeType
	 */
	protected $Dispute;

	/**
	 * @return DisputeType
	 * @param integer $index 
	 */
	function getDispute($index = null)
	{
		if ($index !== null) {
			return $this->Dispute[$index];
		} else {
			return $this->Dispute;
		}
	}
	/**
	 * @return void
	 * @param DisputeType $value 
	 * @param  $index 
	 */
	function setDispute($value, $index = null)
	{
		if ($index !== null) {
			$this->Dispute[$index] = $value;
		} else {
			$this->Dispute = $value;
		}
	}
	/**
	 * @return void
	 * @param DisputeType $value 
	 */
	function addDispute($value)
	{
		$this->Dispute[] = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('DisputeArrayType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'Dispute' =>
					array(
						'required' => false,
						'type' => 'DisputeType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => true,
						'cardinality' => '0..*'
					)
				));
	}
}
?>
