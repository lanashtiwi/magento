<?php 
namespace Mastering\SampleModule\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

Class Logger implements ObserverInterface
{
    private $logger ;

    public Function __construct(LoggerInterface $logger)
    {

        $this->logger=$logger;
    }
    public Function execute(Observer $observer)
    {
        $this->logger->debug($observer->getEvent()->getObject()->getName());
    }
}