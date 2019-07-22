<?php 
namespace Smile\Contact\Controller\Index;

class Post extends \Magento\Contact\Controller\Index
{
    /**
     * message user question
     *
     * @return void
     * @throws \Exception
     */

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
 //       \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Smile\Contact\Model\MessageRepository $messageRepository,
        \Smile\Contact\Model\MessageFactory $messageFactory
    ) {
 //       $this->dataPersistor = $dataPersistor;
        $this->messageRepository = $messageRepository;
        $this->messageFactory = $messageFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }
 //       var_dump($data);die;

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
//        $messageData = $data['message'];
//        if ($messageData) {
            $data = $this->messageFactory->create();
//            if (array_key_exists('message_id', $data)) {
//                $id = $messageData['message_id'];
//                if ($id) {
//                    try {
//                        $messageModel = $this->messageRepository->get($id);
//                    } catch (\Magento\Framework\Exception\LocalizedException $e) {
//                        $this->messageManager->addErrorMessage(__('This message no longer exists.'));
//
//                        return $resultRedirect->setPath('*/*/');
//                    }
//                }
//            }
            $messageModel->setData($data);
            try {
                $this->messageRepository->save($messageModel);
//               $this->messageManager->addSuccessMessage(__('You saved the message.'));
  //              $this->dataPersistor->clear('contact_message');
//                if ($this->getRequest()->getParam('back')) {
//                    return $resultRedirect->setPath('*/*/edit', ['message_id' => $messageModel->getId()]);
//                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the message.'));
            }

 //           $this->dataPersistor->set('contact_message', $data);

//            return $resultRedirect->setPath(
//                '*/*/edit',
//                ['message_id' => $this->getRequest()->getParam('message_id')]
//            );

            $this->inlineTranslation->suspend();
            try {
                $messageObject = new \Magento\Framework\DataObject();
                $messageObject->setData($data);

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
                $this->messageManager->addSuccess('Message from new controller4.');


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
//        }
    }
}
