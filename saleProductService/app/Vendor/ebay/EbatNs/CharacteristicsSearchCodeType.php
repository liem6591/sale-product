<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
require_once 'EbatNs_FacetType.php';

/**
 * This type is deprecated as the <b>GetProduct*</b> calls are no longer available. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/CharacteristicsSearchCodeType.html
 *
 * @property string Single
 * @property string Multi
 * @property string CustomCode
 */
class CharacteristicsSearchCodeType extends EbatNs_FacetType
{
	const CodeType_Single = 'Single';
	const CodeType_Multi = 'Multi';
	const CodeType_CustomCode = 'CustomCode';

	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('CharacteristicsSearchCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_CharacteristicsSearchCodeType = new CharacteristicsSearchCodeType();

?>
