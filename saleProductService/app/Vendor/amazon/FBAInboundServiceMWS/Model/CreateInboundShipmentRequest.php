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
 * FBAInboundServiceMWS_Model_CreateInboundShipmentRequest
 * 
 * Properties:
 * <ul>
 * 
 * <li>SellerId: string</li>
 * <li>Marketplace: string</li>
 * <li>ShipmentId: string</li>
 * <li>InboundShipmentHeader: FBAInboundServiceMWS_Model_InboundShipmentHeader</li>
 * <li>InboundShipmentItems: FBAInboundServiceMWS_Model_InboundShipmentItemList</li>
 *
 * </ul>
 */

 class FBAInboundServiceMWS_Model_CreateInboundShipmentRequest extends FBAInboundServiceMWS_Model {

    public function __construct($data = null)
    {
    $this->_fields = array (
'SellerId' => array('FieldValue' => null, 'FieldType' => 'string'),
'Marketplace' => array('FieldValue' => null, 'FieldType' => 'string'),
'ShipmentId' => array('FieldValue' => null, 'FieldType' => 'string'),
'InboundShipmentHeader' => array('FieldValue' => null, 'FieldType' => 'FBAInboundServiceMWS_Model_InboundShipmentHeader'),
'InboundShipmentItems' => array('FieldValue' => null, 'FieldType' => 'FBAInboundServiceMWS_Model_InboundShipmentItemList'),
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
     * Get the value of the Marketplace property.
     *
     * @return String Marketplace.
     */
    public function getMarketplace()
    {
        return $this->_fields['Marketplace']['FieldValue'];
    }

    /**
     * Set the value of the Marketplace property.
     *
     * @param string marketplace
     * @return this instance
     */
    public function setMarketplace($value)
    {
        $this->_fields['Marketplace']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Marketplace is set.
     *
     * @return true if Marketplace is set.
     */
    public function isSetMarketplace()
    {
                return !is_null($this->_fields['Marketplace']['FieldValue']);
            }

    /**
     * Set the value of Marketplace, return this.
     *
     * @param marketplace
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withMarketplace($value)
    {
        $this->setMarketplace($value);
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
     * Get the value of the InboundShipmentHeader property.
     *
     * @return InboundShipmentHeader InboundShipmentHeader.
     */
    public function getInboundShipmentHeader()
    {
        return $this->_fields['InboundShipmentHeader']['FieldValue'];
    }

    /**
     * Set the value of the InboundShipmentHeader property.
     *
     * @param FBAInboundServiceMWS_Model_InboundShipmentHeader inboundShipmentHeader
     * @return this instance
     */
    public function setInboundShipmentHeader($value)
    {
        $this->_fields['InboundShipmentHeader']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if InboundShipmentHeader is set.
     *
     * @return true if InboundShipmentHeader is set.
     */
    public function isSetInboundShipmentHeader()
    {
                return !is_null($this->_fields['InboundShipmentHeader']['FieldValue']);
            }

    /**
     * Set the value of InboundShipmentHeader, return this.
     *
     * @param inboundShipmentHeader
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withInboundShipmentHeader($value)
    {
        $this->setInboundShipmentHeader($value);
        return $this;
    }

    /**
     * Get the value of the InboundShipmentItems property.
     *
     * @return InboundShipmentItemList InboundShipmentItems.
     */
    public function getInboundShipmentItems()
    {
        return $this->_fields['InboundShipmentItems']['FieldValue'];
    }

    /**
     * Set the value of the InboundShipmentItems property.
     *
     * @param FBAInboundServiceMWS_Model_InboundShipmentItemList inboundShipmentItems
     * @return this instance
     */
    public function setInboundShipmentItems($value)
    {
        $this->_fields['InboundShipmentItems']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if InboundShipmentItems is set.
     *
     * @return true if InboundShipmentItems is set.
     */
    public function isSetInboundShipmentItems()
    {
                return !is_null($this->_fields['InboundShipmentItems']['FieldValue']);
            }

    /**
     * Set the value of InboundShipmentItems, return this.
     *
     * @param inboundShipmentItems
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withInboundShipmentItems($value)
    {
        $this->setInboundShipmentItems($value);
        return $this;
    }

}
