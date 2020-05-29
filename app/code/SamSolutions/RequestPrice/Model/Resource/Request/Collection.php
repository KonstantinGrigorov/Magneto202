<?php
namespace SamSolutions\RequestPrice\Model\Resource\Request;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'SamSolutions\RequestPrice\Model\Request',
            'SamSolutions\RequestPrice\Model\Resource\Request'
        );
    }
}
