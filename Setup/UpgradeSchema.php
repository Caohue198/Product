<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Product\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {   
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('aht_product'),
                'price',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 20,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'price'
                ]

            );
        } 

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('aht_product'),
                'content',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'content'
                ]

            );
        } 

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $setup->getConnection()->changeColumn(
                $setup->getTable('aht_product'),
                'content',
                'sku',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'sku'
                ]

            );
        } 

        if (version_compare($context->getVersion(), '1.0.5', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('aht_product'),
                'status',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'status'
                ]

            );
        } 

        if (version_compare($context->getVersion(), '1.0.7', '<')) {

            $table = $setup->getTable('aht_category');
    
            $setup->getConnection()
                ->addIndex(
                    $table,
                    $setup->getIdxName(
                        $table,
                        ['name'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
        }
       
        if (version_compare($context->getVersion(), '1.0.11', '<')) {

            $table = $setup->getTable('aht_product');
    
            $setup->getConnection()
                ->addIndex(
                    $table,
                    $setup->getIdxName(
                        $table,
                        ['title', 'description', 'price', 'sku'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['title', 'description', 'price', 'sku'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
        }
        
        $setup->endSetup();
    }

}