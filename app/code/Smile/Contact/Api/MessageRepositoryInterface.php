<?php
namespace Smile\Contact\Api;

interface MessageRepositoryInterface
{
    /**
     * Save message.
     *
     * @param \Smile\Contact\Api\Data\MessageInterface $message
     *
     * @return \Smile\Contact\Api\Data\MessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Smile\Contact\Api\Data\MessageInterface $message);

    /**
     * Retrieve message.
     *
     * @param int $messageId
     *
     * @return \Smile\Contact\Api\Data\MessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($messageId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete message.
     *
     * @param \Smile\Contact\Api\Data\MessageInterface $message
     *
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Smile\Contact\Api\Data\MessageInterface $message);

    /**
     * Delete notice by ID.
     *
     * @param int $noticeId
     *
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($noticeId);
}