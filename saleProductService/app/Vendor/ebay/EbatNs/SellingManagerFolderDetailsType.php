<?php
// autogenerated file 22.03.2013 08:43
// $Id: $
// $Log: $
//
//
require_once 'EbatNs_ComplexType.php';
require_once 'SellingManagerFolderDetailsType.php';

/**
 * Contains information about a Selling Manager folder. 
 *
 * @link http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/types/SellingManagerFolderDetailsType.html
 *
 */
class SellingManagerFolderDetailsType extends EbatNs_ComplexType
{
	/**
	 * @var long
	 */
	protected $FolderID;
	/**
	 * @var long
	 */
	protected $ParentFolderID;
	/**
	 * @var long
	 */
	protected $FolderLevel;
	/**
	 * @var string
	 */
	protected $FolderName;
	/**
	 * @var string
	 */
	protected $FolderComment;
	/**
	 * @var SellingManagerFolderDetailsType
	 */
	protected $ChildFolder;
	/**
	 * @var dateTime
	 */
	protected $CreationTime;

	/**
	 * @return long
	 */
	function getFolderID()
	{
		return $this->FolderID;
	}
	/**
	 * @return void
	 * @param long $value 
	 */
	function setFolderID($value)
	{
		$this->FolderID = $value;
	}
	/**
	 * @return long
	 */
	function getParentFolderID()
	{
		return $this->ParentFolderID;
	}
	/**
	 * @return void
	 * @param long $value 
	 */
	function setParentFolderID($value)
	{
		$this->ParentFolderID = $value;
	}
	/**
	 * @return long
	 */
	function getFolderLevel()
	{
		return $this->FolderLevel;
	}
	/**
	 * @return void
	 * @param long $value 
	 */
	function setFolderLevel($value)
	{
		$this->FolderLevel = $value;
	}
	/**
	 * @return string
	 */
	function getFolderName()
	{
		return $this->FolderName;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setFolderName($value)
	{
		$this->FolderName = $value;
	}
	/**
	 * @return string
	 */
	function getFolderComment()
	{
		return $this->FolderComment;
	}
	/**
	 * @return void
	 * @param string $value 
	 */
	function setFolderComment($value)
	{
		$this->FolderComment = $value;
	}
	/**
	 * @return SellingManagerFolderDetailsType
	 * @param integer $index 
	 */
	function getChildFolder($index = null)
	{
		if ($index !== null) {
			return $this->ChildFolder[$index];
		} else {
			return $this->ChildFolder;
		}
	}
	/**
	 * @return void
	 * @param SellingManagerFolderDetailsType $value 
	 * @param  $index 
	 */
	function setChildFolder($value, $index = null)
	{
		if ($index !== null) {
			$this->ChildFolder[$index] = $value;
		} else {
			$this->ChildFolder = $value;
		}
	}
	/**
	 * @return void
	 * @param SellingManagerFolderDetailsType $value 
	 */
	function addChildFolder($value)
	{
		$this->ChildFolder[] = $value;
	}
	/**
	 * @return dateTime
	 */
	function getCreationTime()
	{
		return $this->CreationTime;
	}
	/**
	 * @return void
	 * @param dateTime $value 
	 */
	function setCreationTime($value)
	{
		$this->CreationTime = $value;
	}
	/**
	 * @return 
	 */
	function __construct()
	{
		parent::__construct('SellingManagerFolderDetailsType', 'urn:ebay:apis:eBLBaseComponents');
		if (!isset(self::$_elements[__CLASS__]))
				self::$_elements[__CLASS__] = array_merge(self::$_elements[get_parent_class()],
				array(
					'FolderID' =>
					array(
						'required' => false,
						'type' => 'long',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'ParentFolderID' =>
					array(
						'required' => false,
						'type' => 'long',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'FolderLevel' =>
					array(
						'required' => false,
						'type' => 'long',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'FolderName' =>
					array(
						'required' => false,
						'type' => 'string',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'FolderComment' =>
					array(
						'required' => false,
						'type' => 'string',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					),
					'ChildFolder' =>
					array(
						'required' => false,
						'type' => 'SellingManagerFolderDetailsType',
						'nsURI' => 'urn:ebay:apis:eBLBaseComponents',
						'array' => true,
						'cardinality' => '0..*'
					),
					'CreationTime' =>
					array(
						'required' => false,
						'type' => 'dateTime',
						'nsURI' => 'http://www.w3.org/2001/XMLSchema',
						'array' => false,
						'cardinality' => '0..1'
					)
				));
	}
}
?>
