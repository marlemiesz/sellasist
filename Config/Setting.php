<?php


namespace Marlemiesz\Sellasist\Config;


use Magento\Framework\App\Helper\AbstractHelper;

class Setting extends AbstractHelper
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Recipient email config path
     */
    const XML_PATH_IMPORT_PRODUCT = 'sellasist/general/import_product';

    const XML_PATH_API_NAME = 'sellasist/general/shop_name';

    const XML_PATH_API_KEY = 'sellasist/general/api_key';

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return int
     */
    public function getImportProduct():int
    {
        return $this->scopeConfig->getValue(self::XML_PATH_IMPORT_PRODUCT) ? 1 : 0;
    }

    /**
     * @return string
     */
    public function getApiName():string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_NAME) ?? '';
    }

    /**
     * @return string
     */
    public function getApiKey():string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_KEY) ?? '';
    }
}
