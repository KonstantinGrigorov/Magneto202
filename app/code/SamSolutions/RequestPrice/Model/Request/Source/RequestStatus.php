<?php
namespace SamSolutions\RequestPrice\Model\Request\Source;

class RequestStatus implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \SamSolutions\RequestPrice\Model\Request
     */
    protected $request;

    /**
     * RequestStatus constructor.
     * @param \SamSolutions\RequestPrice\Model\Request $request
     */
    public function __construct( \SamSolutions\RequestPrice\Model\Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
     public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];

        $availableOptions = $this->request->getAvailableStatuses();

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
