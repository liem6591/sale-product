<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * Enumerated type containing the list of values that can be used when revising the 
 * item description of an active listing through the Revise API calls. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/DescriptionReviseModeCodeType.html
 *
 * @property string Replace
 * @property string Prepend
 * @property string Append
 * @property string CustomCode
 */
class DescriptionReviseModeCodeType extends EbatNs_FacetType
{
	const CodeType_Replace = 'Replace';
	const CodeType_Prepend = 'Prepend';
	const CodeType_Append = 'Append';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('DescriptionReviseModeCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_DescriptionReviseModeCodeType = new DescriptionReviseModeCodeType();

?>
