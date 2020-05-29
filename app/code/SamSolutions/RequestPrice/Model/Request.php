<?php

namespace SamSolutions\RequestPrice\Model;

class Request extends \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface,
    \SamSolutions\RequestPrice\Api\Data\RequestInterface
{
    /**
     *
     */
    const REQUEST_CACHE_TAG = 'samsolutions_request';
    const STATUS_INPROGRESS = 2;
    const STATUS_CLOSED = 1;
    const STATUS_NEW = 0;

    /**
     * @var string
     */
    public $eventPrefix = 'samsolutions_request';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(\SamSolutions\RequestPrice\Model\Resource\Request::class);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getData(self::REQUEST_ID);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->getData(self::REQUEST_NAME);
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->getData(self::REQUEST_CONTENT);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getData(self::REQUEST_STATUS);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getData(self::REQUEST_EMAIL);
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->getData(self::REQUEST_SKU);
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->getData(self::REQUEST_CREATED);
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::REQUEST_CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @param int|mixed $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::REQUEST_ID, $id);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::REQUEST_NAME, $name);
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(self::REQUEST_CONTENT, $comment);
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::REQUEST_STATUS, $status);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::REQUEST_EMAIL, $email);
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(self::REQUEST_SKU, $sku);
    }

    /**
     * @param string $created
     * @return $this
     */
    public function setCreated($created)
    {
        return $this->setData(self::REQUEST_CREATED, $created);
    }

    /**
     * @return array
     */
   public function getAvailableStatuses()
   {
       return [self::STATUS_NEW => __('New'), self::STATUS_INPROGRESS => __('In progress'),
           self::STATUS_CLOSED => __('Closed')];
   }

}