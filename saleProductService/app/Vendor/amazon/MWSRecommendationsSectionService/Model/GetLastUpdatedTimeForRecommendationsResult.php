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
 * MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsResult
 * 
 * Properties:
 * <ul>
 * 
 * <li>InventoryRecommendationsLastUpdated: string</li>
 * <li>SelectionRecommendationsLastUpdated: string</li>
 * <li>FulfillmentRecommendationsLastUpdated: string</li>
 * <li>PricingRecommendationsLastUpdated: string</li>
 *
 * </ul>
 */

 class MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsResult extends MWSRecommendationsSectionService_Model {

    public function __construct($data = null)
    {
        $this->_fields = array (
            'InventoryRecommendationsLastUpdated' => array('FieldValue' => null, 'FieldType' => 'string'),
            'SelectionRecommendationsLastUpdated' => array('FieldValue' => null, 'FieldType' => 'string'),
            'FulfillmentRecommendationsLastUpdated' => array('FieldValue' => null, 'FieldType' => 'string'),
            'PricingRecommendationsLastUpdated' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
	    parent::__construct($data);
    }

    /**
     * Get the value of the InventoryRecommendationsLastUpdated property.
     *
     * @return XMLGregorianCalendar InventoryRecommendationsLastUpdated.
     */
    public function getInventoryRecommendationsLastUpdated()
	{
	    return $this->_fields['InventoryRecommendationsLastUpdated']['FieldValue'];
    }

    /**
     * Set the value of the InventoryRecommendationsLastUpdated property.
     *
     * @param string inventoryRecommendationsLastUpdated
     * @return this instance
     */
    public function setInventoryRecommendationsLastUpdated($value)
	{
	    $this->_fields['InventoryRecommendationsLastUpdated']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if InventoryRecommendationsLastUpdated is set.
     *
     * @return true if InventoryRecommendationsLastUpdated is set.
     */
    public function isSetInventoryRecommendationsLastUpdated()
	{
	            return !is_null($this->_fields['InventoryRecommendationsLastUpdated']['FieldValue']);
		    }

    /**
     * Set the value of InventoryRecommendationsLastUpdated, return this.
     *
     * @param inventoryRecommendationsLastUpdated
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withInventoryRecommendationsLastUpdated($value)
	{
        $this->setInventoryRecommendationsLastUpdated($value);
        return $this;
    }

    /**
     * Get the value of the SelectionRecommendationsLastUpdated property.
     *
     * @return XMLGregorianCalendar SelectionRecommendationsLastUpdated.
     */
    public function getSelectionRecommendationsLastUpdated()
	{
	    return $this->_fields['SelectionRecommendationsLastUpdated']['FieldValue'];
    }

    /**
     * Set the value of the SelectionRecommendationsLastUpdated property.
     *
     * @param string selectionRecommendationsLastUpdated
     * @return this instance
     */
    public function setSelectionRecommendationsLastUpdated($value)
	{
	    $this->_fields['SelectionRecommendationsLastUpdated']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SelectionRecommendationsLastUpdated is set.
     *
     * @return true if SelectionRecommendationsLastUpdated is set.
     */
    public function isSetSelectionRecommendationsLastUpdated()
	{
	            return !is_null($this->_fields['SelectionRecommendationsLastUpdated']['FieldValue']);
		    }

    /**
     * Set the value of SelectionRecommendationsLastUpdated, return this.
     *
     * @param selectionRecommendationsLastUpdated
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSelectionRecommendationsLastUpdated($value)
	{
        $this->setSelectionRecommendationsLastUpdated($value);
        return $this;
    }

    /**
     * Get the value of the FulfillmentRecommendationsLastUpdated property.
     *
     * @return XMLGregorianCalendar FulfillmentRecommendationsLastUpdated.
     */
    public function getFulfillmentRecommendationsLastUpdated()
	{
	    return $this->_fields['FulfillmentRecommendationsLastUpdated']['FieldValue'];
    }

    /**
     * Set the value of the FulfillmentRecommendationsLastUpdated property.
     *
     * @param string fulfillmentRecommendationsLastUpdated
     * @return this instance
     */
    public function setFulfillmentRecommendationsLastUpdated($value)
	{
	    $this->_fields['FulfillmentRecommendationsLastUpdated']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if FulfillmentRecommendationsLastUpdated is set.
     *
     * @return true if FulfillmentRecommendationsLastUpdated is set.
     */
    public function isSetFulfillmentRecommendationsLastUpdated()
	{
	            return !is_null($this->_fields['FulfillmentRecommendationsLastUpdated']['FieldValue']);
		    }

    /**
     * Set the value of FulfillmentRecommendationsLastUpdated, return this.
     *
     * @param fulfillmentRecommendationsLastUpdated
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withFulfillmentRecommendationsLastUpdated($value)
	{
        $this->setFulfillmentRecommendationsLastUpdated($value);
        return $this;
    }

    /**
     * Get the value of the PricingRecommendationsLastUpdated property.
     *
     * @return XMLGregorianCalendar PricingRecommendationsLastUpdated.
     */
    public function getPricingRecommendationsLastUpdated()
	{
	    return $this->_fields['PricingRecommendationsLastUpdated']['FieldValue'];
    }

    /**
     * Set the value of the PricingRecommendationsLastUpdated property.
     *
     * @param string pricingRecommendationsLastUpdated
     * @return this instance
     */
    public function setPricingRecommendationsLastUpdated($value)
	{
	    $this->_fields['PricingRecommendationsLastUpdated']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PricingRecommendationsLastUpdated is set.
     *
     * @return true if PricingRecommendationsLastUpdated is set.
     */
    public function isSetPricingRecommendationsLastUpdated()
	{
	            return !is_null($this->_fields['PricingRecommendationsLastUpdated']['FieldValue']);
		    }

    /**
     * Set the value of PricingRecommendationsLastUpdated, return this.
     *
     * @param pricingRecommendationsLastUpdated
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPricingRecommendationsLastUpdated($value)
	{
        $this->setPricingRecommendationsLastUpdated($value);
        return $this;
    }

}
