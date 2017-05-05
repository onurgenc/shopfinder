<?php
namespace Ogenc\Shopfinder\Block\Adminhtml\Shop\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('ogenc_shop_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Shop Information'));
    }
}
