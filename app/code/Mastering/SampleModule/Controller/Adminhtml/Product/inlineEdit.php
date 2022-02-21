<?php

namespace Mastering\SampleModule\Controller\Adminhtml\Product;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory $productFactory
     */
    protected $productFactory;

    /**
    * @param \Magento\Backend\App\Action\Context $context
    * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    * @param \Magento\Catalog\Model\ProductFactory $productFactory
    */

    /**
    * @param \Magento\Backend\Model\Auth\Session  $authSession
    */
    protected $authSession;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
        //, \Magento\Backend\Model\Auth\Session $authSession
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_productFactory = $productFactory;
       // $this->authSession = $authSession;
    }

    /**
     * @return \Magento\Framework\Controller\Result\JsonFactory
     */
    public function execute()
    {
       /* $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/inlineeditproduct.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $extensionUser = $objectManager->get('Magento\Backend\Model\Auth\Session')->getUser()->getUsername();*/
       // $user_Name=Mage::getSingleton('admin/session')->getUser()->getUsername();
       
       
       
       
       //$logger->info('New Edit Proecess by admin : '.$extensionUser);
        
       $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach ($postItems as $value)
        {
            if ($value) {
                $productObj = $this->_productFactory->create();
                if ($value['entity_id']) {
                    $productObj->load($value['entity_id']);
                    
                }

                $name_pro=$productObj->getName();
              
              
              //  $logger->info('Old Name Of Product: '.$name_pro);
              
              
                $productObj->setStoreId(0);
                if(array_key_exists('name', $value)) {
                    $productObj->setName($value['name']);
                }
                //$logger->info('New Name Of Product: '.print_r($value['name'], true));
                
                
                /*if(array_key_exists('sku', $value)) {
                    $productObj->setSku($value['sku']);
                }

                if(array_key_exists('price', $value)) {
                    $productObj->setPrice($value['price']);
                }

                if(array_key_exists('visibility', $value)) {
                    $productObj->setVisibility($value['visibility']);
                }
*/
                if(array_key_exists('status', $value)) {
                    $productObj->setStatus($value['status']);
                }
              
              /*  if(array_key_exists('brand', $value)) {
                    $productObj->setBrand($value['brand']);
                }

                if(array_key_exists('showinhome', $value)) {
                    $productObj->setShowinhome($value['showinhome']);
                }
                if(array_key_exists('supplier_id', $value)) {
                    $productObj->setSupplierId($value['supplier_id']);
                }*/

                try {
                    $productObj->save();
                } catch (\Magento\Framework\Model\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}