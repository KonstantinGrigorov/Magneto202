<?php 
namespace Retail\Contact\Controller\Index;

class Post extends \Magento\Contact\Controller\Index
{
    /**
     * message user question
     *
     * @return void
     * @throws \Exception
     */

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
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Retail\Contact\Model\MessageFactory $messageFactory
     * @param \Retail\Contact\Model\MessageRepository $messageRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
         \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Retail\Contact\Model\MessageRepository $messageRepository,
        \Retail\Contact\Model\MessageFactory $messageFactory
    ) {
        $this->messageRepository = $messageRepository;
        $this->messageFactory = $messageFactory;
        parent::__construct($context, $transportBuilder, $inlineTranslation,$scopeConfig,$storeManager);
    }

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
                if (!\Zend_Validate::is(trim($data['comment']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['email']), 'EmailAddress')) {
                    $error = true;
                }
                if (\Zend_Validate::is(trim($data['hideit']), 'NotEmpty')) {
                    $error = true;
                }
                if ($error) {
                    throw new \Exception();
                }
                $this->inlineTranslation->resume();

                $messageModel = $this->messageFactory->create();

                $messageData = array('username'=>$data['name'],
                                    'content'=>$data['comment'],
                                    'email'=>$data['email'],
                                    'phone'=>$data['telephone'],
                                    'retail'=>$data['retail']
                                    );
            
                $messageModel->setData($messageData);

                try {
                        $this->messageRepository->save($messageModel);
                        $this->messageManager->addSuccess('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.');

                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                } catch (\Exception $e) {
                    $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the message.'));
                }

                $this->_redirect('contact/index');
                return;
            } catch (\Exception $e) {
                $this->inlineTranslation->resume();
                $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.')
                );
                $this->_redirect('contact/index');
                return;
            }
    }
}
