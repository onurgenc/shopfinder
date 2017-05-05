<?php
/**
 * Copyright © 2017 Ogenc. All rights reserved.
 */
    namespace Ogenc\Shopfinder\Setup;

    use Magento\Framework\DB\Adapter\AdapterInterface;
    use Magento\Framework\DB\Ddl\Table;
    use Magento\Framework\Setup\InstallSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;

    /**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'shopfinder_shop'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('shopfinder_shop')
        )
		->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'shopfinder_shop'
        )->addColumn(
            'store_id',
            Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false], 'Store ID'
        )
		->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable => false'],
            'Shop Name'
        )
		->addColumn(
            'identifier',
            Table::TYPE_TEXT,
            255,
            ['nullable => false'],
            'Identifier'
        )
		->addColumn(
            'country',
            Table::TYPE_TEXT,
            255,
            [],
            'Country'
        )
		->addColumn(
            'image',
            Table::TYPE_TEXT,
            255,
            [],
            'Image'
        )
		->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false],
            'Created at'
        )
		->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false],
            'Updated at'
        )
        ->addIndex(
            $installer->getIdxName('shopfinder_shops_store',
                ['identifier'], AdapterInterface::INDEX_TYPE_UNIQUE), ['identifier'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE])
        ->addIndex(
            $installer->getIdxName('shopfinder_shops_store',['store_id']),
                ['store_id']
        )
        ->setComment(
            'Ogenc Shopfinder shopfinder_shop'
        );

		$installer->getConnection()->createTable($table);
		$installer->endSetup();

    }
}
