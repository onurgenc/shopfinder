<?php
    namespace Ogenc\Shopfinder\Model\ResourceModel;

    /**
     * Shop resource
     */
    class Shop extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
    {

        /**
         * @var string
         */
        protected $_idFieldName = 'id';

        /**
         * Initialize resource
         *
         * @return void
         */
        public function _construct()
        {
            $this->_init('shopfinder_shop', 'id');
        }

        /**
         * @param \Magento\Framework\Model\AbstractModel $object
         *
         * @return $this
         */
        protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
        {
            $object->setUpdatedAt(date('Y-m-d H:i:s'));

            return parent::_beforeSave($object);
        }
    }
