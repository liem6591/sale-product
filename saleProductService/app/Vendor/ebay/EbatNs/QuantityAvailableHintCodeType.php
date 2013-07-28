<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * Indicates the text message type of the item's quantity availability. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/QuantityAvailableHintCodeType.html
 *
 * @property string Limited
 * @property string MoreThan
 * @property string CustomCode
 */
class QuantityAvailableHintCodeType extends EbatNs_FacetType
{
	const CodeType_Limited = 'Limited';
	const CodeType_MoreThan = 'MoreThan';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('QuantityAvailableHintCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_QuantityAvailableHintCodeType = new QuantityAvailableHintCodeType();

?>
