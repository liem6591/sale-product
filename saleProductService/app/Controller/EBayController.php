<?php   
App :: import('Vendor', 'Ebay');

class EBayController extends AppController   
{   
	public $helpers = array('Html', 'Form');//,'Ajax','Javascript
	var $uses = array('User');
	
	/**
	 * 固定价格产品操作：
	 * AddFixedPriceItem 用于添加固定价格的产品到ebay，类似于淘宝一口价
	 * ReviseFixedPriceItem 用于更新固定价格产品的属性，如title，price，库存等，适用于multi-variation产品
	 * ReviseInventoryStatus， 只能改变固定价格产品的price和库存
	 * EndFixedPriceItem  清除产品
	 */
	function doFixedPriceItem(){
		
	}
	
	/**
	 * 可变价格产品
	 * AddItem 用于添加可变价格产品，类似于淘宝上的拍卖价
	 * ReviseItem 更新可变价格产品的属性，如title，price，库存等
	 * EndItem 
	 */
	function doItem(){
		$USA_SITE_ID = 1 ;
		
		$ebayParams = array(
				'appMode'=>1,
				'siteId'=>$USA_SITE_ID,
				'devId'=>'5e786b61-b476-44f6-be61-06b4320f1b08',
				'appId'=>'kuyunf80d-710a-4334-9b33-b5ecc9f18ea',
				'certId'=>'1409fdee-376b-402a-8a9a-dfd74cb0e0ce',
				'token'=>'AgAAAA**AQAAAA**aAAAAA**H7jPUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpWLoAqdj6x9nY+seQ**bJEBAA**AAMAAA**BPt9l7YvR5SqozBme/6oD66cSG4G/8mCFi0pkIS/Yy7MrMvjImLA28t5cIpB403pQDVc7vNJ7T6sdUpky/AJURw86ooTqKIevcBe7pvlqQl6GbWdfC+fwMGreCJ2YN81fqZefXr+exlJAnlITbyJspi8rWMCM3WYF1x+VVSm9VaIfcXG3Z/qNBC7cSjckeZm9KDsmsqjIZ/8PXNeYBEwfCjLkzvXYgMMlvHtrWJsuPCaNmIVbi+HUBuxq+BIdCukYX/20aHRpdWg9r82m9GeEsZ0V6wiJa6P6U7nccFRbj1dzrVljYrkyK1kIv//BCOKpw3Hd9/YF1TSomlGRt4WbVxYPVErTnzuN3nIpmPxX4kkgFZIMhi2orXvHGVEsfZBpN8uejMrspbPuIzpOr4hUkZmvmiJsvCQNKFaiaEJgk6SffO5jmltqp/x+3KRXxrOnPiBZCKdHYyn1fgtsIXPOqSx6SfWp5q8M0otD20YvQsw01WnFG4kSR61cWy2fUSL2B6RRXONKZeyBXi+ILljpTiBJntTzPfp1VspB31JewvY3lE6x+ZDAV4PEGTKzMoCkkGVy9b/CjNNHle/VcWx87D75vMylJCucB12HDD6Ks1/L/TKe/Oktciq+590Vpx/M5TslDl67MtWGiDnLw/+2XRyH1dDWOSh/+2C1ZMLSIqs3crAu0+tlzjf/EDP507LtRy8cWOiLCyyck6nV5pBv24PpXbscyGAkVU5W8oEtl4OIVhtQmcimTv2v3eW2vco'
		) ;
		
		$ebay = new Ebay( $ebayParams ) ;
		$ebay->addItem( array
				(
					'Title' => 'iPod',
					'Quantity' => '1',
					'Currency' => 'USD',
					'Country' => 'AT',
					'StartPrice' => '5.00',
					'ListingDuration' => 'Days_7',
					'Location' => 'Cologne',
					'PaymentMethods' => 'PayPal',
					'ListingType' => 'Chinese',
					'Description' => 'Enter Description Here',
					'CategoryID' => '31448',
				) ) ;
	}
	
	/**
	 * 批量产品变价
	 * EndItems
	 */
	function doItems(){
	
	}
	
	function addItemProduct(){
		$this->login() ;
	}
} 