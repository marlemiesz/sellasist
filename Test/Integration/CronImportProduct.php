<?php

namespace Magento\TestFramework\Inspection\Marlemiesz\Sellasist\Test\Unit;

use Magento\TestFramework\Helper\Bootstrap;
use Marlemiesz\Sellasist\Config\Setting;
use Marlemiesz\Sellasist\Cron\ImportProduct;
use PHPUnit\Framework\TestCase;

class CronImportProduct extends TestCase
{

    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    private $objectManager;

    private $cron;

    protected function setUp(): void
    {
//        parent::setUp();

        $this->objectManager = Bootstrap::getObjectManager();

        $this->cron = $this->objectManager->get(ImportProduct::class);
    }

    public function testImportProduct()
    {
        $this->cron->execute();
    }
}
