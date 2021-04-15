<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Product\Model\Config\Source;


class Category implements \Magento\Framework\Option\ArrayInterface
{
    protected $_productFactory;

    public function __construct(
        \AHT\Product\Model\ResourceModel\Category\Grid\CollectionFactory $productCollectionFactory
    ) {
        $this->_productFactory =  $productCollectionFactory->create();
       
    }
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray()
    {
        $product = $this->_productFactory;
        foreach ($product as $item) {
            $items[] = ['value' => $item['id'], 'label' => __($item['name'])];
        }
        return $items;
            
    }
}