<?php
namespace SamSolutions\RequestPrice\Controller\Adminhtml\Request;

class Save extends \SamSolutions\RequestPrice\Controller\Adminhtml\Request
{
    /**
     * @var
     */
    protected $dataPersistor;

    /**
     * @var \SamSolutions\RequestPrice\Model\RequestFactory
     */
    private $requestFactory;

    /**
     * @var \SamSolutions\RequestPrice\Model\RequestRepository
     */
    private $requestRepository;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository
     * @param \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository,
        \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory
    ) {
        $this->requestRepository = $requestRepository;
        $this->requestFactory = $requestFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * @return $this
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $requestData = $data['request'];
        if ($requestData) {
            $requestModel = $this->requestFactory->create();

            if (array_key_exists('request_id', $requestData)) {
                $id = $requestData['request_id'];
                if ($id) {
                    try {
                        $requestModel = $this->requestRepository->get($id);
                    } catch (\Magento\Framework\Exception\LocalizedException $e) {
                        return $resultRedirect->setPath('*/*/');
                    }
                }
            }
            $requestModel->setData($requestData);
            try {
                $this->requestRepository->save($requestModel);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['request_id' => $requestModel->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
            } catch (\Exception $e) {
            }

            return $resultRedirect->setPath(
                '*/*/edit',
                ['request_id' => $this->getRequest()->getParam('request_id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}