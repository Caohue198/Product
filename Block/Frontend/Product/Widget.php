<?php
namespace AHT\Product\Block\Frontend\Product;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use AHT\Product\Model\ResourceModel\Product\Grid\CollectionFactory;

class Widget extends Template implements BlockInterface
{
    protected $_collection;
    public $_storeManager;
    public $_customerSession;

    public function __construct(
        CollectionFactory $productCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []

    )
    {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->_collection =  $productCollectionFactory->create();
    }

    public function getDisplayType()
    {
        return $this->getData('display_type');
    }

    public function getProductsPerPage()
    {
        return $this->getData('products_per_page');
    }

    public function getProductsPerSlide()
    {
        return $this->getData('products_per_slide');
    }

    public function getDataBlocks()
    {
        $category = $this->getData('category');
        $product = $this->_collection;
        $result = $product->addFieldToFilter('categoryid',$category);
        $item = $result->getData();
        return $item;
    }

    public function getStoreManager(){
        return $this->_storeManager;
    }


}