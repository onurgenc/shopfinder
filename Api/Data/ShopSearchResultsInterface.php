<?php

    
namespace Ogenc\Shopfinder\Api\Data;


interface ShopSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Shop Complete list.
     *
     * @return \Ogenc\Shopfinder\Api\Data\ShopInterface[]
     */
    public function getItems();

    /**
     * Set Shop Complete list.
     *
     * @param \Ogenc\Shopfinder\Api\Data\ShopInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
