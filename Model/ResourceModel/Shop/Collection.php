<?php
    namespace Ogenc\Shopfinder\Model\ResourceModel\Shop;

    class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
    {

        /**
         * @var string
         */
        protected $_idFieldName = 'id';

        /**
         * Initialize resource collection
         *
         * @return void
         */
        public function _construct()
        {
            $this->_init('Ogenc\Shopfinder\Model\Shop', 'Ogenc\Shopfinder\Model\ResourceModel\Shop');
        }

        public function hasIdentifier($identifier, $id = 0)
        {
            $connection = $this->getConnection();
            $select = $connection->select()->from("shopfinder_shop", 'COUNT(*)')->where("identifier =?",
                $identifier)->where("id!=?", $id);
            $result = (int)$connection->fetchOne($select);

            return $result ? true : false;
        }
    }
