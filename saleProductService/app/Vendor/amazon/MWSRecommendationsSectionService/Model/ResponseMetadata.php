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
 * MWSRecommendationsSectionService_Model_ResponseMetadata
 * 
 * Properties:
 * <ul>
 * 
 * <li>RequestId: string</li>
 *
 * </ul>
 */

 class MWSRecommendationsSectionService_Model_ResponseMetadata extends MWSRecommendationsSectionService_Model {

    public function __construct($data = null)
    {
        $this->_fields = array (
            'RequestId' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
	    parent::__construct($data);
    }

    /**
     * Get the value of the RequestId property.
     *
     * @return String RequestId.
     */
    public function getRequestId()
	{
	    return $this->_fields['RequestId']['FieldValue'];
    }

    /**
     * Set the value of the RequestId property.
     *
     * @param string requestId
     * @return this instance
     */
    public function setRequestId($value)
	{
	    $this->_fields['RequestId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if RequestId is set.
     *
     * @return true if RequestId is set.
     */
    public function isSetRequestId()
	{
	            return !is_null($this->_fields['RequestId']['FieldValue']);
		    }

    /**
     * Set the value of RequestId, return this.
     *
     * @param requestId
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withRequestId($value)
	{
        $this->setRequestId($value);
        return $this;
    }

}
