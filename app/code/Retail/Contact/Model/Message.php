<?php

namespace Retail\Contact\Model;

class Message extends \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface,
    \Retail\Contact\Api\Data\MessageInterface
{
    const MESSAGE_CACHE_TAG = 'retail_contact';

     /**#@+
     * Post's Statuses
     */
    const STATUS_ANSWERED = 1;
    const STATUS_OPEN = 0;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    public $eventPrefix = 'retail_contact';

    protected function _construct()
    {
        $this->_init(\Retail\Contact\Model\Resource\Message::class);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::MESSAGE_ID);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getData(self::MESSAGE_USERNAME);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::MESSAGE_CONTENT);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::MESSAGE_STATUS);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::MESSAGE_EMAIL);
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getData(self::MESSAGE_PHONE);
    }

    /**
     * @return string
     */
    public function getRetail()
    {
        return $this->getData(self::MESSAGE_RETAIL);
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->getData(self::MESSAGE_CREATED);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::MESSAGE_CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @param int $id
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setId($id)
    {
        return $this->setData(self::MESSAGE_ID, $id);
    }

    /**
     * @param string $username
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setUsername($username)
    {
        return $this->setData(self::MESSAGE_USERNAME, $username);
    }

    /**
     * @param string $content
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setContent($content)
    {
        return $this->setData(self::MESSAGE_CONTENT, $content);
    }

    /**
     * @param int $status
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setStatus($status)
    {
        return $this->setData(self::MESSAGE_STATUS, $status);
    }

    /**
     * @param string $email
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setEmail($email)
    {
        return $this->setData(self::MESSAGE_EMAIL, $email);
    }

    /**
     * @param string $phone
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setPhone($phone)
    {
        return $this->setData(self::MESSAGE_PHONE, $phone);
    }

    /**
     * @param string $retail
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setRetail($retail)
    {
        return $this->setData(self::MESSAGE_RETAIL, $retail);
    }

    /**
     * @param string $created
     *
     * @return \Retail\Contact\Api\Data\MessageInterface|Message
     */
    public function setCreated($created)
    {
        return $this->setData(self::MESSAGE_CREATED, $created);
    }

    /**
     * @return array
     */
   public function getAvailableStatuses()
   {
       return [self::STATUS_ANSWERED => __('answered'), self::STATUS_OPEN => __('need to answer')];
   }

}