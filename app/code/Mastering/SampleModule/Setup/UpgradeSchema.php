<?php 

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface; 
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface {
    public function upgrade (SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();
        if (version_compare($context->getVersion(),'1.0.1','<')){
        $table=$setup->getConnection()->addColumn($setup->getTable('mastering_sample_item'),'describtion',['type'=> Table::TYPE_TEXT,'nullabel'=>true,'comment'=>'item description']);
        }


        if (version_compare($context->getVersion(),'1.0.2','<')){
            $table=$setup->getConnection()->addColumn($setup->getTable('sales_order_grid'),'base_tax_amount',['type'=> Table::TYPE_DECIMAL,'comment'=>'Base Tax Amount']);
            }
        $setup->endSetup();
    }
}