<?php 
namespace AHT\Product\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

	public function getConfigValue($field)
	{
		return $this->scopeConfig->getValue('product/product/'.$field, ScopeInterface::SCOPE_STORE);
	}

    public function getConfigValueSlide($field)
	{
		return $this->scopeConfig->getValue('product/product-slide/'.$field, ScopeInterface::SCOPE_STORE);
	}

	public function getConfigValueNumber($field)
	{
		return $this->scopeConfig->getValue('product/product-number/'.$field, ScopeInterface::SCOPE_STORE);
	}

    public function getConfigValueNumbeSlide($field)
	{
		return $this->scopeConfig->getValue('product/product-number/'.$field, ScopeInterface::SCOPE_STORE);
	}

	public function getConfigValueCategory($field)
	{
		return $this->scopeConfig->getValue('product/category/'.$field, ScopeInterface::SCOPE_STORE);
	}


}