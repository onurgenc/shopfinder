<?php
    namespace Ogenc\Shopfinder\Controller\Adminhtml\Shop;

    class Delete extends \Magento\Backend\App\Action
    {

        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        public function execute()
        {
            $id = $this->getRequest()->getParam('id');
            try {
                $shop = $this->_objectManager->get('Ogenc\Shopfinder\Model\Shop')->load($id);
                $shop->delete();
                $this->messageManager->addSuccess(__('Shop deleted'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
            $this->_redirect('*/*/');
        }
    }
