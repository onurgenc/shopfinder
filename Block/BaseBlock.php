<?php
    /**
     * Copyright © 2017 Ogenc . All rights reserved.
     */
    namespace Ogenc\Shopfinder\Block;

    class BaseBlock extends \Magento\Framework\View\Element\Template
    {

        /**
         * @var \Ogenc\Shopfinder\Helper\Data
         */
        protected $_devToolHelper;
        /**
         * @var \Magento\Framework\Url
         */
        protected $_urlApp;
        /**
         * @var \Ogenc\Shopfinder\Model\Config
         */
        protected $_config;

        /**
         * @param \Ogenc\Shopfinder\Block\Context $context
         * @param \Magento\Framework\UrlFactory   $urlFactory
         */
        public function __construct(\Ogenc\Shopfinder\Block\Context $context)
        {
            $this->_devToolHelper = $context->getShopfinderHelper();
            $this->_config = $context->getConfig();
            $this->_urlApp = $context->getUrlFactory()->create();
            parent::__construct($context);
        }

        /**
         * Function for getting event details
         *
         * @return array
         */
        public function getEventDetails()
        {
            return $this->_devToolHelper->getEventDetails();
        }

        /**
         * Function for getting current url
         *
         * @return string
         */
        public function getCurrentUrl()
        {
            return $this->_urlApp->getCurrentUrl();
        }

        /**
         * Function for getting controller url for given router path
         *
         * @param string $routePath
         *
         * @return string
         */
        public function getControllerUrl($routePath)
        {
            return $this->_urlApp->getUrl($routePath);
        }

        /**
         * Function for getting current url
         *
         * @param string $path
         *
         * @return string
         */
        public function getConfigValue($path)
        {
            return $this->_config->getCurrentStoreConfigValue($path);
        }

        /**
         * Function canShowShopfinder
         *
         * @return bool
         */
        public function canShowShopfinder()
        {
            $isEnabled = $this->getConfigValue('shopfinder/module/is_enabled');
            if ($isEnabled) {
                $allowedIps = $this->getConfigValue('shopfinder/module/allowed_ip');
                if (is_null($allowedIps)) {
                    return true;
                } else {
                    $remoteIp = $_SERVER['REMOTE_ADDR'];
                    if (strpos($allowedIps, $remoteIp) !== false) {
                        return true;
                    }
                }
            }

            return false;
        }
    }
