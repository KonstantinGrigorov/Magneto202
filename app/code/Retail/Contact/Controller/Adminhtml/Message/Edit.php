<?php

namespace Retail\Contact\Controller\Adminhtml\Message;

class Edit extends \Retail\Contact\Controller\Adminhtml\Message
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $messageFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $messageRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Retail\Contact\Model\MessageFactory $messageFactory,
        \Retail\Contact\Api\MessageRepositoryInterface $messageRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->messageFactory = $messageFactory;
        $this->messageRepository = $messageRepository;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit message
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('message_id');

        // 2. Initial checking
        if ($id) {
            $messageModel = $this->messageRepository->get($id);
            if (!$messageModel->getId()) {
                $this->messageManager->addError(__('This message no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->_coreRegistry->register('Retail_message', $messageModel);
        }

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit message') : __(''),
            $id ? __('Edit message') : __('')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Message'));
        if (isset($messageModel)) {
            $resultPage->getConfig()->getTitle()
                ->prepend($messageModel->getId() ? $messageModel->getName() : __('New message'));
        }

        return $resultPage;
    }
}