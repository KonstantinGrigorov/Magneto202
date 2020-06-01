<?php
namespace SamSolutions\RequestPrice\Controller\Ajax;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $request;

    protected $resultJsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \SamSolutions\RequestPrice\Model\RequestFactory $request
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        parent::__construct($context);
    }
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        $data = $this->getRequest()->getParams();
        $request = $this->request->create();
        $request->setData($data);
        if ($request->save()) {
            $this->messageManager->addSuccessMessage(__('You send your request!'));
        } else {
            $this->messageManager->addErrorMessage(__('There was an error during price requesting.'));
        }
        $result->setData(['success' => true]);
        return $result;
    }
}