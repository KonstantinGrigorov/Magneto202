<?php
namespace Retail\Contact\Model\Message\Source;

class MessageStatus implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Retail\Contact\Model\Message
     */
    protected $message;

    /**
     * Constructor
     *
     * @param \Retail\Contact\Model\Message $message
     */
    public function __construct(\Retail\Contact\Model\Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];

        $availableOptions = $this->message->getAvailableStatuses();
       // var_dump($availableOptions);die;
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
