<?php

    namespace Ogenc\Shopfinder\Api\Data;

    interface ShopInterface
    {

        /**
         * Constants for keys of data array. Identical to the name of the getter in snake case.
         */
        const SHOP_ID = 'id';
        const NAME = 'name';
        const IDENTIFIER = 'identifier';
        const IMAGE = 'image';
        const COUNTRY = 'country';
        const UPDATED_AT = 'updated_at';
        const CREATED_AT = 'created_at';

        /**
         * @param $country
         *
         * @return mixed
         */
        
        public function setCountry($country);

        /**
         * @return mixed
         */
        public function getCountry();

        /**
         * Get ShopId.
         *
         * @return int
         */
        public function getShopId();

        /**
         * Set ShopId.
         *
         * @return $this
         */
        public function setShopId($shopId);

        /**
         * Get Name.
         *
         * @return string
         */
        public function getName();

        /**
         * Set Name.
         *
         * @return $this
         */
        public function setName($name);

        /**
         * Get Identifier.
         *
         * @return string
         */
        public function getIdentifier();

        /**
         * Set Identifier.
         *
         * @return $this
         */
        public function setIdentifier($identifier);

        /**
         * Get Image.
         *
         * @return string|null
         */
        public function getImage();

        /**
         * Set Image.
         *
         * @return $this
         */
        public function setImage($image);

        /**
         * Get ModifiedAt.
         *
         * @return string|null
         */
        public function getUpdatedAt();

        /**
         * Set ModifiedAt.
         *
         * @return $this
         */
        public function setUpdatedAt($updatedAt);

        /**
         * Get CreatedAt.
         *
         * @return string|null
         */
        public function getCreatedAt();

        /**
         * Set CreatedAt.
         *
         * @return $this
         */
        public function setCreatedAt($createdAt);
    }
