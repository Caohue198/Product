<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Product\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use AHT\Product\Api\CategoryRepositoryInterface as CategoryRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Product\Api\Data\CategoryInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'AHT_Product::category';

    /**
     * @var \AHT\Product\Api\CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param CategoryRepository $categoryRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        CategoryRepository $categoryRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->categoryRepository = $categoryRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $categoryId) {
                    /** @var \AHT\Product\Model\Category $category */
                    $category = $this->categoryRepository->getById($categoryId);
                    try {
                        $category->setData(array_merge($category->getData(), $postItems[$categoryId]));
                        $this->categoryRepository->save($category);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithCategoryId(
                            $category,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param ProductInterface $category
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithCategoryId(CategoryInterface $category, $errorText)
    {
        return '[Category ID: ' . $category->getId() . '] ' . $errorText;
    }
}
