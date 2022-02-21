<?php 

namespace Mastering\SampleModule\Model\ResourceModule;

 //use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
 {
     protected function _construct()
     {
         $this->_init('mastering_sample_item','id');
     }
 }