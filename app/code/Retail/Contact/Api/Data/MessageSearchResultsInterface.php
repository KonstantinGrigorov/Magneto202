<?php
namespace Retail\Contact\Api\Data;

interface MessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * -     * Get message list.
     * -     *
     * @api
     * -     * @return \Smile\Contact\Api\Data\MessageInterface[]
     * -     */

    public function getItems();

    /**
     * -     * Set message list.
     * -     *
     * @api
     * -     * @param \Smile\Contact\Api\Data\MessageInterface[] $items
     * -     *
     * -     * @return $this
     * -     */

    public function setItems(array $items);
}
