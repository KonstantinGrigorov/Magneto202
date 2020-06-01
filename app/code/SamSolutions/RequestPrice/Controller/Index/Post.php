<?php
namespace SamSolutions\RequestPrice\Controller\Index;

class Post extends \Magento\Contact\Controller\Index
{
    /**
     * @var \SamSolutions\RequestPrice\Model\RequestFactory
     */
    private $requestFactory;
    /**
     * @var \SamSolutions\RequestPrice\Model\RequestRepository
     */
    private $requestRepository;

    /**
     * Post constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository
     * @param \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \SamSolutions\RequestPrice\Model\RequestRepository $requestRepository,
        \SamSolutions\RequestPrice\Model\RequestFactory $requestFactory
    ) {
        $this->requestRepository = $requestRepository;
        $this->requestFactory = $requestFactory;
        parent::__construct($context, $transportBuilder, $inlineTranslation,$scopeConfig,$storeManager);
    }

    /**
     *
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }
        $this->inlineTranslation->suspend();
        try {

            $error = false;

            if (!\Zend_Validate::is(trim($data['name']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($data['email']), 'EmailAddress')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }
            $this->inlineTranslation->resume();

            $requestModel = $this->requestFactory->create();

            $requestData = array('name'=>$data['name'],
                'email'=>$data['email'],
                'comment'=>$data['comment'],
                'request_sku'=>$data['request_sku']
            );
            $requestModel->setData($requestData);
            try {
                $this->requestRepository->save($requestModel);
                $this->messageManager->addSuccess('Thanks for requestin price! We\'ll respond to you very soon.');

            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while requesting the price.'));
            }
            return $this->_redirect($this->_redirect->getRefererUrl());

        } catch (\Exception $e) {
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            return $this->_redirect($this->_redirect->getRefererUrl());
        }
    }
}