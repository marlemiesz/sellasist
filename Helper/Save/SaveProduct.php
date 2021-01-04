<?php


namespace Marlemiesz\Sellasist\Helper\Save;


use Magento\Catalog\Model\Product as ProductModel;
use Magento\Framework\App\ObjectManager;
use Marlemiesz\Sellasist\Helper\ImportImageService;
use Marlemiesz\SellasistLib\Model\Product;

class SaveProduct extends Save
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var mixed
     */
    private $importImageService;

    /**
     * SaveProduct constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->objectManager = ObjectManager::getInstance();
        $this->importImageService = $this->objectManager->create(ImportImageService::class);
    }
    /**
     * @magentoDbIsolation enabled
     */
    public function save()
    {
        $product = $this->objectManager->create(ProductModel::class);
        $product->setSku($this->getEan());
        $product->setName($this->product->getName());
        $product->setStatus($this->setStatus());
        $product->setVisibility(4);
        $product->setAttributeSetId(4);
        $product->setTypeId('simple');
        $product->setPrice($this->product->getPrice());
        $product->setStockData(
            [
                'use_config_manage_stock' => 0,
                'qty' => $this->product->getQuantity(),
                'is_qty_decimal' => 0,
                'manage_stock' => 1,
                'is_in_stock' => (bool)$this->product->getQuantity()
            ]
        );
        $product->setCustomAttribute('sellasist_id', $this->product->getId());
        $product->save();

        foreach($this->product->getImages() as $image)
        {
            $this->importImageService->add($product, $image, false);
        }
        $product->save();
    }

    /**
     * @return bool
     */
    protected function setStatus(): bool
    {
        return (int)$this->product->getQuantity() > 0;
    }

    /**
     * @return string
     */
    protected function getEan(): string
    {
        $ean = $this->product->getEan();
        return $ean ? $ean : sprintf("sellasist-%s", $this->product->getId());
    }
}
