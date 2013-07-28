<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'SellerPaymentMethodCodeType.php';
require_once 'EbatNs_ComplexType.php';
require_once 'AccountStateCodeType.php';
require_once 'AdditionalAccountType.php';
require_once 'AmountType.php';

/**
 * Summary data for the requesting user's seller account as a whole. This includes 
 * abalance for the account, any past due amount and date, and defining data 
 * foradditional accounts (if the user has changed country of residency while 
 * having anactive eBay account). 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/AccountSummaryType.html
 *
 */
class AccountSummaryType extends EbatNs_ComplexType
{
	/**
	 * @var AccountStateCodeType
	 */
	protected $AccountState;
	/**
	 * @var AmountType
	 */
	protected $InvoicePayment;
	/**
	 * @var AmountType
	 */
	protected $InvoiceCredit;
	/**
	 * @var AmountType
	 */
	protected $InvoiceNewFee;
	/**
	 * @var AdditionalAccountType
	 */
	protected $AdditionalAccount;
	/**
	 * @var AmountType
	 */
	protected $AmountPastDue;
	/**
	 * @var string
	 */
	protected $BankAccountInfo;
	/**
	 * @var dateTime
	 */
	protected $BankModifyDate;
	/**
	 * @var int
	 */
	protected $BillingCycleDate;
	/**
	 * @var dateTime
	 */
	protected $CreditCardExpiration;
	/**
	 * @var string
	 */
	protected $CreditCardInfo;
	/**
	 * @var dateTime
	 */
	protected $CreditCardModifyDate;
	/**
	 * @var AmountType
	 */
	protected $CurrentBalance;
	/**
	 * @var string
	 */
	protected $Email;
	/**
	 * @var AmountType
	 */
	protected $InvoiceBalance;
	/**
	 * @var dateTime
	 */
	protected $InvoiceDate;
	/**
	 * @var AmountType
	 */
	protected $LastAmountPaid;
	/**
	 * @var dateTime
	 */
	protected $LastPaymentDate;
	/**
	 * @var boolean
	 */
	protected $PastDue;
	/**
	 * @var SellerPaymentMethodCodeType
	 */
	protected $PaymentMethod;

