<?php

namespace Smile\Contact\Setup;

use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('contact_message');
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
                'message_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Message id'
            )
            ->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '0',
                ],
                'Message status'
            )
            ->addColumn(
                'username',
                Table::TYPE_TEXT,
                null,
                [
                    'length' => 255,
                    'nullable' => false,
                ],
                'User name'
            )
            ->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => false,
                ],
                'Message content'
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
                'phone',
                Table::TYPE_TEXT,
                null,
                [
                    'length' => 255,
                    'nullable' => false,
                ],
                'User phone number'
            )
            ->addColumn(
                'creation_time',
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false,
                ],
                'Message creation time'
            )
            ->setComment('Contact us table');
        $installer->getConnection()->createTable($table);
    }
}