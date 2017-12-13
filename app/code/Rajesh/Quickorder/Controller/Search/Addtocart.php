<?php

namespace Rajesh\Quickorder\Controller\Search;

class Addtocart  extends \Magento\Framework\App\Action\Action
{
         protected $cart;
         protected $product;

         public function __construct(
            \Magento\Framework\App\Action\Context $context,
             \Magento\Framework\View\Result\PageFactory $resultPageFactory,
             \Magento\Catalog\Model\Product $product,
             \Magento\Checkout\Model\Cart $cart
         ) {
             $this->resultPageFactory = $resultPageFactory;
             $this->cart = $cart;
             $this->product = $product;
             parent::__construct($context);
         }
         public function execute()
         {
            try {
            for ($i = 0; $i < sizeof($_POST['prod_id']); $i++) {
                if($_POST['prod_id'][$i]>0 && $_POST['quality'][$i]>0){
                $pId = $_POST['prod_id'][$i];
                $_product = $this->product->load($pId);
                $qty = $_POST['quality'][$i];
                if ($_product) {
                     $this->cart->addProduct($_product,array('qty' =>$qty));
                     $this->cart->save();
                 }
                    $this->messageManager->addSuccess(__('Add to cart successfully.'));
                }
               // $product->unsetData();
             }

             } catch (\Magento\Framework\Exception\LocalizedException $e) {
                 $this->messageManager->addException(
                     $e,
                     __('%1', $e->getMessage())
                 );
             } catch (\Exception $e) {
                 $this->messageManager->addException($e, __('error.'));
             }
          

           $RedirectUrl = $this->_url->getUrl('checkout/cart');
        $this->getResponse()->setRedirect($RedirectUrl)->sendResponse();
        die();
            


         }



}