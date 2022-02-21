<?php
 
namespace Mastering\SampleModule\Controller\Adminhtml\Item;
 
use \Magento\Backend\App\Action1;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\App\Action\Action;
//use Mastering\SampleModule\Model\ResourceModule\Item;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
//use  \Magento\Framework\Model\AbstractModel;
//app/code/Magento/Eav/Model/Form/Fieldset.php//
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Exception;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
 
class Submit extends   \Magento\Backend\App\Action
{
  /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

   
    private  $itemFactory; 
    private  $resourceModule;
//private $eventmanager;
    private $objectManager ;
    public function __construct(Context $context,\Mastering\SampleModule\Model\ItemFactory $itemFactory,DataPersistorInterface $dataPersistor
  //  ,ManagerInterface $eventmanager
    )
    {
       //echo ("helloooooooooooooooooooo". $this->$itemFactory->getId());
       //$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log'); 
       //$logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
       //$logger->info(print_r($itemFactory,true));
       //log(50,print_r($itemFactory,true));
       //info("helloooooooooooooooooooo");
        $this->itemFactory=$itemFactory;
        $this->dataPersistor=$dataPersistor;
       // $this->eventManager=$eventManager;
        parent::__construct($context);
    }
    public function execute(){

      // $data=$this->getRequest()->getPostValue();
      // $model = $objectManager->create('Mastering\SampleModule\Model\Item');
       //$modelEmptyObject =$this->itemFactory->create()->setData($data)->save();
      // $this->itemFactory->save($modelEmptyObject);
      // $modelEmptyObject->setData($data)->save();
       //$modelEmptyObject->save();
        //$newitem=$this->itemFactory->create()->setData($data);

       // $feedModel = $this->itemFactory->create()->setData($this->getRequest()->getPostValue()['general'])->save();


       $resultRedirect = $this->resultRedirectFactory->create();
       $newitem=$this->itemFactory->create();
       $data = $this->getRequest()->getPostValue();
       $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/MYLOGFILE.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(print_r($data,true));
       if ($data) {
        $id = $this->getRequest()->getParam('id');

        if (empty($data['id'])) {
            $data['id'] = null;
        }

          /** @var \Mastering\SampleModule\Model\Item $model */
          $model = $this->_objectManager->create('Mastering\SampleModule\Model\Item')->load($id);
          if (!$model->getId() && $id) {
              $this->messageManager->addError(__('This banner no longer exists.'));
              return $resultRedirect->setPath('*/*/');
          }

          $model->setData($data);
          $model->save();
//$this->eventManager->dispatch('mastering_command',['object'=>$id]);
         /*$newitem->setData($data);
         $logger->info($newitem['name']);
         $logger->info($newitem['describtion']);
         $newitem->save();
       
       */
       
         //  $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test2.log'); 
          //$logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
           //$logger->info(print_r($id,true));

        //try{
          // $id = $data['name'];
          //  $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test2.log'); 
          // $logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
           //$logger->info(print_r($id,true));
          // print_r($data);
 
          // $customModel = $this->customModel->load($id);
           // $data = array_filter($data, function($value) { return $value !== ''; });
            //$customModel->setData($data);
           // $customModel->save();

           // $this->messageManager->addSuccess(__('Successfully saved the item.'));
            //$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);                
            //return $resultRedirect->setPath('mastering/index/index');
        //} 
        //catch (\Exception $e) {               
          //  $this->messageManager->addError($e->getMessage());
            //$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
            //return $resultRedirect->setPath('*/*/edit', ['id' => $customModel->getId()]);
       // }
    }
    //return $resultRedirect->setPath('*/*/');


    $this->dataPersistor->set('mastering_item', $data);
    return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);


        //return $this->resultRedirectFactory->create()->setPath('mastering/index/index');
    }
    
  /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mastering_SampleModule::mastering_update') || $this->_authorization->isAllowed('Mastering_SampleModule::mastering_create');
    }
}