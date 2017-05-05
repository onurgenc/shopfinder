<?php
    namespace Ogenc\Shopfinder\Block\Adminhtml\Shop\Edit\Tab;

    use Magento\Directory\Model\Config\Source\Country;

    class Edit extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
    {

        /**
         * @var \Magento\Store\Model\System\Store
         */
        protected $_systemStore;
        public $countryHelper;

        /**
         * @param \Magento\Backend\Block\Template\Context $context
         * @param \Magento\Framework\Registry             $registry
         * @param \Magento\Framework\Data\FormFactory     $formFactory
         * @param \Magento\Store\Model\System\Store       $systemStore
         * @param array                                   $data
         */
        public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Magento\Framework\Registry $registry,
            \Magento\Framework\Data\FormFactory $formFactory,
            \Magento\Store\Model\System\Store $systemStore,
            Country $countryHelper,
            array $data = []
        ) {
            $this->_systemStore = $systemStore;
            $this->countryHelper = $countryHelper;
            parent::__construct($context, $registry, $formFactory, $data);
        }

        /**
         * Prepare form
         *
         * @return $this
         */
        protected function _prepareForm()
        {
            /* @var $model \Magento\Cms\Model\Page */
            $model = $this->_coreRegistry->registry('shopfinder_shop');
            $isElementDisabled = false;
            /** @var \Magento\Framework\Data\Form $form */
            $form = $this->_formFactory->create();
            $form->setHtmlIdPrefix('page_');
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Edit')]);
            if ($model->getId()) {
                $fieldset->addField('id', 'hidden', ['name' => 'id']);
            }
            $fieldset->addField('name', 'text', [
                'name' => 'name',
                'label' => __('Shop Name'),
                'title' => __('Shop Name'),
                'required' => true,
            ]);
            $fieldset->addField('identifier', 'text', [
                'name' => 'identifier',
                'label' => __('Identifier'),
                'title' => __('Identifier'),
                'required' => true,
            ]);
            $fieldset->addField('country', 'select', [
                'name' => 'country',
                'label' => __('Country'),
                'title' => __('Country'),
                'values' => $this->getCountries(),
            ]);
            $fieldset->addField('store_id', 'select', [
                'name' => 'store_id',
                'label' => __('Store Views'),
                'title' => __('Store Views'),
                'required' => true,
                'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                "size" => 10,
            ]);
            $fieldset->addField('image', 'image', [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
            ]);
            if (!$model->getId()) {
                $model->setData('status', $isElementDisabled ? '2' : '1');
            }
            $form->setValues($model->getData());
            $this->setForm($form);

            return parent::_prepareForm();
        }

        /**
         * Prepare country list
         *
         * @return array
         */
        public function getCountries()
        {
            $loadCountries = $this->countryHelper->toOptionArray();
            $countries = [];
            $i = 0;
            foreach ($loadCountries as $country) {
                $i++;
                if ($i == 1) { //remove first element that is a select
                    continue;
                }
                $countries[$country["value"]] = $country["label"];
            }

            return $countries;
        }

        /**
         * Prepare label for tab
         *
         * @return string
         */
        public function getTabLabel()
        {
            return __('Edit');
        }

        /**
         * Prepare title for tab
         *
         * @return string
         */
        public function getTabTitle()
        {
            return __('Edit');
        }

        /**
         * @return bool
         */
        public function canShowTab()
        {
            return true;
        }

        /**
         * @return bool
         */
        public function isHidden()
        {
            return false;
        }

        /**
         * Check permission for passed action
         *
         * @param string $resourceId
         *
         * @return bool
         */
        protected function _isAllowedAction($resourceId)
        {
            return $this->_authorization->isAllowed($resourceId);
        }
    }
