<?php
namespace Smile\Contact\Model\Resource\Message;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Smile\Contact\Model\Message',
            'Smile\Contact\Model\Resource\Message'
        );
    }
}
