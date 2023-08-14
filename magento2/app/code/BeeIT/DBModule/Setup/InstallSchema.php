<?php

namespace BeeIT\DBModule\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('beeit_todocrud_todoitem');

        if (!$installer->getConnection()->isTableExists($tableName)) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'row_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true],
                    'row id'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Description'
                )
                ->addColumn(
                    'date_completed',
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    'date completed'
                )
                ->addColumn(
                    'creation_time',
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    'creation time'
                )
                ->addColumn(
                    'update_time',
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    'update time'
                )
                ->addColumn(
                    'completed',
                    Table::TYPE_BOOLEAN
                )
                ->setComment('Beeit todo crud todo item table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');

            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
