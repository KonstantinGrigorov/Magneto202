<?php
namespace Smile\Contact\Model\Notice\Source;

class MessageStatus implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Smile\Contact\Model\Message
     */
    protected $message;

    /**
     * Constructor
     *
     * @param \Smile\Contact\Model\Message $message
     */
    public function __construct(\Smile\Contact\Model\Message $message)
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
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
