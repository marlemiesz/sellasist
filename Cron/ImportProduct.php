<?php


namespace Marlemiesz\Sellasist\Cron;


use Magento\Framework\App\ObjectManager;
use Marlemiesz\Sellasist\Config\Product;
use Marlemiesz\Sellasist\Config\Setting;
use Marlemiesz\Sellasist\Helper\Query\ProductsByAttributeSellasistId;
use Marlemiesz\Sellasist\Helper\Save\SaveProduct;
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
     * @var ProductsByAttributeSellasistId
     */
    private $query;


    /**
     * ImportProduct constructor.
     * @param Setting $setting
     * @param ProductsByAttributeSellasistId $query
     */
    public function __construct(Setting $setting, ProductsByAttributeSellasistId $query)
    {

        $this->setting = $setting;
        $this->client = new Client($this->setting->getApiName(), $this->setting->getApiKey());
        $this->query = $query;
    }

    public function execute()
    {
        if($this->isImportProductActive()){
            return false;
        }

        $products = $this->client->getProducts();

        foreach($products as $product){

            if(!$this->query->setValue($product->getId())->get()){
                (new SaveProduct($this->client->getProduct($product->getId())))->save();
            }

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
