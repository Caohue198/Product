<?php
namespace AHT\Product\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use AHT\Product\Helper\Data;
 
class Config extends Action
{
 
    protected $helper;
 
    public function __construct(Context $context, Data $helper)
    {
        $this->helper = $helper;
        parent::__construct($context);
    }
 
 
    public function execute()
    {
       $helper = $this->helper->getConfigValue('enable');
        echo $helper;
    }
    public function getSlide()
    {
       $helper = $this->helper->getConfigValueSlide('enable');
        echo $helper;
    }
}