	/**
	 * @return AccountStateCodeType
	 */
	function getAccountState()
	{
		return $this->AccountState;
	}
	/**
	 * @return void
	 * @param AccountStateCodeType $value 
	 */
	function setAccountState($value)
	{
		$this->AccountState = $value;
	}
	/**
	 * @return AmountType
	 */
	function getInvoicePayment()
	{
		return $this->InvoicePayment;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setInvoicePayment($value)
	{
		$this->InvoicePayment = $value;
	}
	/**
	 * @return AmountType
	 */
	function getInvoiceCredit()
	{
		return $this->InvoiceCredit;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setInvoiceCredit($value)
	{
		$this->InvoiceCredit = $value;
	}
	/**
	 * @return AmountType
	 */
	function getInvoiceNewFee()
	{
		return $this->InvoiceNewFee;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setInvoiceNewFee($value)
	{
		$this->InvoiceNewFee = $value;
	}
	/**
	 * @return AdditionalAccountType
	 * @param integer $index 
	 */
	function getAdditionalAccount($index = null)
	{
		if ($index !== null) {
			return $this->AdditionalAccount[$index];
		} else {
			return $this->AdditionalAccount;
		}
	}
	/**
	 * @return void
	 * @param AdditionalAccountType $value 
	 * @param  $index 
	 */
	function setAdditionalAccount($value, $index = null)
	{
		if ($index !== null) {
			$this->AdditionalAccount[$index] = $value;
		} else {
			$this->AdditionalAccount = $value;
		}
	}
	/**
	 * @return void
	 * @param AdditionalAccountType $value 
	 */
	function addAdditionalAccount($value)
	{
		$this->AdditionalAccount[] = $value;
	}
	/**
	 * @return AmountType
	 */
	function getAmountPastDue()
	{
		return $this->AmountPastDue;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setAmountPastDue($value)
	{
		$this->AmountPastDue = $value;
	}
	/**
	 * @return string
	 */
	function getBankAccountInfo()
	{
		return $this->BankAccountInfo;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setBankAccountInfo($value)
	{
		$this->BankAccountInfo = $value;
	}
	/**
	 * @return dateTime
	 */
	function getBankModifyDate()
	{
		return $this->BankModifyDate;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setBankModifyDate($value)
	{
		$this->BankModifyDate = $value;
	}
	/**
	 * @return int
	 */
	function getBillingCycleDate()
	{
		return $this->BillingCycleDate;
	}
	/**
	 * @return void
	 * @param int $value 
	 */
	function setBillingCycleDate($value)
	{
		$this->BillingCycleDate = $value;
	}
	/**
	 * @return dateTime
	 */
	function getCreditCardExpiration()
	{
		return $this->CreditCardExpiration;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setCreditCardExpiration($value)
	{
		$this->CreditCardExpiration = $value;
	}
	/**
	 * @return string
	 */
	function getCreditCardInfo()
	{
		return $this->CreditCardInfo;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setCreditCardInfo($value)
	{
		$this->CreditCardInfo = $value;
	}
	/**
	 * @return dateTime
	 */
	function getCreditCardModifyDate()
	{
		return $this->CreditCardModifyDate;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setCreditCardModifyDate($value)
	{
		$this->CreditCardModifyDate = $value;
	}
	/**
	 * @return AmountType
	 */
	function getCurrentBalance()
	{
		return $this->CurrentBalance;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setCurrentBalance($value)
	{
		$this->CurrentBalance = $value;
	}
	/**
	 * @return string
	 */
	function getEmail()
	{
		return $this->Email;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setEmail($value)
	{
		$this->Email = $value;
	}
	/**
	 * @return AmountType
	 */
	function getInvoiceBalance()
	{
		return $this->InvoiceBalance;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setInvoiceBalance($value)
	{
		$this->InvoiceBalance = $value;
	}
	/**
	 * @return dateTime
	 */
	function getInvoiceDate()
	{
		return $this->InvoiceDate;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setInvoiceDate($value)
	{
		$this->InvoiceDate = $value;
	}
	/**
	 * @return AmountType
	 */
	function getLastAmountPaid()
	{
		return $this->LastAmountPaid;
	}
	/**
	 * @return void
	 * @param AmountType $value 
	 */
	function setLastAmountPaid($value)
	{
		$this->LastAmountPaid = $value;
	}
	/**
	 * @return dateTime
	 */
	function getLastPaymentDate()
	{
		return $this->LastPaymentDate;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setLastPaymentDate($value)
	{
		$this->LastPaymentDate = $value;
	}
	/**
	 * @return boolean
	 */
	function getPastDue()
	{
		return $this->PastDue;
	}
	/**
	 * @return void
	 * @param boolean $value 
	 */
	function setPastDue($value)
	{
		$this->PastDue = $value;
	}
	/**
	 * @return SellerPaymentMethodCodeType
	 */
	function getPaymentMethod()
	{
		return $this->PaymentMethod;
	}
	/**
	 * @return void
	 * @param SellerPaymentMethodCodeType $value 
	 */
	function setPaymentMethod($value)
	{
		$this->PaymentMethod = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('AccountSummaryType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'AccountState' =>
					array(
						'required' => false,
						'type' => 'AccountStateCodeType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'InvoicePayment' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'InvoiceCredit' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'InvoiceNewFee' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'AdditionalAccount' =>
					array(
						'required' => false,
						'type' => 'AdditionalAccountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => true,
						'cardinality' => '0..*'
					),
					'AmountPastDue' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'BankAccountInfo' =>
					array(
						'required' => false,
						'type' => 'string',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'BankModifyDate' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'BillingCycleDate' =>
					array(
						'required' => false,
						'type' => 'int',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'CreditCardExpiration' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'CreditCardInfo' =>
					array(
						'required' => false,
						'type' => 'string',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'CreditCardModifyDate' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'CurrentBalance' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'Email' =>
					array(
						'required' => false,
						'type' => 'string',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'InvoiceBalance' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'InvoiceDate' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'LastAmountPaid' =>
					array(
						'required' => false,
						'type' => 'AmountType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					),
					'LastPaymentDate' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'PastDue' =>
					array(
						'required' => false,
						'type' => 'boolean',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'PaymentMethod' =>
					array(
						'required' => false,
						'type' => 'SellerPaymentMethodCodeType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => false,
						'cardinality' => '0..1'
					)
				));
	}
}
?>
