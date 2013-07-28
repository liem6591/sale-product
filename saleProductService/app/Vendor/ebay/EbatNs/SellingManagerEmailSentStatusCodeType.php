<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * Specifies the Selling Manager email status 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/SellingManagerEmailSentStatusCodeType.html
 *
 * @property string Successful
 * @property string Failed
 * @property string Pending
 * @property string CustomCode
 */
class SellingManagerEmailSentStatusCodeType extends EbatNs_FacetType
{
	const CodeType_Successful = 'Successful';
	const CodeType_Failed = 'Failed';
	const CodeType_Pending = 'Pending';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('SellingManagerEmailSentStatusCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_SellingManagerEmailSentStatusCodeType = new SellingManagerEmailSentStatusCodeType();

?>
