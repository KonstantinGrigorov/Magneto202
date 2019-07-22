<?php

namespace Smile\Contact\Model;

class MessageRepository implements \Smile\Contact\Api\MessageRepositoryInterface
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

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        \Smile\Contact\Model\Resource\Message $resource,
        \Smile\Contact\Model\MessageFactory $messageFactory,
        \Smile\Contact\Api\Data\MessageInterfaceFactory $dataMessageFactory,
        \Smile\Contact\Model\Resource\Message\CollectionFactory $messageCollectionFactory,
        \Smile\Contact\Api\Data\MessageSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->messageFactory = $messageFactory;
        $this->messageCollectionFactory = $messageCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataMessageFactory = $dataMessageFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(\Smile\Contact\Api\Data\MessageInterface $message)
    {
        $message->getResource()->save($message);

        return $message;
    }

    public function get($messageId)
    {
        $message = $this->messageFactory->create();
        $this->resource->load($message, $messageId);
        if (!$message->getId()) {
            throw new NoSuchEntityException(__('Message with id "%1" does not exist.', $messageId));
        }

        return $message;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Smile\Contact\Model\Resource\Message\Collection $collection */
        $collection = $this->messageCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(\Smile\Contact\Api\Data\MessageInterface $message)
    {
        try {
            $message->getResource()->delete($message);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
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