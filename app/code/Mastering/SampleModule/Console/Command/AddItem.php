<?php

namespace Mastering\SampleModule\Console\Command;
use Symfony\Component\Console\Command\Command;
use Mastering\SampleModule\Model\ItemFactory;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;
use Psr\Log\LoggerInterface;;
use Magento\Framework\Event\ManagerInterface;
//use Magento\Sales\Model\Order\Payment\Transaction\ManagerInterface;

//use Mastering\SampleModule\Model\
class AddItem extends Command

{
    const INPUT_KEY_NAME = 'name';

    private $itemFactory;

    private $logger;
    //private $eventManager;
    public function __construct(ItemFactory $itemFactory 
     ,ManagerInterface $eventManager
     //,LoggerInterface $logger
    )
    {
        $this->itemFactory = $itemFactory;
        //$this->logger=$logger;
       $this->eventManager=$eventManager;
        parent::__construct();

    }
    protected function configure()
    {
        $this->setName('mastering:add:item')
        ->addArgument(self::INPUT_KEY_NAME , InputArgument::REQUIRED,'item name');
        parent::configure();

    }


    protected function execute (InputInterface $input,OutputInterface $output)
    {
        $item=$this->itemFactory->create();
        $item->setName($input->getArgument(self::INPUT_KEY_NAME));
        $item->setIsObjectNew(true);
        $item->save();
        //$this->logger->debug('item was created ...!');
        $this->eventManager->dispatch('mastering_Command ', ['object'=>$item]);
        return Cli::RETURN_SUCCESS;


    }

}