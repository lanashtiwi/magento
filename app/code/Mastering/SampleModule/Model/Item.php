<?php 

namespace Mastering\SampleModule\Model;

// use Magento\Framework\Model\AbstractModel;
 class Item extends \Magento\Framework\Model\AbstractModel
 {
     protected $_eventPrefix='mastering_sample_item';
     protected function _construct()
     {
         $this->_init(\Mastering\SampleModule\Model\ResourceModule\Item::class);
     }


 }