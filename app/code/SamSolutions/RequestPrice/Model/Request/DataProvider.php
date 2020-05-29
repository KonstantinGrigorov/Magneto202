<?php
namespace SamSolutions\RequestPrice\Model\Request;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \SamSolutions\RequestPrice\Model\Resource\Request\Collection
     */
    protected $collection;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \SamSolutions\RequestPrice\Model\Resource\Request\CollectionFactory $requestCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \SamSolutions\RequestPrice\Model\Resource\Request\CollectionFactory $requestCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $requestCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = [];

        foreach ($items as $one) {
            $this->loadedData[$one->getId()]['request'] = $one->getData();
        }
        return $this->loadedData;
    }
}
