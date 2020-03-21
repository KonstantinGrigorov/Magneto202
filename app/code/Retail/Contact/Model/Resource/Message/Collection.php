<?php
namespace Retail\Contact\Model\Resource\Message;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Retail\Contact\Model\Message',
            'Retail\Contact\Model\Resource\Message'
        );
    }
}
