<?php
namespace Smile\Contact\Api\Data;

interface MessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * -     * Get notice list.
     * -     *
     * -     * @return \Smile\Contact\Api\Data\MessageInterface[]
     * -     */

    public function getItems();

    /**
     * -     * Set notice list.
     * -     *
     * -     * @param \Smile\Contact\Api\Data\MessageInterface[] $items
     * -     *
     * -     * @return $this
     * -     */

    public function setItems(array $items);
}
