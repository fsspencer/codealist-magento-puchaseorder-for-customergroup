<?php


class Codealist_PurchaseOrderForCustomerGroup_Model_Observer
{
    public function paymentMethodIsActive(Varien_Event_Observer $observer)
    {
        /* call get payment method */
        $method = $observer->getEvent()->getMethodInstance();
        $customerGroupCode = 'wholesale';

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {

            $roleId = Mage::getSingleton('customer/session')->getCustomerGroupId();
            $role = Mage::getSingleton('customer/group')->load($roleId)->getData('customer_group_code');

            if ($method->getCode() == 'purchaseorder') {
                $quote = $observer->getEvent()->getQuote();

                if (strtolower($role) == strtolower($customerGroupCode)) {
                    $result = $observer->getEvent()->getResult();
                    $result->isAvailable = true;
                    return;
                } else {
                    $result = $observer->getEvent()->getResult();
                    $result->isAvailable = false;
                }
            }
        } else {
            if ($method->getCode() == 'purchaseorder') {
                $result = $observer->getEvent()->getResult();
                $result->isAvailable = false;
            }
        }
    }
}