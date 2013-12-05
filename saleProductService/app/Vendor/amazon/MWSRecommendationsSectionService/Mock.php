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
 *  @see MWSRecommendationsSectionService_Interface
 */
require_once (dirname(__FILE__) . '/Interface.php'); 

class MWSRecommendationsSectionService_Mock implements MWSRecommendationsSectionService_Interface
{
    // Public API ------------------------------------------------------------//


    /**
     * Get Last Updated Time For Recommendations
     * Retrieving last updated time for all recommendation categories for the given marketplace and seller. 
     *       If last updated time for a category is null, it indicates no active recommendations for this seller in the given marketplace for this category.
     *   
     * @see http://docs.amazonwebservices.com/${docPath}GetLastUpdatedTimeForRecommendations.html      
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendations request or MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendations object itself
     * @see MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendations
     * @return MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function getLastUpdatedTimeForRecommendations($request)
    {
        require_once (dirname(__FILE__) . '/Model/GetLastUpdatedTimeForRecommendationsResponse.php');
        return MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsResponse::fromXML($this->_invoke('GetLastUpdatedTimeForRecommendations'));
    }


    /**
     * List Recommendations
     * Retrieving first batch of recommendations.
     *   
     * @see http://docs.amazonwebservices.com/${docPath}ListRecommendations.html      
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_ListRecommendations request or MWSRecommendationsSectionService_Model_ListRecommendations object itself
     * @see MWSRecommendationsSectionService_Model_ListRecommendations
     * @return MWSRecommendationsSectionService_Model_ListRecommendationsResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function listRecommendations($request)
    {
        require_once (dirname(__FILE__) . '/Model/ListRecommendationsResponse.php');
        return MWSRecommendationsSectionService_Model_ListRecommendationsResponse::fromXML($this->_invoke('ListRecommendations'));
    }


    /**
     * List Recommendations By Next Token
     * Retrieving recommendation by next token.
     *   
     * @see http://docs.amazonwebservices.com/${docPath}ListRecommendationsByNextToken.html      
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken request or MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken object itself
     * @see MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken
     * @return MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function listRecommendationsByNextToken($request)
    {
        require_once (dirname(__FILE__) . '/Model/ListRecommendationsByNextTokenResponse.php');
        return MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenResponse::fromXML($this->_invoke('ListRecommendationsByNextToken'));
    }

    // Private API ------------------------------------------------------------//

    private function _invoke($actionName)
    {
        return $xml = file_get_contents(dirname(__FILE__) . '/Mock/' . $actionName . 'Response.xml', /** search include path */ TRUE);
    }
}
