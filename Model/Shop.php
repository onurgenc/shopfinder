<?php
    namespace Ogenc\Shopfinder\Model;

    use Magento\Framework\Exception\ShopException;
    use Ogenc\Shopfinder\Api\Data\ShopInterface;

    /**
     * Shoptab shop model
     */
    class Shop extends \Magento\Framework\Model\AbstractModel implements ShopInterface
    {

        /**
         * CMS page cache tag.
         */
        const CACHE_TAG = 'shopfinder';
        /**
         * @var string
         */
        protected $_cacheTag = 'shopfinder';
        /**
         * Prefix of model events names.
         *
         * @var string
         */
        protected $_eventPrefix = 'shopfinder';

        /**
         * @param \Magento\Framework\Model\Context                        $context
         * @param \Magento\Framework\Registry                             $registry
         * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
         * @param \Magento\Framework\Data\Collection\Db                   $resourceCollection
         * @param array                                                   $data
         */
        public function __construct(
            \Magento\Framework\Model\Context $context,
            \Magento\Framework\Registry $registry,
            \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
            \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
            array $data = []
        ) {
            parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        }

        /**
         * @return void
         */
        public function _construct()
        {
            $this->_init('Ogenc\Shopfinder\Model\ResourceModel\Shop');
        }

        /**
         * Get ShopId.
         *
         * @return int
         */
        public function getShopId()
        {
            return $this->getData(self::SHOP_ID);
        }

        /**
         * Set ShopId.
         */
        public function setShopId($shopId)
        {
            return $this->setData(self::SHOP_ID, $shopId);
        }

        /**
         * Get Name.
         *
         * @return varchar
         */
        public function getName()
        {
            return $this->getData(self::NAME);
        }

        /**
         * Set Name.
         */
        public function setName($name)
        {
            return $this->setData(self::NAME, $name);
        }

        /**
         * Get Identifier.
         *
         * @return varchar
         */
        public function getIdentifier()
        {
            return $this->getData(self::IDENTIFIER);
        }

        /**
         * Set Name.
         */
        public function setIdentifier($identifier)
        {
            return $this->setData(self::IDENTIFIER, $identifier);
        }

        /**
         * Get Image.
         *
         * @return varchar
         */
        public function getImage()
        {
            return $this->getData(self::IMAGE);
        }

        /**
         * Set Image.
         */
        public function setImage($image)
        {
            return $this->setData(self::IMAGE, $image);
        }

        /**
         * Get ModifiedAt.
         *
         * @return varchar
         */
        public function getUpdatedAt()
        {
            return $this->getData(self::UPDATED_AT);
        }

        /**
         * Set ModifiedAt.
         */
        public function setUpdatedAt($updatedAt)
        {
            return $this->setData(self::UPDATED_AT, $updatedAt);
        }

        /**
         * Get CreatedAt.
         *
         * @return varchar
         */
        public function getCreatedAt()
        {
            return $this->getData(self::CREATED_AT);
        }

        /**
         * Set CreatedAt.
         */
        public function setCreatedAt($createdAt)
        {
            return $this->setData(self::CREATED_AT, $createdAt);
        }

        /**
         * @param $country
         *
         * @return $this
         */
        public function setCountry($country)
        {
            return $this->setData(self::COUNTRY, $country);
        }

        /**
         * @return mixed
         */
        public function getCountry()
        {
            return $this->getData(self::COUNTRY);
        }
    }
