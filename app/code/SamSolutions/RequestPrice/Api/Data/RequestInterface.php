<?php
namespace SamSolutions\RequestPrice\Api\Data;

interface RequestInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const REQUEST_ID = 'request_id';
    const REQUEST_STATUS = 'status';
    const REQUEST_NAME = 'name';
    const REQUEST_EMAIL = 'email';
    const REQUEST_COMMENT = 'comment';
    const REQUEST_SKU = 'request_sku';
    const REQUEST_CREATED = 'creation_time';


    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getComment();

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
     * Get sku
     *
     * @return string|null
     */
    public function getSku();

    /**
     * Get date
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
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment);

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
     * Set sku
     *
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku);

    /**
     * Set date of creation
     *
     * @param string $created
     *
     * @return $this
     */
    public function setCreated($created);

}