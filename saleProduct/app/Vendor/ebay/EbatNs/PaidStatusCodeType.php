<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'EbatNs_FacetType.php';

class PaidStatusCodeType extends EbatNs_FacetType
{
	// start props
	// @var string $NotPaid
	var $NotPaid = 'NotPaid';
	// @var string $BuyerHasNotCompletedCheckout
	var $BuyerHasNotCompletedCheckout = 'BuyerHasNotCompletedCheckout';
	// @var string $PaymentPendingWithPayPal
	var $PaymentPendingWithPayPal = 'PaymentPendingWithPayPal';
	// @var string $PaidWithPayPal
	var $PaidWithPayPal = 'PaidWithPayPal';
	// @var string $MarkedAsPaid
	var $MarkedAsPaid = 'MarkedAsPaid';
	// @var string $PaymentPendingWithEscrow
	var $PaymentPendingWithEscrow = 'PaymentPendingWithEscrow';
	// @var string $PaidWithEscrow
	var $PaidWithEscrow = 'PaidWithEscrow';
	// @var string $EscrowPaymentCancelled
	var $EscrowPaymentCancelled = 'EscrowPaymentCancelled';
	// @var string $PaymentPendingWithPaisaPay
	var $PaymentPendingWithPaisaPay = 'PaymentPendingWithPaisaPay';
	// @var string $PaidWithPaisaPay
	var $PaidWithPaisaPay = 'PaidWithPaisaPay';
	// @var string $PaymentPending
	var $PaymentPending = 'PaymentPending';
	// @var string $CustomCode
	var $CustomCode = 'CustomCode';
	// end props

/**
 *

 * @return 
 */
	function PaidStatusCodeType()
	{
		$this->EbatNs_FacetType('PaidStatusCodeType', 'urn:ebay:apis:eBLBaseComponents');

	}
}

$Facet_PaidStatusCodeType = new PaidStatusCodeType();

?>
