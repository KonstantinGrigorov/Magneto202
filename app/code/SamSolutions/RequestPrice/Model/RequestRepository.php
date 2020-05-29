<?php

namespace SamSolutions\RequestPrice\Model;

class RequestRepository implements \SamSolutions\RequestPrice\Api\RequestRepositoryInterface
{
    /**
     * @var Resource\Request
     */
    protected $resource;
    /**
     * @var RequestFactory
     */
    protected $requestFactory;
    /**
     * @var Resource\Request\CollectionFactory
     */
    protected $requestCollectionFactory;
    /**
     * @var \SamSolutions\RequestPrice\Api\Data\RequestSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @var \SamSolutions\RequestPrice\Api\Data\RequestInterfaceFactory
     */
    protected $dataRequestFactory;

    /**
     * RequestRepository constructor.
     * @param Resource\Request $resource
     * @param RequestFactory $requestFactory
     * @param \SamSolutions\RequestPrice\Api\Data\RequestInterfaceFactory $dataRequestFactory
     * @param Resource\Request\CollectionFactory $requestCollectionFactory
     * @param \SamSolutions\RequestPrice\Api\Data\RequestSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \SamSolutions\RequestPrice\Model\Resource\Request $resource,
        \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory,
        \SamSolutions\RequestPrice\Api\Data\RequestInterfaceFactory $dataRequestFactory,
        \SamSolutions\RequestPrice\Model\Resource\Request\CollectionFactory $requestCollectionFactory,
        \SamSolutions\RequestPrice\Api\Data\RequestSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->requestFactory = $requestFactory;
        $this->requestCollectionFactory = $requestCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataRequestFactory = $dataRequestFactory;
    }

    /**
     * @param \SamSolutions\RequestPrice\Api\Data\RequestInterface $request
     * @return \SamSolutions\RequestPrice\Api\Data\RequestInterface
     */
    public function save(\SamSolutions\RequestPrice\Api\Data\RequestInterface $request)
    {
        $request->getResource()->save($request);

        return $request;
    }

    /**
     * @param $requestId
     * @return Request
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($requestId)
    {
        $request = $this->requestFactory->create();
        $this->resource->load($request, $requestId);
        if (!$request->getId()) {
            throw new  \Magento\Framework\Exception\NoSuchEntityException(__('Request with id "%1" does not exist.', $requestId));
        }

        return $request;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \SamSolutions\RequestPrice\Api\Data\RequestSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \SamSolutions\RequestPrice\Model\Resource\Request\Collection $collection */
        $collection = $this->requestCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param \SamSolutions\RequestPrice\Api\Data\RequestInterface $request
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\SamSolutions\RequestPrice\Api\Data\RequestInterface $request)
    {
        try {
            $request->getResource()->delete($request);
        } catch (\Exception $exception) {
            throw new  \Magento\Framework\Exception\CouldNotDeleteException(
                __(
                    'Could not delete the request: %1',
                    $exception->getrequest()
                )
            );
        }

        return true;
    }

    /**
     * @param $requestId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($requestId)
    {
        return $this->delete($this->get($requestId));
    }
}