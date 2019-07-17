<?php
namespace Smile\Contact\Model\Resource;

class Message extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('contact_message', 'message_id');
    }
}