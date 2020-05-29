<?php

namespace SamSolutions\RequestPrice\Controller\Adminhtml\Request;

class Edit extends \SamSolutions\RequestPrice\Controller\Adminhtml\Request
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $requestFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $requestRepository;

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory
     * @param \SamSolutions\RequestPrice\Api\RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory,
        \SamSolutions\RequestPrice\Api\RequestRepositoryInterface $requestRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->requestFactory = $requestFactory;
        $this->requestRepository = $requestRepository;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * @return $this|\Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('request_id');
        // 2. Initial checking
        if ($id) {
            $requestModel = $this->requestRepository->get($id);
            if (!$requestModel->getId()) {
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->_coreRegistry->register('Samsolutions_request', $requestModel);
        }

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit request') : __(''),
            $id ? __('Edit request') : __('')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Request'));
        if (isset($requestModel)) {
            $resultPage->getConfig()->getTitle()
                ->prepend($requestModel->getId() ? $requestModel->getName() : __('New request'));
        }

        return $resultPage;
    }
}