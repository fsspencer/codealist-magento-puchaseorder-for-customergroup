<?php


$code = 'Wholesale';
$collection = Mage::getModel('customer/group')
    ->getCollection() //get a list of groups
    ->addFieldToFilter('customer_group_code', $code);// filter by group code

$group = Mage::getModel('customer/group')
    ->load($collection->getFirstItem()->getId()); //load the first group with the required code - this may not be neede but it's a good idea in order to make magento dispatch all events and call all methods that usually calls when loading an object

$group->setCode($code); //set the code
$group->save(); //save group