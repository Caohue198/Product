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
    protected $helper;


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

        $product = $this->_collection;
        $items = $product->getItems();
        foreach($items as $item)
        { 
            $itemData = $item->getData();
            $this->_loadedData[$item->getId()] = $itemData;
        }

        return $this->_loadedData;
    }

    public function getStoreManager(){
        return $this->_storeManager;
    }

    public function getSlide()
    {
       $helper = $this->helper->getConfigValueSlide('enable');
        return $helper;
    }

    public function getProductNumber()
    {
       $helper = $this->helper->getConfigValueNumber('number-page');
        return $helper;
        
    }

    public function getProductNumberSlide()
    {
       $helper = $this->helper->getConfigValueNumbeSlide('number-slide');
        return $helper;
        
    }
}