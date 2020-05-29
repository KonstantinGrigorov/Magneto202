<?php

namespace SamSolutions\RequestPrice\Setup;

use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('samsolutions_requestprice');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $this->installContactScheme($installer, $tableName);
        }

        $installer->endSetup();
    }

    private function installContactScheme($installer, $tableName)
    {

        $table = $installer->getConnection()
            ->newTable($tableName)
            ->addColumn(
                'request_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Request id'
            )
            ->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '0',
                ],
                'Request status'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [
                    'length' => 255,
                    'nullable' => false,
                ],
                'User name'
            )
            ->addColumn(
                'email',
                Table::TYPE_TEXT,
                null,
                [
                    'length' => 255,
                    'nullable' => false,
                ],
                'User email'
            )
            ->addColumn(
                'comment',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Comment'
            )
            ->addColumn(
                'request_sku',
                Table::TYPE_TEXT,
                null,
                [
                    'length' => 255,
                    'nullable' => false,
                ],
                'Product SKU'
            )
            ->addColumn(
                'creation_time',
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false,
                ],
                'Request creation time'
            )
            ->setComment('Request price table');
        $installer->getConnection()->createTable($table);
    }
}