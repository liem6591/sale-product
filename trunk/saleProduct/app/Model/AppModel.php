<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
$sqlMaps = null ;
 
class AppModel extends Model {
		function _clearDBCache() {
		  	
		}
		
		function getValue($params , $key){
			if( isset($params[$key]) )
				return $params[$key] ;
			return null ;
		}
		
		function getMaxValue($type ,$belongTo = null , $defaultValue = null){
			if( $belongTo != null ){
				$sql = "select * from sc_index_gen where type = '$type' and belong_to= '$belongTo'" ;
				$result = $this->query($sql) ;
				if( !empty($result) ){
					return $result[0]['sc_index_gen']['INDEX'] ;
				}
			}
			
			$sql = "SELECT ( MAX(`index`)+1 ) AS C FROM sc_index_gen where type = '$type'" ;
			$result = $this->query($sql) ;
			$value = '' ;
			if( empty($result) ){
				$value = $defaultValue ;
			}else{
				$value= $result[0][0]['C'] ;
				if(empty($value)){
					$value = $defaultValue ;
				}
			}
			$sql = "insert into sc_index_gen(`index`,type,belong_to) values($value , '$type','$belongTo')" ;
			$this->query($sql) ;
			return $value ;
		}
		
		function endsWith($haystack, $needle){
		    $length = strlen($needle);
		    if ($length == 0) {
		        return true;
		    }
		
		    return (substr($haystack, -$length) === $needle);
		}
	
		function getScriptRecords($query=null) {
			$sql = 'SELECT * FROM sc_election_rule' ;
			$array = $this->query($sql);
			return $array ;
		}
		
		function formatSqlParams($param = null){
			if( $param == null || empty($param)  || $param == "") return $param ;
			
			return str_replace("'","‘",$param) ;
			
		}
		
