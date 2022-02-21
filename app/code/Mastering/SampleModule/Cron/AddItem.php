<?php 
namespace Mastering\SampleModule\Cron;
use Mastering\SampleModule\Model\ItemFactory;
use Mastering\SampleModule\model\Config;

Class AddItem {

  private $itemFactory; 

  private $config;

  public function __construct(ItemFactory $itemFactory, Config $config)
  {
      $this->itemFactory=$itemFactory;
      $this->config=$config;
  }

  public function execute() 
  {
    //describtion
    if ($this->config->isEnabled)
    {

    $this->itemFactory->create()->setName('schedule item')
    ->setdescribtion('created at '.time())
    ->save();

    }

  }
} 