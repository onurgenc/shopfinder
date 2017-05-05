<?php
    namespace Ogenc\Shopfinder\Block\Adminhtml;

    class Shop extends \Magento\Backend\Block\Widget\Grid\Container
    {

        /**
         * Constructor
         *
         * @return void
         */
        protected function _construct()
        {
            $this->_controller = 'adminhtml_shop';/*block grid.php directory*/
            $this->_blockGroup = 'Ogenc_Shopfinder';
            $this->_headerText = __('Shop');
            $this->_addButtonLabel = __('Add New Shop');
            parent::_construct();
        }
    }
