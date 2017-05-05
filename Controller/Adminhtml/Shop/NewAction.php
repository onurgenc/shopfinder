<?php
    namespace Ogenc\Shopfinder\Controller\Adminhtml\Shop;

    use Magento\Backend\App\Action;

    class NewAction extends \Magento\Backend\App\Action
    {

        public function execute()
        {
            $this->_forward('edit');
        }
    }
