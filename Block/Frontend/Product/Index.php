<?php
namespace AHT\Product\Block\Frontend\Product;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use AHT\Product\Model\ResourceModel\Product\Grid\CollectionFactory;
use AHT\Product\Helper\Data;

class Index extends Template implements BlockInterface
{
    protected $_collection;
    public $_storeManager;
    public $_customerSession;
    public $helper;

    public function __construct(
        CollectionFactory $productCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        Data $helper,
        array $data = []

    )
    {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->_collection =  $productCollectionFactory->create();
        $this->helper = $helper;
    }

    public function getDataBlocks()
    {
        $category = $this->helper->getConfigValueCategory('category');
        $product = $this->_collection;
        $result = $product->addFieldToFilter('categoryid',$category);
        $item = $result->getData();
        return $item;
    }

    public function getStoreManager(){
        return $this->_storeManager;
    }

}