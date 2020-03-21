<?php

namespace Retail\Contact\Model;

class MessageRepository implements \Retail\Contact\Api\MessageRepositoryInterface
{
    /**
     * @var ResourceMessage
     */
    protected $resource;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var MessageCollectionFactory
     */
    protected $messageCollectionFactory;

    /**
     * @var Data\MessageSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Magento\Cms\Api\Data\MessageInterfaceFactory
     */
    protected $dataMessageFactory;

    public function __construct(
        \Retail\Contact\Model\Resource\Message $resource,
        \Retail\Contact\Model\MessageFactory $messageFactory,
        \Retail\Contact\Api\Data\MessageInterfaceFactory $dataMessageFactory,
        \Retail\Contact\Model\Resource\Message\CollectionFactory $messageCollectionFactory,
        \Retail\Contact\Api\Data\MessageSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->messageFactory = $messageFactory;
        $this->messageCollectionFactory = $messageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataMessageFactory = $dataMessageFactory;
    }

    public function save(\Retail\Contact\Api\Data\MessageInterface $message)
    {
        $message->getResource()->save($message);

        return $message;
    }

    public function get($messageId)
    {
        $message = $this->messageFactory->create();
        $this->resource->load($message, $messageId);
        if (!$message->getId()) {
            throw new  \Magento\Framework\Exception\NoSuchEntityException(__('Message with id "%1" does not exist.', $messageId));
        }

        return $message;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Retail\Contact\Model\Resource\Message\Collection $collection */
        $collection = $this->messageCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(\Retail\Contact\Api\Data\MessageInterface $message)
    {
        try {
            $message->getResource()->delete($message);
        } catch (\Exception $exception) {
            throw new  \Magento\Framework\Exception\CouldNotDeleteException(
                __(
                    'Could not delete the message: %1',
                    $exception->getMessage()
                )
            );
        }

        return true;
    }

    public function deleteById($messageId)
    {
        return $this->delete($this->get($messageId));
    }
}