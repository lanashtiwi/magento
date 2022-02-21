<?php 

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface; 
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;

class InstallData implements  InstallDataInterface {
    public function install (ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
    $setup->getConnection()->insert($setup->getTable('mastering_sample_item'),['name'=>'item 1']);

    $setup->getConnection()->insert($setup->getTable('mastering_sample_item'),['name'=>'item 2']);

        $setup->endSetup();
    }
}