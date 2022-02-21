<?php 

namespace Mastering\SampleModule\Model\ResourceModule\Item;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
//use Mastering\SampleModule\Model\Item;
//use Mastering\SampleModule\Model\ResourceModule\Item as ItemResource;
class Collection extends  AbstractCollection{
    protected $_idFieldName='id';
    protected function _construct() 
    {
        $this->_init(\Mastering\SampleModule\Model\Item::class ,\Mastering\SampleModule\Model\ResourceModule\Item::class );
    }

} 