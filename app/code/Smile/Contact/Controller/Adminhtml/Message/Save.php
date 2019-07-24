<?php
namespace Smile\Contact\Controller\Adminhtml\Message;

class Save extends \Smile\Contact\Controller\Adminhtml\Message
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Smile\Contact\Model\MessageFactory
     */
    private $messageFactory;

    /**
     * @var \Smile\Contact\Model\MessageRepository
     */
    private $messageRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Smile\Contact\Model\MessageFactory $messageFactory
     * @param \Smile\Contact\Model\MessageRepository $messageRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Smile\Contact\Model\NoticeRepository $messageRepository,
        \Smile\Contact\Model\NoticeFactory $messageFactory
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

            //$noticePageArr = $messageData['notice_page'];
            // $noticePageStr = implode(",", $noticePageArr);
            // $messageData['notice_page'] = $noticePageStr;
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
               // $this->dataPersistor->clear('bfm_notice');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['message_id' => $messageModel->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the notice.'));
            }

          //  $this->dataPersistor->set('bfm_notice', $noticeData);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['message_id' => $this->getRequest()->getParam('message_id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}