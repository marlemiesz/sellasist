<?php


namespace Marlemiesz\Sellasist\Cron;


use Magento\Framework\App\ObjectManager;
use Marlemiesz\Sellasist\Config\Product;
use Marlemiesz\Sellasist\Config\Setting;
use Marlemiesz\SellasistLib\Client;

class ImportProduct
{
    /**
     * @var Setting
     */
    private $setting;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Product
     */
    private $configProduct;


    /**
     * ImportProduct constructor.
     * @param Setting $setting
     * @param Product $configProduct
     */
    public function __construct(Setting $setting)
    {

        $this->setting = $setting;
        $this->client = new Client($this->setting->getApiName(), $this->setting->getApiKey());
    }

    public function execute()
    {
        if($this->isImportProductActive()){
            return false;
        }

        $products = $this->client->getProducts();




    }

    /**
     * @return bool
     */
    protected function isImportProductActive(): bool
    {
        return $this->setting->getImportProduct() === 0;
    }
}
