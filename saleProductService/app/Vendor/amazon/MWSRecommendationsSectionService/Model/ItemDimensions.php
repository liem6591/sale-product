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
 * MWSRecommendationsSectionService_Model_ItemDimensions
 * 
 * Properties:
 * <ul>
 * 
 * <li>Height: MWSRecommendationsSectionService_Model_DimensionMeasure</li>
 * <li>Width: MWSRecommendationsSectionService_Model_DimensionMeasure</li>
 * <li>Length: MWSRecommendationsSectionService_Model_DimensionMeasure</li>
 * <li>Weight: MWSRecommendationsSectionService_Model_WeightMeasure</li>
 *
 * </ul>
 */

 class MWSRecommendationsSectionService_Model_ItemDimensions extends MWSRecommendationsSectionService_Model {

    public function __construct($data = null)
    {
        $this->_fields = array (
            'Height' => array('FieldValue' => null, 'FieldType' => 'MWSRecommendationsSectionService_Model_DimensionMeasure'),
            'Width' => array('FieldValue' => null, 'FieldType' => 'MWSRecommendationsSectionService_Model_DimensionMeasure'),
            'Length' => array('FieldValue' => null, 'FieldType' => 'MWSRecommendationsSectionService_Model_DimensionMeasure'),
            'Weight' => array('FieldValue' => null, 'FieldType' => 'MWSRecommendationsSectionService_Model_WeightMeasure'),
        );
	    parent::__construct($data);
    }

    /**
     * Get the value of the Height property.
     *
     * @return DimensionMeasure Height.
     */
    public function getHeight()
	{
	    return $this->_fields['Height']['FieldValue'];
    }

    /**
     * Set the value of the Height property.
     *
     * @param MWSRecommendationsSectionService_Model_DimensionMeasure height
     * @return this instance
     */
    public function setHeight($value)
	{
	    $this->_fields['Height']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Height is set.
     *
     * @return true if Height is set.
     */
    public function isSetHeight()
	{
	            return !is_null($this->_fields['Height']['FieldValue']);
		    }

    /**
     * Set the value of Height, return this.
     *
     * @param height
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withHeight($value)
	{
        $this->setHeight($value);
        return $this;
    }

    /**
     * Get the value of the Width property.
     *
     * @return DimensionMeasure Width.
     */
    public function getWidth()
	{
	    return $this->_fields['Width']['FieldValue'];
    }

    /**
     * Set the value of the Width property.
     *
     * @param MWSRecommendationsSectionService_Model_DimensionMeasure width
     * @return this instance
     */
    public function setWidth($value)
	{
	    $this->_fields['Width']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Width is set.
     *
     * @return true if Width is set.
     */
    public function isSetWidth()
	{
	            return !is_null($this->_fields['Width']['FieldValue']);
		    }

    /**
     * Set the value of Width, return this.
     *
     * @param width
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withWidth($value)
	{
        $this->setWidth($value);
        return $this;
    }

    /**
     * Get the value of the Length property.
     *
     * @return DimensionMeasure Length.
     */
    public function getLength()
	{
	    return $this->_fields['Length']['FieldValue'];
    }

    /**
     * Set the value of the Length property.
     *
     * @param MWSRecommendationsSectionService_Model_DimensionMeasure length
     * @return this instance
     */
    public function setLength($value)
	{
	    $this->_fields['Length']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Length is set.
     *
     * @return true if Length is set.
     */
    public function isSetLength()
	{
	            return !is_null($this->_fields['Length']['FieldValue']);
		    }

    /**
     * Set the value of Length, return this.
     *
     * @param length
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withLength($value)
	{
        $this->setLength($value);
        return $this;
    }

    /**
     * Get the value of the Weight property.
     *
     * @return WeightMeasure Weight.
     */
    public function getWeight()
	{
	    return $this->_fields['Weight']['FieldValue'];
    }

    /**
     * Set the value of the Weight property.
     *
     * @param MWSRecommendationsSectionService_Model_WeightMeasure weight
     * @return this instance
     */
    public function setWeight($value)
	{
	    $this->_fields['Weight']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Weight is set.
     *
     * @return true if Weight is set.
     */
    public function isSetWeight()
	{
	            return !is_null($this->_fields['Weight']['FieldValue']);
		    }

    /**
     * Set the value of Weight, return this.
     *
     * @param weight
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withWeight($value)
	{
        $this->setWeight($value);
        return $this;
    }

}
