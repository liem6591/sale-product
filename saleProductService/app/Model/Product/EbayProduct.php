<?php 

class AmazonGatherImpl extends AppModel {
	var $useTable = "sc_product_cost" ;
	var $platformId = null ;
	
	protected $_session = null;
	protected $_cs = null;
	protected $_logger = null;
	protected $_basedir = '';
	
	public function __construct()
	{
		require_once 'ebay/EbatNs_1_0_679/EbatNs_ServiceProxy.php';
		require_once 'ebay/EbatNs_1_0_679/EbatNs_Logger.php';
		require_once 'ebay/EbatNs_1_0_679/AddFixedPriceItemRequestType.php';
		require_once 'ebay/EbatNs_1_0_679/AddFixedPriceItemResponseType.php';
	
		$this->_basedir = Mage::getBaseDir();
		$this->_session = new EbatNs_Session(Mage::getBaseDir().'yourpath/ebay.config.php');
		$this->_cs      = new EbatNs_ServiceProxy($this->_session);
		$this->_logger  = new EbatNs_Logger();
	}
	public function addEbayProduct($product_data){//$product_data是从db里取得数据，比如产品title，只需在db里更改就可以了
	
		$req = new AddFixedPriceItemRequestType();
		$item = new ItemType();
	
		$item->SKU = $product_data['customlabel'];// 产品编号
		$item->Country = 'US';//国家
		$item->AutoPay = true;//paypal支付的话，如果你不想有损失，就老老实实设为true
		$item->Description = trim($product_data['*description']);//描述,不能有ebay规定的敏感字符
		$item->ListingDuration = $product_data['*duration'];
		$item->Title = $product_data['title'];//需少于80字符,不能有ebay规定的敏感字符
		$item->Currency = 'USD';//币种
		$item->ListingType = 'FixedPriceItem';//固定价格产品
		$item->SubTitle = $product_data['subtitle'];
		$item->StartPrice = $product_data['*startprice'];
		$item->ConditionID = $product_data['conditionid'];
		$item->Quantity = round($product_data['*quantity']) ;
		$item->Location = $product_data['*location'];//卖家邮编
	
		$item->DispatchTimeMax = $product_data['*dipatch_time_max'];//最大耗费时间
		$item->PaymentMethods = 'PayPal';//支付方式
		$item->PayPalEmailAddress = $product_data['paypal_email_address'];//paypal账号
	
		$pdts  = new PictureDetailsType();//产品图片部分
		$pdts->GalleryType = $product_data['gallery_type'];
		if(preg_match('/https/',$product_data['picurl']))
			$product_data['picurl'] = str_replace('https','http',$product_data['picurl']);
		$pdts->PictureURL = $product_data['picurl'];
		$item->PictureDetails = $pdts;
	
		$item->PrimaryCategory = new CategoryType();
		$item->PrimaryCategory->CategoryID = $product_data['category'];//分类id
		$item->Site = 'US';
	
		$sdt  = new ShippingDetailsType();
		$ssot = new ShippingServiceOptionsType();
		$issot = new InternationalShippingServiceOptionsType();
		$stt  = new SalesTaxType();
	
		$sdt->ShippingType = 'Flat';
		$sdt->PromotionalShippingDiscount = $product_data['promotional_shipping_discount'];
		$sdt->InternationalPromotionalShippingDiscount = $product_data['intl_promotional_shipping_discount'];
		$sdt->ShippingDiscountProfileID = $product_data['shipping_discount_profile_id'];
		$sdt->InternationalShippingDiscountProfileID = $product_data['intl_shipping_discount_profile_id'];
		$stt->SalesTaxState = $product_data['SalesTaxState'];
		$stt->SalesTaxPercent = $product_data['SalesTaxPercent'];
		$sdt->SalesTax = $stt;
	
		//第一种shipping设置
		$ssot->ShippingServicePriority = round($product_data['shipping1_priority']);
		$ssot->ShippingService = $product_data['shipping1_option'];
		$ssot->ShippingServiceCost = $product_data['shipping1_cost'];
		$sdt->ShippingServiceOptions[] = $ssot ;
	
		//第二种shipping设置，还可以有更多种
		$ssot2 = new ShippingServiceOptionsType();
		$ssot2->ShippingServicePriority = round($product_data['shipping2_priority']);
		$ssot2->ShippingService = $product_data['shipping2_option'];
		$ssot2->ShippingServiceCost = $product_data['shipping2_cost'];
		$sdt->ShippingServiceOptions[] = $ssot2 ;
	
		//第一种国际的shipping设置，主要针对美国以外的国家
		$issot->ShippingServicePriority = round($product_data['intlshipping1_priority']);
		$issot->ShippingService = $product_data['intlshipping1_option'];
		$issot->ShippingServiceCost = $product_data['intlshipping1_cost'];
		$issot->ShippingServiceAdditionalCost = $product_data['intlshipping1_addition'];
		$issot->ShipToLocation = $product_data['intlshipping1_location'];
		$sdt->InternationalShippingServiceOption[] = $issot ;
	
		//第二种国际的shipping设置，还可以有更多种
		$issot2 = new InternationalShippingServiceOptionsType();
		$issot2->ShippingServicePriority = round($product_data['intlshipping2_priority']);
		$issot2->ShippingService = $product_data['intlshipping2_option'];
		$issot2->ShippingServiceCost = $product_data['intlshipping2_cost'];
		$issot2->ShippingServiceAdditionalCost = $product_data['intlshipping2_addition'];
		$issot2->ShipToLocation = $product_data['intlshipping2_location'];
		$sdt->InternationalShippingServiceOption[] = $issot2 ;
	
		$item->ShippingDetails = $sdt;
	
		//退换货设置
		$rpt  = new ReturnPolicyType();
		$rpt->ReturnsAcceptedOption = $product_data['*return_accepted_option'];//如ReturnsAccepted 表示接受退换货
		$rpt->RefundOption = $product_data['refund_option'];//如MoneyBack 以现金方式返还
		$rpt->ReturnsWithinOption = $product_data['returns_with_option'];//如Days_30 30天内有效
		$rpt->Description = $product_data['additional_details'];//一些备注
		$rpt->ShippingCostPaidByOption = $product_data['shipping_cost_paid_by'];//如Buyer 购买者承担退货运费
		$item->ReturnPolicy = $rpt;
	
		$lcrpt = new ListingCheckoutRedirectPreferenceType();
		$lcrpt->SellerThirdPartyUsername = $product_data['seller_third_party_username'];
		$item->ListingCheckoutRedirectPreference = $lcrpt;
	
		$item->ShipToLocations = $product_data['ShipToLocations'];//如Worldwide，可送往世界各国
	
		//一些产品属性，如适合对象：男士，质地：棉  等等
		$nvlat_si = new NameValueListArrayType();
		$specific = unserialize($product_data['specific']);
		foreach ($specific as $k=>$v){
			$nvlt_si  = new NameValueListType();
			$nvlt_si->Name = $k;
			$nvlt_si->setValue($v);
			$nvlat_si->NameValueList[] = $nvlt_si;
		}
		$item->ItemSpecifics = $nvlat_si;
	
		/* *
		 *
		*处理关联产品
		*
		*/
		if($product_data['relationship'] == "Variation"){
	
			$vt    = new VariationsType();
			//$v     = new VariationType();
			$nvlat = new NameValueListArrayType();
			$nvlt  = new NameValueListType();
	
			$nvlt->Name = $product_data['Specification'];//如 Bracelet Length
	
			//$size_array如array('6.25 inches','6.50 inches','6.75 inches')
			$size_array = explode(';',$product_data['relationship_detail']);
			$i=1;
			foreach ($size_array as $size){
				$nvlt->setValue($size,$i++);
			}
			$nvlat->NameValueList = $nvlt;
			$vt->VariationSpecificsSet = $nvlat;
	
			//不同尺码的产品信息
			$relation = unserialize($product_data['relation']);
			foreach ($relation as $pd){
				$v     = new VariationType();
				$nvlat = new NameValueListArrayType();
				$nvlt  = new NameValueListType();
	
				$v->SKU = $pd['sku'];//产品编号
				$v->Quantity = $pd['qty'];//库存
				$v->StartPrice = $pd['price'];
				$nvlt->Name = $product_data['Specification'];
				$nvlt->setValue($pd['size']);//产品尺寸,颜色等属性
				$nvlat->setNameValueList($nvlt);
				$v->VariationSpecifics = $nvlat;
				$vt->Variation[] = $v;
	
			}
		}
	
		$item->Variations = $vt;
		$req->Item = $item;
		$res = $this->_cs->AddFixedPriceItem($req);//$res为返回信息，成功，失败，失败原因等
	
		return $res->ItemID;
	}
}

