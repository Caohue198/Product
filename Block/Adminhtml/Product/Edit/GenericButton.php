<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Product\Block\Adminhtml\Product\Edit;

use Magento\Backend\Block\Widget\Context;
use AHT\Product\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @param Context $context
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository
    ) {
        $this->context = $context;
        $this->productRepository = $productRepository;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getProductId()
    {
        try {
            return $this->productRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
