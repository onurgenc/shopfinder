<?php
    namespace Ogenc\Shopfinder\Setup;

    use Magento\Eav\Setup\EavSetup;
    use Magento\Eav\Setup\EavSetupFactory;
    use Magento\Framework\Setup\InstallDataInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\ModuleDataSetupInterface;

    /**
     * @codeCoverageIgnore
     */
    class InstallData implements InstallDataInterface {

        /**
         * EAV setup factory
         *
         * @var EavSetupFactory
         */
        private $eavSetupFactory;

        /**
         * Init
         *
         * @param EavSetupFactory $eavSetupFactory
         */
        public function __construct( EavSetupFactory $eavSetupFactory ) {
            $this->eavSetupFactory = $eavSetupFactory;
            /* assign object to class global variable for use in other class methods */
        }

        /**
         * {@inheritdoc}
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         */
        public function install( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
            $setup->getConnection()->insert($setup->getTable('store'), [
                'store_id' => 2,
                'name' => 'UAE - English',
                'code' => 'en_ae',
                'website_id' => 1,
                'group_id' => 1,
                'sort_order' => 0,
                'is_active' => 1,
            ]);
            $setup->getConnection()->insert($setup->getTable('store'), [
                'store_id' => 3,
                'name' => 'TR - English',
                'code' => 'en_tr',
                'website_id' => 1,
                'group_id' => 1,
                'sort_order' => 0,
                'is_active' => 1,
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 2,
                'name' => 'Test Shop 1',
                'identifier' => 'shop-1',
                'country' => 'AE',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 2,
                'name' => 'Test Shop 2 foo',
                'identifier' => 'shop-2',
                'country' => 'AE',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 2,
                'name' => 'Test Shop 3',
                'identifier' => 'shop-3',
                'country' => 'AE',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 2,
                'name' => 'Test Shop 4',
                'identifier' => 'shop-4',
                'country' => 'TR',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 2,
                'name' => 'Test Shop foo',
                'identifier' => 'shop-5',
                'country' => 'TR',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 3,
                'name' => 'Test Shop 31',
                'identifier' => 'shop-31',
                'country' => 'AE',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 3,
                'name' => 'Test Shop 41',
                'identifier' => 'shop-41',
                'country' => 'TR',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $setup->getConnection()->insert($setup->getTable('shopfinder_shop'), [
                'store_id' => 3,
                'name' => 'Test Shop foo 1',
                'identifier' => 'shop-51',
                'country' => 'TR',
                'image' => NULL,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
