<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_FacetType.php';

class BidGroupStatusCodeType extends EbatNs_FacetType
{
	// start props
	// @var string $Open
	var $Open = 'Open';
	// @var string $Closed
	var $Closed = 'Closed';
	// @var string $CustomCode
	var $CustomCode = 'CustomCode';
	// end props

/**
 *

 * @return 
 */
	function BidGroupStatusCodeType()
	{
		$this->EbatNs_FacetType('BidGroupStatusCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_BidGroupStatusCodeType = new BidGroupStatusCodeType();

?>