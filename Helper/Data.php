<?php 
namespace AHT\Product\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

	const XML_PATH_PRODUCT = 'product/';

	public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue('product/product/'.$field, ScopeInterface::SCOPE_STORE);
	}

    public function getConfigValueSlide($field, $storeId = null)
	{
		return $this->scopeConfig->getValue('product/product-slide/'.$field, ScopeInterface::SCOPE_STORE);
	}

	public function getConfigValueNumber($field, $storeId = null)
	{
		return $this->scopeConfig->getValue('product/product-number/'.$field, ScopeInterface::SCOPE_STORE);
	}

}