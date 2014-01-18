<?php
ignore_user_abort(1);
set_time_limit(0);

ini_set("memory_limit", "62M");
ini_set("post_max_size", "24M");

App :: import('Vendor', 'Snoopy');
App :: import('Vendor', 'simple_html_dom');
App :: import('Vendor', 'Amazon');

class FbaTaskController extends AppController {
	
	public $helpers = array (
		'Html',
		'Form'
	); //,'Ajax','Javascript
	
	var $uses = array('Amazonaccount','Warning','Log','OrderService');
	
	
	////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 获取费用接口
	 * _GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_
	 * 
	 * @see FeedReportController::getFeedSubmissionResult()
	 */
	public function getFee($accountId){
		$reportType = "_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_" ;
		
		//获取数据库中
		$sql = "select * from sc_amazon_account_asyn where 
							account_id = '{@#accountId#}' and report_type='{@#reportType#}'  and ( status is null or  status != 'complete') " ;
		
		$reports = $this->Amazonaccount->exeSqlWithFormat($sql , array(
									'accountId'=>$accountId,
									"reportType"=>$reportType
								)) ;
		
		if( empty( $reports  ) ){
			$this->getFeedReport1($accountId, $reportType) ;
		}else{
			foreach( $reports as $report  ){
				$REPORT_ID 				= $report['REPORT_ID'] ;
				$REPORT_REQUEST_ID =  $report['REPORT_REQUEST_ID'] ;
				
				if( empty( $REPORT_ID ) ){
					$this->getFeedReport2($accountId, $reportType,$REPORT_ID) ;
				}else{
					$this->getFeedReport3($accountId, $REPORT_ID) ;
				}
			} 
		}
		
		$this->response->type("json") ;
		$this->response->body( "success")   ;
	
		return $this->response ;
	}
	
}