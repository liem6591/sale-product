<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     MWSRecommendationsSectionService
 *  @copyright   Copyright 2008-2013 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2013-04-01
 */
 
/******************************************************************************* 
 * 
 *  MWS Recommendations Section Service PHP5 Library
 *  Generated: Thu Jun 06 14:24:33 PDT 2013
 * 
 */

/**
 *  @see MWSRecommendationsSectionService_Model
 */

require_once (VENDOR_PATH.'/amazon/MWSRecommendationsSectionService/Model.php');


/**
 * MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenRequest
 * 
 * Properties:
 * <ul>
 * 
 * <li>SellerId: string</li>
 * <li>NextToken: string</li>
 *
 * </ul>
 */

 class MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenRequest extends MWSRecommendationsSectionService_Model {

    public function __construct($data = null)
    {
        $this->_fields = array (
            'SellerId' => array('FieldValue' => null, 'FieldType' => 'string'),
            'NextToken' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
	    parent::__construct($data);
    }

    /**
     * Get the value of the SellerId property.
     *
     * @return String SellerId.
     */
    public function getSellerId()
	{
	    return $this->_fields['SellerId']['FieldValue'];
    }

    /**
     * Set the value of the SellerId property.
     *
     * @param string sellerId
     * @return this instance
     */
    public function setSellerId($value)
	{
	    $this->_fields['SellerId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerId is set.
     *
     * @return true if SellerId is set.
     */
    public function isSetSellerId()
	{
	            return !is_null($this->_fields['SellerId']['FieldValue']);
		    }

    /**
     * Set the value of SellerId, return this.
     *
     * @param sellerId
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerId($value)
	{
        $this->setSellerId($value);
        return $this;
    }

    /**
     * Get the value of the NextToken property.
     *
     * @return String NextToken.
     */
    public function getNextToken()
	{
	    return $this->_fields['NextToken']['FieldValue'];
    }

    /**
     * Set the value of the NextToken property.
     *
     * @param string nextToken
     * @return this instance
     */
    public function setNextToken($value)
	{
	    $this->_fields['NextToken']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if NextToken is set.
     *
     * @return true if NextToken is set.
     */
    public function isSetNextToken()
	{
	            return !is_null($this->_fields['NextToken']['FieldValue']);
		    }

    /**
     * Set the value of NextToken, return this.
     *
     * @param nextToken
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withNextToken($value)
	{
        $this->setNextToken($value);
        return $this;
    }

}
