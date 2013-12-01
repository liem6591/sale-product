<?php
class EbayModel extends AppModel {
	var $useTable = "sc_product_cost" ;
	
	public function saveOrders( $result ){
	
		$t = str_replace("soapenv:Envelope", "soapenvEnvelope", $result) ;
		$t = str_replace("soapenv:Body", "soapenvBody", $t) ;
		
		$xml = new  SimpleXMLElement($t);

		//saveOrder Here
		debug( $xml ) ;
		
	}
	
	public function saveMessages($result,$accountId){
		
		$t = str_replace("soapenv:Envelope", "soapenvEnvelope", $result) ;
		$t = str_replace("soapenv:Body", "soapenvBody", $t) ;
		$xml = new  SimpleXMLElement($t);
		
		$messages = $xml->soapenvBody->GetMyMessagesResponse->Messages ;
		$objectVars = get_object_vars($messages);
		
		$temp = $objectVars ;
		if( is_array($objectVars['Message']) ){
			$temp = $objectVars['Message'] ;
		}
		
		foreach($temp as $message  ){
			$message = get_object_vars($message);
			$message['ResponseEnabled'] = (string)$message['ResponseDetails']->ResponseEnabled ;
			$message['FolderID'] = (string)$message['Folder']->FolderID  ;
			$message['guid'] = $this->create_guid() ;
			$message['accountId'] = $accountId ;
			
			if(empty($message['MessageID'])) continue ;
			
			$m = $this->getObject("sql_ebay_message_getByMessageId", $message) ;
			if(empty($m)){
				$this->exeSql("sql_ebay_message_insert", $message) ;
			}else{
				$this->exeSql("sql_ebay_message_update", $message) ;
			}
		} 
		
	}
	
	public function saveMessagesForText($result,$accountId){
	
		//echo $result ;
	
		$t = str_replace("soapenv:Envelope", "soapenvEnvelope", $result) ;
		$t = str_replace("soapenv:Body", "soapenvBody", $t) ;
		$xml = new  SimpleXMLElement($t);
	
		$messages = $xml->soapenvBody->GetMyMessagesResponse->Messages ;
		$objectVars = get_object_vars($messages);
		
		$temp = $objectVars ;
		if( is_array($objectVars['Message']) ){
			$temp = $objectVars['Message'] ;
		}
		
		foreach($temp as $message  ){
			$message = get_object_vars($message);
			$message['ResponseEnabled'] = (string)$message['ResponseDetails']->ResponseEnabled ;
			$message['FolderID'] = (string)$message['Folder']->FolderID  ;
			$message['guid'] = $this->create_guid() ;
			$message['accountId'] = $accountId ;
			
			if(empty($message['MessageID'])) continue ;

			$m = $this->getObject("sql_ebay_message_getByMessageId", $message) ;
			if(empty($m)){
				$this->exeSql("sql_ebay_message_insert", $message) ;
			}else{
				$this->exeSql("sql_ebay_message_update", $message) ;
			}
		}
	
	}
	
	public function getMessageIdsNoText($accountId){
		$array = $this->exeSqlWithFormat("sql_ebay_message_getMessageIdNoText", array("accountId"=>$accountId)) ;
		if(empty($array) || sizeof($array) == 0 ) return null ;
		
		$r = array() ;
		foreach ($array as $a){
			$r[] = $a['MessageID'] ;
		}
		return $r ;
	}
	
	public function getMessagesNoReadAndNoFlagged($accountId){
		$sql = "SELECT MessageID FROM sc_ebay_message WHERE local_flagged = 'true' AND local_sread='true' AND flagged = 'false' AND sread = 'false'
						AND accountId ='{@#accountId#}'" ;
		return $this->exeSqlWithFormat($sql, array('accountId'=>$accountId)) ;
	}
	
	public function getMessagesNoRead($accountId){
		$sql = "SELECT MessageID FROM sc_ebay_message WHERE  local_sread='true'  AND sread = 'false'
		AND accountId ='{@#accountId#}'" ;
		return $this->exeSqlWithFormat($sql, array('accountId'=>$accountId)) ;
	}
	
	public function getMessagesNoFlagged($accountId){
		$sql = "SELECT MessageID FROM sc_ebay_message WHERE local_flagged = 'true'  AND flagged = 'false'  
		AND accountId ='{@#accountId#}'" ;
		return $this->exeSqlWithFormat($sql, array('accountId'=>$accountId)) ;
	}
	
	public function getMessagesNoResponse($accountId){
		$sql = "SELECT * FROM sc_ebay_message WHERE ResponseEnabled = 'true'   AND Replied='false' 
				and local_Replied = 'true' 
				AND accountId ='{@#accountId#}'" ;
		return $this->exeSqlWithFormat($sql, array('accountId'=>$accountId)) ;
	}

}