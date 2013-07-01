<?php
// autogenerated file 30.08.2007 09:37
// $Id$
// $Log$
//
require_once 'TransactionArrayType.php';
require_once 'AbstractResponseType.php';
require_once 'UserType.php';
require_once 'PaginationResultType.php';

class GetSellerTransactionsResponseType extends AbstractResponseType
{
	// start props
	// @var PaginationResultType $PaginationResult
	var $PaginationResult;
	// @var boolean $HasMoreTransactions
	var $HasMoreTransactions;
	// @var int $TransactionsPerPage
	var $TransactionsPerPage;
	// @var int $PageNumber
	var $PageNumber;
	// @var int $ReturnedTransactionCountActual
	var $ReturnedTransactionCountActual;
	// @var UserType $Seller
	var $Seller;
	// @var TransactionArrayType $TransactionArray
	var $TransactionArray;
	// @var boolean $PayPalPreferred
	var $PayPalPreferred;
	// end props

/**
 *

 * @return PaginationResultType
 */
	function getPaginationResult()
	{
		return $this->PaginationResult;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPaginationResult($value)
	{
		$this->PaginationResult = $value;
	}
/**
 *

 * @return boolean
 */
	function getHasMoreTransactions()
	{
		return $this->HasMoreTransactions;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setHasMoreTransactions($value)
	{
		$this->HasMoreTransactions = $value;
	}
/**
 *

 * @return int
 */
	function getTransactionsPerPage()
	{
		return $this->TransactionsPerPage;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTransactionsPerPage($value)
	{
		$this->TransactionsPerPage = $value;
	}
/**
 *

 * @return int
 */
	function getPageNumber()
	{
		return $this->PageNumber;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPageNumber($value)
	{
		$this->PageNumber = $value;
	}
/**
 *

 * @return int
 */
	function getReturnedTransactionCountActual()
	{
		return $this->ReturnedTransactionCountActual;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setReturnedTransactionCountActual($value)
	{
		$this->ReturnedTransactionCountActual = $value;
	}
/**
 *

 * @return UserType
 */
	function getSeller()
	{
		return $this->Seller;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setSeller($value)
	{
		$this->Seller = $value;
	}
/**
 *

 * @return TransactionArrayType
 */
	function getTransactionArray()
	{
		return $this->TransactionArray;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setTransactionArray($value)
	{
		$this->TransactionArray = $value;
	}
/**
 *

 * @return boolean
 */
	function getPayPalPreferred()
	{
		return $this->PayPalPreferred;
	}
/**
 *

 * @return void
 * @param  $value 
 */
	function setPayPalPreferred($value)
	{
		$this->PayPalPreferred = $value;
	}
/**
 *

 * @return 
 */
	function GetSellerTransactionsResponseType()
	{
		$this->AbstractResponseType('GetSellerTransactionsResponseType', 'urn:ebay:apis:eBLBaseComponents');
		$this->_elements = array_merge($this->_elements,
			array(
				'PaginationResult' =>
				array(
					'required' => false,
					'type' => 'PaginationResultType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'HasMoreTransactions' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TransactionsPerPage' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PageNumber' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'ReturnedTransactionCountActual' =>
				array(
					'required' => false,
					'type' => 'int',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				),
				'Seller' =>
				array(
					'required' => false,
					'type' => 'UserType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'TransactionArray' =>
				array(
					'required' => false,
					'type' => 'TransactionArrayType',
					'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
					'array' => false,
					'cardinality' => '0..1'
				),
				'PayPalPreferred' =>
				array(
					'required' => false,
					'type' => 'boolean',
					'nsURI' => 'http://www.w3.org/2001/XMLSchema',
					'array' => false,
					'cardinality' => '0..1'
				)
			));

	}
}
?>
