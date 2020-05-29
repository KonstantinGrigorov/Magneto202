<?php
namespace SamSolutions\RequestPrice\Api;

interface RequestRepositoryInterface
{
    /**
     * @param Data\RequestInterface $request
     * @return mixed
     */
    public function save(\SamSolutions\RequestPrice\Api\Data\RequestInterface $request);

    /**
     * @param $requestId
     * @return mixed
     */
    public function get($requestId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param Data\RequestInterface $request
     * @return mixed
     */
    public function delete(\SamSolutions\RequestPrice\Api\Data\RequestInterface $request);

    /**
     * @param $requestId
     * @return mixed
     */
    public function deleteById($requestId);
}