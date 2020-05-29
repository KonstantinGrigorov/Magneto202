<?php
namespace SamSolutions\RequestPrice\Model\Resource;

class Request extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('samsolutions_requestprice', 'request_id');
    }
}