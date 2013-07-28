<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * SellingManagerAutoRelistOptionCodeType - Specifies how the auto relist that will 
 * be performed. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/SellingManagerAutoRelistOptionCodeType.html
 *
 * @property string RelistImmediately
 * @property string RelistAfterDaysHours
 * @property string RelistAtSpecificTimeOfDay
 * @property string CustomCode
 */
class SellingManagerAutoRelistOptionCodeType extends EbatNs_FacetType
{
	const CodeType_RelistImmediately = 'RelistImmediately';
	const CodeType_RelistAfterDaysHours = 'RelistAfterDaysHours';
	const CodeType_RelistAtSpecificTimeOfDay = 'RelistAtSpecificTimeOfDay';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('SellingManagerAutoRelistOptionCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_SellingManagerAutoRelistOptionCodeType = new SellingManagerAutoRelistOptionCodeType();

?>
