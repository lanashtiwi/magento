<?php 
namespace Mastering\SampleModule\Model;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Config {
    const XML_PATH_ENABLED='mastering/general/enabled';
    const XML_CRON_EXPRESSION='mastering/general/cron_expression';

    private $config;
    public function __construct(ScopeConfigInterface $config )
    {   $this->$config;
    }

    public function isEnabled()
    {
        return $this->config->getValue(self::XML_PATH_ENABLED);
    }
}