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

interface  MWSRecommendationsSectionService_Interface
{

    /**
     * Get Last Updated Time For Recommendations
     * Retrieving last updated time for all recommendation categories for the given marketplace and seller. 
     *       If last updated time for a category is null, it indicates no active recommendations for this seller in the given marketplace for this category.
     *
     * @see http://docs.amazonwebservices.com/${docPath}GetLastUpdatedTimeForRecommendations.html
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendations request or MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendations object itself
     * @see MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsRequest
     * @return MWSRecommendationsSectionService_Model_GetLastUpdatedTimeForRecommendationsResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function getLastUpdatedTimeForRecommendations($request);


    /**
     * List Recommendations
     * Retrieving first batch of recommendations.
     *
     * @see http://docs.amazonwebservices.com/${docPath}ListRecommendations.html
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_ListRecommendations request or MWSRecommendationsSectionService_Model_ListRecommendations object itself
     * @see MWSRecommendationsSectionService_Model_ListRecommendationsRequest
     * @return MWSRecommendationsSectionService_Model_ListRecommendationsResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function listRecommendations($request);


    /**
     * List Recommendations By Next Token
     * Retrieving recommendation by next token.
     *
     * @see http://docs.amazonwebservices.com/${docPath}ListRecommendationsByNextToken.html
     * @param mixed $request array of parameters for MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken request or MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken object itself
     * @see MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenRequest
     * @return MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenResponse
     *
     * @throws MWSRecommendationsSectionService_Exception
     */
    public function listRecommendationsByNextToken($request);

}