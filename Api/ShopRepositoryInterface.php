<?php

namespace Ogenc\Shopfinder\Api;

interface ShopRepositoryInterface
{
    /**
     * Get shops with filter.
     *
     * @return \Ogenc\Shopfinder\Api\Data\ShopSearchResultsInterface
     */
    public function getLists();
}
