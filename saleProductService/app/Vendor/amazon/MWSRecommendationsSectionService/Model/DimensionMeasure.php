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
 * MWSRecommendationsSectionService_Model_DimensionMeasure
 * 
 * Properties:
 * <ul>
 * 
 * <li>Value: float</li>
 * <li>Unit: string</li>
 *
 * </ul>
 */

 class MWSRecommendationsSectionService_Model_DimensionMeasure extends MWSRecommendationsSectionService_Model {

    public function __construct($data = null)
    {
        $this->_fields = array (
            'Value' => array('FieldValue' => null, 'FieldType' => 'float'),
            'Unit' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
	    parent::__construct($data);
    }

    /**
     * Get the value of the Value property.
     *
     * @return BigDecimal Value.
     */
    public function getValue()
	{
	    return $this->_fields['Value']['FieldValue'];
    }

    /**
     * Set the value of the Value property.
     *
     * @param float value
     * @return this instance
     */
    public function setValue($value)
	{
	    $this->_fields['Value']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Value is set.
     *
     * @return true if Value is set.
     */
    public function isSetValue()
	{
	            return !is_null($this->_fields['Value']['FieldValue']);
		    }

    /**
     * Set the value of Value, return this.
     *
     * @param value
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withValue($value)
	{
        $this->setValue($value);
        return $this;
    }

    /**
     * Get the value of the Unit property.
     *
     * @return String Unit.
     */
    public function getUnit()
	{
	    return $this->_fields['Unit']['FieldValue'];
    }

    /**
     * Set the value of the Unit property.
     *
     * @param string unit
     * @return this instance
     */
    public function setUnit($value)
	{
	    $this->_fields['Unit']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Unit is set.
     *
     * @return true if Unit is set.
     */
    public function isSetUnit()
	{
	            return !is_null($this->_fields['Unit']['FieldValue']);
		    }

    /**
     * Set the value of Unit, return this.
     *
     * @param unit
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withUnit($value)
	{
        $this->setUnit($value);
        return $this;
    }

}
