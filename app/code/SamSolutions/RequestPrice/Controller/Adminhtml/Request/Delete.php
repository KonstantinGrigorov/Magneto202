<?php

namespace SamSolutions\RequestPrice\Controller\Adminhtml\Request;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \SamSolutions\RequestPrice\Model\RequestRepository
     */
    private $requestRepository;

    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository
    ) {
        $this->requestRepository = $requestRepository;
        parent::__construct($context);
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('request_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $request = $this->requestRepository->get($id);
                $this->requestRepository->delete($request);
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                return $resultRedirect->setPath('*/*/edit', ['request_id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/');
        
    }
}
