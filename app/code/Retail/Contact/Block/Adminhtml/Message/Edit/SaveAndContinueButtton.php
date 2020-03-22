<?php
namespace Retail\Contact\Block\Adminhtml\Message\Edit;

/**
 * Class SaveAndContinueButton
 */
class SaveAndContinueButton extends \Retail\Contact\Block\Adminhtml\Message\Edit\GenericButton implements
    \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
