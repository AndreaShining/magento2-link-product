<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagePal\LinkProduct\Model\ProductLink\CollectionProvider;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductLink\CollectionProviderInterface;

/**
 * Class Sparepart
 * @package MagePal\LinkProduct\Model\ProductLink\CollectionProvider
 */
class Sparepart implements CollectionProviderInterface
{
    /** @var \MagePal\LinkProduct\Model\Sparepart */
    protected $sparepartModel;

    /**
     * Sparepart constructor.
     * @param \MagePal\LinkProduct\Model\Sparepart $sparepartModel
     */
    public function __construct(
        \MagePal\LinkProduct\Model\Sparepart $sparepartModel
    ) {
        $this->sparepartModel = $sparepartModel;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinkedProducts(Product $product)
    {
        return (array) $this->sparepartModel->getSparepartProducts($product);
    }
}
