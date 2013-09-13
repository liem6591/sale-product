<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_FacetType.php';

class CombinedPaymentPeriodCodeType extends EbatNs_FacetType
{
	// start props
	// @var string $Days_3
	var $Days_3 = 'Days_3';
	// @var string $Days_5
	var $Days_5 = 'Days_5';
	// @var string $Days_7
	var $Days_7 = 'Days_7';
	// @var string $Days_14
	var $Days_14 = 'Days_14';
	// @var string $Days_30
	var $Days_30 = 'Days_30';
	// @var string $Ineligible
	var $Ineligible = 'Ineligible';
	// @var string $CustomCode
	var $CustomCode = 'CustomCode';
	// end props

/**
 *

 * @return 
 */
	function CombinedPaymentPeriodCodeType()
	{
		$this->EbatNs_FacetType('CombinedPaymentPeriodCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_CombinedPaymentPeriodCodeType = new CombinedPaymentPeriodCodeType();

?>