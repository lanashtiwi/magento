<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Mastering\SampleModule\Observer;

use Magento\Framework\Event\ObserverInterface;

class ProductsUpdate implements ObserverInterface {


   //protected  $logger;
   
   public Function __construct()
   {
    //$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Updateproduct.log');
    //$logger = new \Zend\Log\Logger();

    //   $this->logger=$logger;
   }
    public function execute( \Magento\Framework\Event\Observer $observer ) {

       
       // $logger->addWriter($writer);
        //$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Updateproduct.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
      // $this->logger=$logger;
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $extensionUser = $objectManager->get('Magento\Backend\Model\Auth\Session')->getUser()->getUsername();
        
        $logger->info('New Edit Proecess by admin : '.$extensionUser);
        // echos name of event: controller_action_catalog_product_save_entity_after
       // echo 'name of event: ' . $observer->getEvent()->getName();
        $logger->info( 'name of event .................................................');

        $product = $observer->getEvent()->getProduct();

      //  $storeIds = $this->configHelper->getEnabledStoresForIndexing($product->getStoreId());
        //$this->logger->add($observer->getEvent()->getName());
       
        switch ($observer->getEvent()->getName()) {
        
        case "catalog_product_save_before":
        $this->catalogProductSaveBefore($product);
        break;
        case "controller_action_catalog_product_save_entity_after":
        $this->catalogProductSaveAfter($product);
        break;
        }        
        
        /*
        * @itechInsider
        * Product Trigger Before Save
        * */
    }
        private function catalogProductSaveBefore($product)
        {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Updateproduct.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $old_name=$product->getName();
            $logger->info('the Old name of product before update  '.$old_name);
        
        }
        
        /*
        * @itechInsider
        * Product Trigger After Save
        * */
        
        private function catalogProductSaveAfter($product)
        {  $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Updateproduct.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $new_name=$product->getName();
            $logger->info('the New  name of product aftye update  '.$new_name);
        
        
        }
    }
       