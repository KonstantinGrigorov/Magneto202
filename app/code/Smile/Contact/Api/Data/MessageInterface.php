<?php
namespace Smile\Contact\Api\Data;

interface MessageInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const MESSAGE_ID = 'message_id';
    const MESSAGE_STATUS = 'status';
    const MESSAGE_USERNAME = 'username';
    const MESSAGE_CONTENT = 'content';
    const MESSAGE_EMAIL = 'email';
    const MESSAGE_PHONE = 'phone';
    const MESSAGE_CREATED = 'creation_time';


    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get username
     *
     * @return string|null
     */
    public function getUsername();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get notice status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Get end date
     *
     * @return string|null
     */
    public function getCreated();


    /**
     * Set ID
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Set username
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username);

    /**
     * Set content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * Set status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set user email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email);

    /**
     * Set user phone
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Set date of creation
     *
     * @param string $created
     *
     * @return $this
     */
    public function setCreated($created);

}