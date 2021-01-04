<?php


namespace Marlemiesz\Sellasist\Helper\Query;


use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Helper\Context;

class ProductsByAttributeSellasistId extends Query
{
    private $value;
    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    /**
     * ProductsByAttributeSellasistId constructor.
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory

    )
    {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
        return $this;
    }

    public function get()
    {
        if($this->value === null){
            throw new \Exception("Value is empty in ProductsByAttributeSellasistId");
        }

        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('sellasist_id', array('=' => $this->value));
        return $collection->getData();
    }
}
