<?php
/*******************************************************************************
 * Copyright 2009-2013 Amazon Services. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License"); 
 *
 * You may not use this file except in compliance with the License. 
 * You may obtain a copy of the License at: http://aws.amazon.com/apache2.0
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR 
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the 
 * specific language governing permissions and limitations under the License.
 *******************************************************************************
 * PHP Version 5
 * @category Amazon
 * @package  FBA Inbound Service MWS
 * @version  2010-10-01
 * Library Version: 2013-11-01
 * Generated: Fri Nov 08 22:05:01 GMT 2013
 */

/**
 *  @see FBAInboundServiceMWS_Model
 */

require_once (VENDOR_PATH.'/amazon/FBAInboundServiceMWS/Model.php');


/**
 * FBAInboundServiceMWS_Model_GetPackageLabelsRequest
 * 
 * Properties:
 * <ul>
 * 
 * <li>SellerId: string</li>
 * <li>ShipmentId: string</li>
 * <li>PageType: string</li>
 * <li>NumberOfPackages: int</li>
 *
 * </ul>
 */

 class FBAInboundServiceMWS_Model_GetPackageLabelsRequest extends FBAInboundServiceMWS_Model {

    public function __construct($data = null)
    {
    $this->_fields = array (
'SellerId' => array('FieldValue' => null, 'FieldType' => 'string'),
'ShipmentId' => array('FieldValue' => null, 'FieldType' => 'string'),
'PageType' => array('FieldValue' => null, 'FieldType' => 'string'),
'NumberOfPackages' => array('FieldValue' => null, 'FieldType' => 'int'),
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
     * Get the value of the ShipmentId property.
     *
     * @return String ShipmentId.
     */
    public function getShipmentId()
    {
        return $this->_fields['ShipmentId']['FieldValue'];
    }

    /**
     * Set the value of the ShipmentId property.
     *
     * @param string shipmentId
     * @return this instance
     */
    public function setShipmentId($value)
    {
        $this->_fields['ShipmentId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ShipmentId is set.
     *
     * @return true if ShipmentId is set.
     */
    public function isSetShipmentId()
    {
                return !is_null($this->_fields['ShipmentId']['FieldValue']);
            }

    /**
     * Set the value of ShipmentId, return this.
     *
     * @param shipmentId
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withShipmentId($value)
    {
        $this->setShipmentId($value);
        return $this;
    }

    /**
     * Get the value of the PageType property.
     *
     * @return String PageType.
     */
    public function getPageType()
    {
        return $this->_fields['PageType']['FieldValue'];
    }

    /**
     * Set the value of the PageType property.
     *
     * @param string pageType
     * @return this instance
     */
    public function setPageType($value)
    {
        $this->_fields['PageType']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PageType is set.
     *
     * @return true if PageType is set.
     */
    public function isSetPageType()
    {
                return !is_null($this->_fields['PageType']['FieldValue']);
            }

    /**
     * Set the value of PageType, return this.
     *
     * @param pageType
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPageType($value)
    {
        $this->setPageType($value);
        return $this;
    }

    /**
     * Get the value of the NumberOfPackages property.
     *
     * @return Integer NumberOfPackages.
     */
    public function getNumberOfPackages()
    {
        return $this->_fields['NumberOfPackages']['FieldValue'];
    }

    /**
     * Set the value of the NumberOfPackages property.
     *
     * @param int numberOfPackages
     * @return this instance
     */
    public function setNumberOfPackages($value)
    {
        $this->_fields['NumberOfPackages']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if NumberOfPackages is set.
     *
     * @return true if NumberOfPackages is set.
     */
    public function isSetNumberOfPackages()
    {
                return !is_null($this->_fields['NumberOfPackages']['FieldValue']);
            }

    /**
     * Set the value of NumberOfPackages, return this.
     *
     * @param numberOfPackages
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withNumberOfPackages($value)
    {
        $this->setNumberOfPackages($value);
        return $this;
    }

}
