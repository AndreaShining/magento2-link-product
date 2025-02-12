<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagePal\LinkProduct\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MagePal\LinkProduct\Model\Product\Link;
use MagePal\LinkProduct\Ui\DataProvider\Product\Form\Modifier\Sparepart;

/**
 * Class InstallSchema
 * @package MagePal\LinkProduct\Setup
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /**
         * Install product link types in table (catalog_product_link_type)
         */
        $catalogProductLinkTypeData = [
            'link_type_id' => Link::LINK_TYPE_SPAREPART,
            'code' => Sparepart::DATA_SCOPE_SPAREPART
        ];

        $setup->getConnection()->insertOnDuplicate(
            $setup->getTable('catalog_product_link_type'),
            $catalogProductLinkTypeData
        );

        /**
         * install product link attributes position in table catalog_product_link_attribute
         */
        $catalogProductLinkAttributeData = [
            'link_type_id' => Link::LINK_TYPE_SPAREPART,
            'product_link_attribute_code' => 'position',
            'data_type' => 'int',
        ];

        $setup->getConnection()->insert(
            $setup->getTable('catalog_product_link_attribute'),
            $catalogProductLinkAttributeData
        );

        $setup->endSetup();
    }
}
