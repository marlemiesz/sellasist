<?php

namespace Magento\TestFramework\Inspection\Marlemiesz\Sellasist\Test\Unit;

use Magento\TestFramework\Helper\Bootstrap;
use Marlemiesz\Sellasist\Config\Setting;
use PHPUnit\Framework\TestCase;

class SettingTest extends TestCase
{
    /**
     * @var mixed
     */
    private $_setting;
    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    private $objectManager;

    protected function setUp(): void
    {
//        parent::setUp();

        $this->objectManager = Bootstrap::getObjectManager();

        $this->_setting = $this->objectManager->get(Setting::class);
    }

    public function testImportProduct()
    {
        $this->assertNotNull($this->_setting->getImportProduct());
        $this->assertNotNull($this->_setting->getApiName());
        $this->assertNotNull($this->_setting->getApiKey());
    }
}
