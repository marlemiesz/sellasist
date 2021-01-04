<?php


namespace Marlemiesz\Sellasist\Config;


class Product
{
    /**
     * @var \Magento\Eav\Model\Config
     */
    private $_eavConfig;

    /**
     * @param \Magento\Eav\Model\Config $eavConfig
     */
    public function __construct(
        \Magento\Eav\Model\Config $eavConfig
    ) {

        $this->_eavConfig = $eavConfig;
    }

    /**
     * Returns true if attribute exists and false if it doesn't exist
     *
     * @param string $field
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function isProductAttributeExists($field)
    {
        $attr = $this->_eavConfig->getAttribute('catalog_product', $field);
        return ($attr && $attr->getId());
    }

}
