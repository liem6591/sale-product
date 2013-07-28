<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * Contains information about the status of email correspondence for the lead. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/AdFormatLeadStatusCodeType.html
 *
 * @property string New
 * @property string Responded
 * @property string CustomCode
 */
class AdFormatLeadStatusCodeType extends EbatNs_FacetType
{
	const CodeType_New = 'New';
	const CodeType_Responded = 'Responded';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('AdFormatLeadStatusCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_AdFormatLeadStatusCodeType = new AdFormatLeadStatusCodeType();

?>