		function getAgent($index){
			$agents = array() ;
			$agents[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.83 Safari/535.11" ;
			$agents[] = "(compatible; MSIE 4.01; MSN 2.5; AOL 4.0; Windows 98)" ;
			return $agents[ $index % 2 ]  ;		
		}
		//递归查询，向下
		function getRecursionWithMe($table,$idColName,$parentIdColName,$id){
			$result = $this->getChildRecursion($table,$idColName,$parentIdColName,$id) ;
			$sql = "select * from $table where $idColName = '$id' " ;
			$temp = $this->query($sql) ;
			if( count($temp) > 0 ){
				foreach($temp as $record){
					$record = $record[$table] ;
					$result[] = $record ;
				}
			}
			return $result ;
		}
		
		function getRecursion($table,$idColName,$parentIdColName,$id){
			$result = $this->getChildRecursion($table,$idColName,$parentIdColName,$id) ;
			return $result ;
		}
		
		function getChildRecursion($table,$idColName,$parentIdColName,$id){
			$array = array() ;
			$sql = "select * from $table where $parentIdColName = '$id' " ;
			$temp = $this->query($sql) ;
			if( count($temp) > 0 ){
				foreach($temp as $record){
					$record = $record[$table] ;
					$array[] = $record ;
					$_id = $record[$idColName] ;
					$temp1 = $this->getChildRecursion($table,$idColName,$parentIdColName,$_id) ;
					foreach($temp1 as $record1){
						$array[] = $record1 ;
					}
				}
			}
			return $array ;
		}
		
		//递归查询，向上
		function getRecursionUp($table,$idColName,$parentIdColName,$pid){
			$result = $this->getParentRecursion($table,$idColName,$parentIdColName,$pid) ;
			return $result ;
		}
		
		function getParentRecursion($table,$idColName,$parentIdColName,$pid){
			$array = array() ;
			$sql = "select * from $table where $idColName = '$pid' " ;
			$temp = $this->query($sql) ;
			if( count($temp) > 0 ){
				foreach($temp as $record){
					$record = $record[$table] ;
					$array[] = $record ;
					$_id = $record[$parentIdColName] ;
					$temp1 = $this->getParentRecursion($table,$idColName,$parentIdColName,$_id) ;
					foreach($temp1 as $record1){
						$array[] = $record1 ;
					}
				}
			}
			return $array ;
		}
		
		public function creatdir($path){
			if(!is_dir($path))
			{
				if($this->creatdir(dirname($path)))
				{
					mkdir($path,0777);
					return true;
				}
			}
			else
			{
				return true;
			}
		}
		
		public function getObject($sql , $query){
			$result = $this->exeSql($sql , $query) ;
			if(empty($result)){
				return null ;
			}
			
			$result = $result[0] ;
			$return = array() ;
			foreach($result as $items){
				foreach($items as $key=>$value){
					$return[$key] = $value ;
				}
			}
			
			return $return ;
		}
		
		public function formatObject($result){
			$return = array() ;
			foreach($result as $items){
				foreach($items as $key=>$value){
					$return[$key] = $value ;
				}
			}
			return $return ;
		}
		
		public function exeSql($sql , $query){
			$sql = $this->getDbSql($sql) ;
			$sql = $this->getSql($sql,$query) ;
		
			return $this->query($sql) ;
		}
		
		public function getExeSql($sql , $query){
			$sql = $this->getDbSql($sql) ;
			$sql = $this->getSql($sql,$query) ;
			return $sql ;
		}
		
		public function getSql($sql , $query){
			$domain =  $_SERVER['SERVER_NAME'] ;
			$query['domain'] = $domain ;
			
			$index = 0 ;
	    	$parseSql = "" ;
	    	$array = explode("{@",$sql);
	    	
	    	foreach( $array as $child ){
	    		if( $index==0 ){
	    			$parseSql .= $child ;
	    		}else{
	    			$childArray = explode("}",$child ) ;
	    			$i1 = 0 ;
	    			foreach($childArray as $t){
	    				if($i1 == 0){
	    					$cArray = explode("#",$t) ;
	    					$i2 =0 ;
	    					
	    					//解析字句
	    					$clause = "" ;
	    					$isTrue = false ;
	    					foreach($cArray as $c){
	    						if( $i2 > 0 && $i2 % 2 == 1 ){
	    							$key = trim($c) ;
	    							$defaultValue = '' ;
	    							$keyarray = explode(':',$key) ;

	    							$key = $keyarray[0] ;
	    							if( count($keyarray) >=2 ){
	    								$defaultValue = $keyarray[1] ;
	    							}
	    							
	    							if( isset($query[$key]) &&( $query[$key]=='0' || !empty($query[$key]) 
	    								|| !empty($defaultValue) || $defaultValue == '0' ) ){
	    								
	    								$kValue = $query[$key] ;
	    								//格式化$kValue,防止sql特殊字符
	    								$kValue = str_replace("'","\'",$kValue);
	    								if( $this->is_utf8($kValue) ){
	    									//
	    								}else{
	    									$kValue = utf8_encode($kValue) ;
	    								}
	    								if(empty($kValue)){
	    									$kValue = $defaultValue ;
	    								}

	    								$clause .=  $kValue ;
	    								$isTrue = true ;
	    							}else{
	    								$isTrue = false ;
	    								break ;
	    							}
	    						}else{
	    							$clause .= $c ;
	     						}
	     						$i2++ ;
	    					}
	    					if($isTrue)$parseSql .= $clause ;
	    				}else{
	    					$parseSql .= $t ;
	    				}
	    				$i1++ ;
	    			} ;
	    		}
	    		$index++ ;
	    	} 
	    	//echo $parseSql;
	    	
	    	return $parseSql ;
		}
		
		public function getDbSql($key){
	
			$sql = "select * from sc_sql where id = '$key'" ;
			$record = $this->query($sql) ;
			if(empty($record) || count($record)<=0){
				return $key ;
			}
			return $record[0]['sc_sql']['TEXT'] ;
		}
		
		function is_utf8($string) {  
		    // From http://w3.org/International/questions/qa-forms-utf-8.html      
		    return preg_match('%^(?:  
		        [\x09\x0A\x0D\x20-\x7E]              # ASCII  
		        | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte  
		        |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs  
		        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte   
		        |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates   
		        |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3   
		        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15  
		        |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16  
		    )*$%xs', $string);  
		}
}
