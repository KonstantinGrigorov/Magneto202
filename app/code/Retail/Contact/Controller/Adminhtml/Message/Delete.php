<?php

namespace Retail\Contact\Controller\Adminhtml\Message;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Retail\Contact\Model\NoticeRepository
     */
    private $messageRepository;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Retail\Contact\Model\MessageRepository $messageRepository
    ) {
        $this->messageRepository = $messageRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('message_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $message = $this->messageRepository->get($id);
                $this->messageRepository->delete($message);
                $this->messageManager->addSuccess(__('The message has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());

                return $resultRedirect->setPath('*/*/edit', ['message_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a message to delete.'));

        return $resultRedirect->setPath('*/*/');
        
    }
}
