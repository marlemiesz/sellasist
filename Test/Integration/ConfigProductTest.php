<?php

namespace Magento\TestFramework\Inspection\Marlemiesz\Sellasist\Test\Unit;

use Magento\TestFramework\Helper\Bootstrap;
use Marlemiesz\Sellasist\Config\Product;
use PHPUnit\Framework\TestCase;

class ConfigProductTest extends TestCase
{

    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    private $objectManager;
    /**
     * @var mixed
     */
    private $configProduct;

    protected function setUp(): void
    {
//        parent::setUp();

        $this->objectManager = Bootstrap::getObjectManager();

        $this->configProduct = $this->objectManager->get(Product::class);
    }

    public function testCheckProductAttributes()
    {
        var_dump($this->configProduct->isProductAttributeExists('sellasist_id'));
        $this->assertIsBool($this->configProduct->isProductAttributeExists('sellasist_id'));
    }
}
