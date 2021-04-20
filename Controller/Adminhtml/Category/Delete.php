<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Product\Controller\Adminhtml\Category;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use AHT\Product\Helper\Data;
use AHT\Product\Api\ProductRepositoryInterface;
use AHT\Product\Model\ProductFactory;

class Delete extends \AHT\Product\Controller\Adminhtml\Category implements HttpPostActionInterface
{
    protected $_helper;

    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

        /**
     * @var ProductFactory
     */
    private $productFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \AHT\Product\Api\ProductRepositoryInterface $productRepository
     * @param \AHT\Product\Model\ProductFactory|null $productFactory
     */
    public function __construct( 
        \Magento\Backend\App\Action\Context $context, 
        \Magento\Framework\Registry $coreRegistry,
        Data $helper,
        ProductFactory $productFactory = null,
        ProductRepositoryInterface $productRepository = null
        )
    {
        parent::__construct($context, $coreRegistry);
        $this->_helper = $helper;
        $this->productFactory = $productFactory ?: \Magento\Framework\App\ObjectManager::getInstance()->get(ProductFactory::class);
        $this->_productRepository = $productRepository ?: \Magento\Framework\App\ObjectManager::getInstance()->get(ProductRepositoryInterface::class);
    }

    /**
     * Delete action`
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        $modelProduct = $this->productFactory->create();
        $items = $this->_helper->getProductByCategory($id);
        //var_dump($items);die;
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\AHT\Product\Model\Category::class);
                $model->load($id);
                foreach($items as $value){
                    $this->_productRepository->deleteById($value['id']);
                }
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Category.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Category to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
