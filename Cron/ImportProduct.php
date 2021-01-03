<?php


namespace Marlemiesz\Sellasist\Cron;


use Magento\Framework\App\ObjectManager;
use Marlemiesz\Sellasist\Config\Setting;

class ImportProduct
{
    /**
     * @var Setting
     */
    private $setting;


    /**
     * ImportProduct constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {

        $this->setting = $setting;
    }

    public function execute()
    {
        if($this->isImportProductActive()){
            return false;
        }


    }

    /**
     * @return bool
     */
    protected function isImportProductActive(): bool
    {
        return $this->setting->getImportProduct() === 0;
    }
}
