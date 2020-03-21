<?php
namespace Retail\Contact\Model\Resource;

class Message extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('retail_contact_message', 'message_id');
    }
}