<?php 
namespace AHT\Product\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
	protected $product;
	protected $scopeConfig;
	public function __construct(\AHT\Product\Model\ResourceModel\Product\Grid\CollectionFactory $product, ScopeConfigInterface $scopeConfig)
	{
		$this->product = $product;
		$this->scopeConfig = $scopeConfig;
	}

	public function getProductByCategory($id) {
		$product = $this->product->create();
		$result = $product->addFieldToFilter('categoryid',$id);
		$items = $result->getData();
		return $items;
	}

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