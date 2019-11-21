<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagePal\LinkProduct\Model;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Link\Collection;
use Magento\Framework\DataObject;
use MagePal\LinkProduct\Model\Product\Link;

/**
 * Class Sparepart
 * @package MagePal\LinkProduct\Model
 */
class Sparepart extends DataObject
{
    /**
     * Product link instance
     *
     * @var Product\Link
     */
    protected $linkInstance;

    /**
     * Sparepart constructor.
     * @param Link $productLink
     */
    public function __construct(
        Link $productLink
    ) {
        $this->linkInstance = $productLink;
    }

    /**
     * Retrieve link instance
     *
     * @return  Product\Link
     */
    public function getLinkInstance()
    {
        return $this->linkInstance;
    }

    /**
     * Retrieve array of Sparepart products
     *
     * @param Product $currentProduct
     * @return array
     */
    public function getSparepartProducts(Product $currentProduct)
    {
        //if (!$this->hasSparepartProducts()) {
            $products = [];
            $collection = $this->getSparepartProductCollection($currentProduct);
            foreach ($collection as $product) {
                $products[] = $product;
            }
            $this->setSparepartProducts($products);
        //}
        return $this->getData('sparepart_products');
    }

    /**
     * Retrieve sparepart products identifiers
     *
     * @param Product $currentProduct
     * @return array
     */
    public function getSparepartProductIds(Product $currentProduct)
    {
        //if (!$this->hasSparepartProductIds()) {
            $ids = [];
            foreach ($this->getSparepartProducts($currentProduct) as $product) {
                $ids[] = $product->getId();
            }
            $this->setSparepartProductIds($ids);
        //}
        return $this->getData('sparepart_product_ids');
    }

    /**
     * Retrieve collection sparepart product
     *
     * @param Product $currentProduct
     * @return \Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection
     */
    public function getSparepartProductCollection(Product $currentProduct)
    {
        $collection = $this->getLinkInstance()->useSparepartLinks()->getProductCollection()->setIsStrongMode();
        $collection->setProduct($currentProduct);
        return $collection;
    }

    /**
     * Retrieve collection sparepart link
     *
     * @param Product $currentProduct
     * @return Collection
     */
    public function getSparepartLinkCollection(Product $currentProduct)
    {
        $collection = $this->getLinkInstance()->useSparepartLinks()->getLinkCollection();
        $collection->setProduct($currentProduct);
        $collection->addLinkTypeIdFilter();
        $collection->addProductIdFilter();
        $collection->joinAttributes();
        return $collection;
    }
}
