<?php


namespace Mastering\SampleModule\Ui;

use Mastering\SampleModule\Model\ResourceModule\Item\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;


/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
  
    protected $collection;
    		
    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $CollectionFactory
     * @param array $meta
     * @param array $data
     */
	 

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    ) {
       
        //$this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
         $this->collection = $CollectionFactory->create();
    }

  
    public function getData()
    {

        $result=[];
        foreach ($this->collection->getItems() as $item) {
            $index=$item->getId();
            // echo "IN Get Dataaaaaaaaa ".$result[$item->getId()]['general'];
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test2.log'); 
            $logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
            $logger->info("Provider".$index);
            $result[$index]['general']=$item->getData();
            print_R($item->getData());

           /* echo "IN Get Dataaaaaaaaa ".$result[$item->getId()]['general'];
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test2.log'); 
            $logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
            $logger->info("Provider".$result[$item->getId()]['general']);
        */
        }
        return $result;
    }
}
