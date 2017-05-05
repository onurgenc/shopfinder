<?php
    namespace Ogenc\Shopfinder\Block\Adminhtml\Shop;

    class Edit extends \Magento\Backend\Block\Widget\Form\Container
    {

        protected function _construct()
        {
            $this->_objectId = 'id';
            $this->_blockGroup = 'Ogenc_Shopfinder';
            $this->_controller = 'adminhtml_shop';
            parent::_construct();
            $this->buttonList->update('save', 'label', __('Save Shop'));
            $this->buttonList->update('delete', 'label', __('Delete Shop'));
            $this->buttonList->add('saveandcontinue', [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ],
            ], -100);
        }
    }
