<?php
namespace AHT\Product\Model;

use \Magento\Framework\DataObject\IdentityInterface;
use AHT\Product\Api\Data\CategoryInterface;

// class Product extends AbstractModel implements IdentityInterface
class Category extends \Magento\Framework\Model\AbstractModel implements IdentityInterface, CategoryInterface {
    const CACHE_TAG = 'aht_category_post';

    protected $_cacheTag = 'aht_category_post';

    protected $_eventPrefix = 'aht_category_post';
    
    public function __construct(
   	 \Magento\Framework\Model\Context $context,
   	 \Magento\Framework\Registry $registry,
   	 \Magento\Framework\Model\ResourceModel\AbstractResource $resource =
   	 null,
   	 \Magento\Framework\Data\Collection\AbstractDb $resourceCollection =
   	 null,
   	 array $data = []
    ) {
   	 parent::__construct($context, $registry, $resource,$resourceCollection, $data);
    }
    public function _construct() {
		$this->_init('AHT\Product\Model\ResourceModel\Category');
    }    

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getId()
    {
        return $this->getData('id');
    }
    public function setId($id)
    {
        $this->setData('id', $id);
    }
     
    public function getName()
    {
        return $this->getData('name');
    }
    public function setName($name)
    {
        $this->setData('name', $name);
    } 

}
