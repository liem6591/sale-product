<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_FacetType.php';

class SellerBusinessCodeType extends EbatNs_FacetType
{
	// start props
	// @var string $Undefined
	var $Undefined = 'Undefined';
	// @var string $Private
	var $Private = 'Private';
	// @var string $Commercial
	var $Commercial = 'Commercial';
	// end props

/**
 *

 * @return 
 */
	function SellerBusinessCodeType()
	{
		$this->EbatNs_FacetType('SellerBusinessCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_SellerBusinessCodeType = new SellerBusinessCodeType();

?>