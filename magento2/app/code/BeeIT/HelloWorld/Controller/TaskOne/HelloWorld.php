<?php

namespace BeeIT\HelloWorld\Controller\TaskOne;

use Magento\Customer\Model\Session;

class HelloWorld implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private Session $cSession;
    public function __construct(Session $cSession)
    {
        $this->customerSession2 = $cSession;
    }

    public function getCustomerID()
    {
        $objManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objManager->get('Magento\Customer\Model\Session');
        return $customerSession->getCustomer()->getId();
    }

    public function execute()
    {
        $customerID = $this->getCustomerID();
        $customerID2 = $this->customerSession2->getCustomerId();
        if ($customerID) {
            echo "Hello customer $customerID";
        }
        if ($customerID2) {
            echo "Hello $customerID2";
        }
        exit;
    }
}
