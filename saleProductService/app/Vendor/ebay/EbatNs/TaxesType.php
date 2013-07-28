<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'TaxDetailsType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'AmountType.php';

/**
 * Type defining the Taxes container, which contains detailed sales tax information 
 * for anorder line item. The Taxes container is only returned if the seller is 
 * using the Vertex-based Premium Sales Tax Engine solution. The information in 
 * this containersupercedes/overrides the sales tax information in the 
 * ShippingDetails.SalesTax container. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/TaxesType.html
 *
 */
class TaxesType extends EbatNs_ComplexType
{
	/**
	 * @var AmountType
	 */
	protected $TotalTaxAmount;
	/**
	 * @var TaxDetailsType
	 */
	protected $TaxDetails;

	/**
	 * @return AmountType
	 */
	function getTotalTaxAmount()
	{
		return $this->TotalTaxAmount;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setTotalTaxAmount($value)
	{
		$this->TotalTaxAmount = $value;
	}
	/**
	 * @return TaxDetailsType
	 * @param integer $index 
	 */
	function getTaxDetails($index = null)
	{
		if ($index !== null) {
			return $this->TaxDetails[$index];
		} else {
			return $this->TaxDetails;
		}
	}
	/**
	 * @return void
	 * @param TaxDetailsType $value 
	 * @param  $index 
	 */
	function setTaxDetails($value, $index = null)
	{
		if ($index !== null) {
			$this->TaxDetails[$index] = $value;
		} else {
			$this->TaxDetails = $value;
		}
	}
	/**
	 * @return void
	 * @param TaxDetailsType $value 
	 */
	function addTaxDetails($value)
	{
		$this->TaxDetails[] = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('TaxesType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'TotalTaxAmount' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'TaxDetails' =>
					array(
						'required' => false,
						'type' => 'TaxDetailsType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => true,
						'cardinality' => '0..*'
					)
				));
	}
}
?>
