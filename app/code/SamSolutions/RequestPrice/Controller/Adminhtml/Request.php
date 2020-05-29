<?php
namespace SamSolutions\RequestPrice\Controller\Adminhtml;

abstract class Request extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const REQUEST_ADMIN_RESOURCE = 'SamSolutions_RequestPrice::request';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Request constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @param $resultPage
     * @return mixed
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('SamSolutions_RequestPrice::request')
            ->addBreadcrumb(__('Request'), __('Request'));

        return $resultPage;
    }
}