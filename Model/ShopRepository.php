<?php
    namespace Ogenc\Shopfinder\Model;

    use Magento\Framework\Api\SortOrder;
    use Magento\Framework\Reflection\DataObjectProcessor;
    use Magento\Store\Model\StoreManagerInterface;
    use Ogenc\Shopfinder\Api\Data;
    use Ogenc\Shopfinder\Model\ResourceModel\Shop as ResourceShop;

    class ShopRepository implements \Ogenc\Shopfinder\Api\ShopRepositoryInterface
    {

        /**
         * @var \Ogenc\Shopfinder\Model\ResourceModel\Shop\CollectionFactory
         */
        protected $collectionFactory;
        /**
         * @var \Magento\Framework\Api\SearchCriteriaBuilder
         */
        protected $searchCriteriaBuilder;
        /**
         * @var \Ogenc\Shopfinder\Api\Data\ShopSearchResultsInterfaceFactory
         */
        protected $searchResultsFactory;
        /**
         * @var \Magento\Store\Model\StoreManagerInterface
         */
        protected $storeManager;
        /**
         * @var \Magento\Framework\App\Request\Http
         */
        protected $request;

        /**
         * ShopRepository constructor.
         *
         * @param \Ogenc\Shopfinder\Api\Data\ShopSearchResultsInterfaceFactory $searchResultsFactory
         * @param \Ogenc/Shopfinder\Model|ResourceModel\Shop\CollectionFactory $collectionFactory
         * @param \Magento\Framework\Api\SearchCriteriaBuilder                 $searchCriteriaBuilder
         * @param \Magento\Store\Model\StoreManagerInterface                   $storeManager
         * @param \Magento\Framework\App\Request\Http                          $request
         * @SuppressWarnings(PHPMD.ExcessiveParameterList)
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function __construct(
            \Ogenc\Shopfinder\Api\Data\ShopSearchResultsInterfaceFactory $searchResultsFactory,
            \Ogenc\Shopfinder\Model\ResourceModel\Shop\CollectionFactory $collectionFactory,
            \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\App\Request\Http $request
        ) {
            $this->collectionFactory = $collectionFactory;
            $this->searchCriteriaBuilder = $searchCriteriaBuilder;
            $this->searchResultsFactory = $searchResultsFactory;
            $this->storeManager = $storeManager;
            $this->request = $request;
        }

        public function getLists()
        {
            $storeId = $this->storeManager->getStore()->getId();
            /** @var \Ogenc\Shopfinder\Model\ResourceModel\Shop\Collection $collection */
            $collection = $this->collectionFactory->create();
            if ($storeId != 1) {
                $collection->addFieldToFilter('store_id', $storeId);
            }
            $this->searchCriteriaBuilder->create();
            $searchResults = $this->searchResultsFactory->create();
            $criteria = $this->request->get('searchCriteria');
            if (isset($criteria) && !empty($criteria)) {
                if (isset($criteria['filterGroups'][0]['filters']) && !empty($criteria['filterGroups'][0]['filters'])) {
                    foreach ($criteria['filterGroups'][0]['filters'] as $filter) {
                        $condition = (isset($filter['condition_type']) && !empty($filter['condition_type'])) ? $filter['condition_type'] : 'eq';
                        $collection->addFieldToFilter($filter['field'], [$condition => $filter['value']]);
                        $this->searchCriteriaBuilder->addFilter($filter['field'], $filter['value'],
                            (isset($filter['condition_type']) && !empty($filter['condition_type'])) ? $filter['condition_type'] : 'eq');
                    }
                }
                if (isset($criteria['current_page']) && !empty($criteria['current_page'])) {
                    $collection->setCurPage($criteria['current_page']);
                    $this->searchCriteriaBuilder->setCurrentPage($criteria['current_page']);
                }
                if (isset($criteria['page_size']) && !empty($criteria['page_size'])) {
                    $collection->setPageSize($criteria['current_page']);
                    $this->searchCriteriaBuilder->setPageSize($criteria['page_size']);
                }
                if (isset($criteria['sort_orders']) && !empty($criteria['sort_orders'])) {
                    foreach ($criteria['sort_orders'] as $sort) {
                        $collection->addOrder($sort['field'],
                            ($sort['direction'] == SortOrder::SORT_ASC) ? 'ASC' : 'DESC');
                        $this->searchCriteriaBuilder->addSortOrder($sort['field'],
                            ($sort['direction'] == SortOrder::SORT_ASC) ? 'ASC' : 'DESC');
                    }
                }
                $searchResults->setSearchCriteria($this->searchCriteriaBuilder->create());
            }
            $collection->load();
            $searchResults->setItems($collection->getItems());
            $searchResults->setTotalCount($collection->getSize());

            return $searchResults;
        }
    }
