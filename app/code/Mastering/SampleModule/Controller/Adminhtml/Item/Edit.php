<?php
 
namespace Mastering\SampleModule\Controller\Adminhtml\Item;
 
use \Magento\Backend\App\Action1;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\App\Action\Action;
//use Mastering\SampleModule\Model\ResourceModule\Item;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\ObjectManager;
//use  \Magento\Framework\Model\AbstractModel;
//app/code/Magento/Eav/Model/Form/Fieldset.php//

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
    
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    
        parent::__construct($context);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Mastering\SampleModule\Model\Item');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        //$this->_coreRegistry->register('banners_slider', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
       /* 
        $resultPage->setActiveMenu(
            'Mastering_SampleModule::mastering'
        )->addBreadcrumb(
            __('SampleModule'), __('SampleModule')
        )->addBreadcrumb(
            __('mastering'), __('mastering')
        )->addBreadcrumb(
            $id ? __('Edit item') : __('New item'),
            $id ? __('Edit item') : __('New item')
        );*/
       
        $resultPage->getConfig()->getTitle()->prepend(__('mastering'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New item'));
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mastering_SampleModule::mastering_read') || $this->_authorization->isAllowed('Mastering_SampleModule::mastering_create');
    }
}
