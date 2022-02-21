<?php 
namespace Mastering\SampleModule\Block;
use Magento\Framework\Data\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Mastering\SampleModule\Model\ResourceModule\Item\Collection;
use Mastering\SampleModule\Model\ResourceModule\Item\CollectionFactory as col; 
class Hello extends Template  
{
    
    private $collectionFactory;

    public function __construct(
        Template\Context $context,col $collectionFactory,array $data=[]
    )

    {
        $this->collectionFactory=$collectionFactory;
        parent::__construct($context,$data);
       // parent::__ construct($context,$data);
    }

    public function getItems()
    {
        return $this->collectionFactory->create()->getItems();
    }
}