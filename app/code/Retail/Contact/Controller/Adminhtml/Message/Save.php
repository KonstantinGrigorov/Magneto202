<?php
namespace Retail\Contact\Controller\Adminhtml\Message;

class Save extends \Retail\Contact\Controller\Adminhtml\Message
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Retail\Contact\Model\MessageFactory
     */
    private $messageFactory;

    /**
     * @var \Retail\Contact\Model\MessageRepository
     */
    private $messageRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Retail\Contact\Model\MessageFactory $messageFactory
     * @param \Retail\Contact\Model\MessageRepository $messageRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Retail\Contact\Model\NoticeRepository $messageRepository,
        \Retail\Contact\Model\NoticeFactory $messageFactory
    ) {
        $this->messageRepository = $messageRepository;
        $this->messageFactory = $messageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $messageData = $data['message'];
        if ($messageData) {
            $messageModel = $this->messageFactory->create();

            if (array_key_exists('message_id', $messageData)) {
                $id = $messageData['message_id'];
                if ($id) {
                    try {
                        $messageModel = $this->messageRepository->get($id);
                    } catch (\Magento\Framework\Exception\LocalizedException $e) {
                        $this->messageManager->addErrorMessage(__('This notice no longer exists.'));

                        return $resultRedirect->setPath('*/*/');
                    }
                }
            }
            $messageModel->setData($messageData);
            try {
                $this->messageRepository->save($messageModel);
                $this->messageManager->addSuccessMessage(__('You saved the message.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['message_id' => $messageModel->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the notice.'));
            }

            return $resultRedirect->setPath(
                '*/*/edit',
                ['message_id' => $this->getRequest()->getParam('message_id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}