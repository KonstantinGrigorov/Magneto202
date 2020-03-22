<?php
namespace Retail\Contact\Block\Adminhtml\Message\Edit;

/**
 * Class DeleteButton
 */
class DeleteButton extends \Retail\Contact\Block\Adminhtml\Message\Edit\GenericButton implements
    \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete message'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['message_id' => $this->getId()]);
    }
}
