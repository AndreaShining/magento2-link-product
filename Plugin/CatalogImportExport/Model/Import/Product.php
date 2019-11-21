<?php

namespace MagePal\LinkProduct\Plugin\CatalogImportExport\Model\Import;

use Magento\CatalogImportExport\Model\Import\Produc;
use MagePal\LinkProduct\Model\Product\Link;

/**
 * @see \Magento\CatalogImportExport\Model\Import\Product::getLinkNameToId
 */
class Product
{
    /**
     * REMARK: needs core patch
     * https://github.com/magento/magento2/pull/21230/commits/0846e9aed7040659e7ce3e109eb91df3f5fdfb7e.patch
     *
     * @param \Magento\CatalogImportExport\Model\Import\Product $subject
     * @param $result
     * @return mixed
     */
    public function afterGetLinkNameToId(\Magento\CatalogImportExport\Model\Import\Product $subject, $result)
    {
        $result['sparepart_'] = Link::LINK_TYPE_SPAREPART;

        \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Psr\Log\LoggerInterface::class)->info('Sono in plugin mio');
        \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Psr\Log\LoggerInterface::class)->info($result);

        return $result;
    }
    
}