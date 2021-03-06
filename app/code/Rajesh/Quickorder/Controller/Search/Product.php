<?php

namespace Rajesh\Quickorder\Controller\Search;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;


class Product extends \Magento\Framework\App\Action\Action
{

protected $_productCollectionFactory;
protected $resultJsonFactory;

public function __construct(
     Context $context,  
     \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,    
     CollectionFactory $productCollectionFactory    
   
)
{    
    parent::__construct($context);
    $this->resultJsonFactory = $resultJsonFactory;
    $this->_productCollectionFactory = $productCollectionFactory;    
  
}

public function execute()
{
        $result = $this->resultJsonFactory->create();
        $search_text = $this->getRequest()->getPost('search_text');
        $productcollection = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
                 ->addAttributeToSelect(['name', 'price', 'image'])
                 // ->addAttributeToFilter('name', array('like' => '%'.$search_text.'%'))
		 ->addAttributeToFilter([
	      					['attribute' => 'name', 'like' => '%'.$search_text.'%'],
	     					['attribute' => 'sku', 'like' => '%'.$search_text.'%']
      					])
                 ->setPageSize(10,1);

        $productcollections =array();
        foreach ($productcollection as $product) {
            $productcollections[] = array('id'=> $product->getId(),'name'=>$product->getName());
        }

          $resultdata = array('products' => $productcollections);

    return $result->setData($resultdata);
}


}
