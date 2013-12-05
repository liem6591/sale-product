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
 * List Recommendations By Next Token Sample
 */

require_once('.config.inc.php');

/************************************************************************
 * Instantiate Implementation of MWSRecommendationsSectionService
 * 
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
// More endpoints are listed in the MWS Developer Guide
// North America:
//$serviceUrl = "https://mws.amazonservices.com/Recommendations/2013-04-01";
// Europe
//$serviceUrl = "https://mws-eu.amazonservices.com/Recommendations/2013-04-01";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp/Recommendations/2013-04-01";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn/Recommendations/2013-04-01";


 $config = array (
   'ServiceURL' => $serviceUrl,
   'ProxyHost' => null,
   'ProxyPort' => -1,
   'MaxErrorRetry' => 3,
 );

 $service = new MWSRecommendationsSectionService_Client(
        AWS_ACCESS_KEY_ID,
        AWS_SECRET_ACCESS_KEY,
        APPLICATION_NAME,
        APPLICATION_VERSION,
        $config);
 
 
 
/************************************************************************
 * Uncomment to try out Mock Service that simulates MWSRecommendationsSectionService
 * responses without calling MWSRecommendationsSectionService service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MWSRecommendationsSectionService/Mock tree
 *
 ***********************************************************************/
 // $service = new MWSRecommendationsSectionService_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for List Recommendations By Next Token Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken
 $request = new MWSRecommendationsSectionService_Model_ListRecommendationsByNextTokenRequest();
 $request->setSellerId(MERCHANT_ID);
 // object or array of parameters
 invokeListRecommendationsByNextToken($service, $request);

                                                    
/**
  * Get List Recommendations By Next Token Action Sample
  * Gets competitive pricing and related information for a product identified by
  * the MarketplaceId and ASIN.
  *   
  * @param MWSRecommendationsSectionService_Interface $service instance of MWSRecommendationsSectionService_Interface
  * @param mixed $request MWSRecommendationsSectionService_Model_ListRecommendationsByNextToken or array of parameters
  */

  function invokeListRecommendationsByNextToken(MWSRecommendationsSectionService_Interface $service, $request) 
  {
      try {
        $response = $service->ListRecommendationsByNextToken($request);

        echo ("Service Response\n");
        echo ("=============================================================================\n");

        $dom = new DOMDocument();
        $dom->loadXML($response->toXML());
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        echo $dom->saveXML();
        echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");

     } catch (MWSRecommendationsSectionService_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
     }
 }
                    
