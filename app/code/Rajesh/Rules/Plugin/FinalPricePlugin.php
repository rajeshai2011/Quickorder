<?php
namespace Rajesh\Rules\Plugin;

class FinalPricePlugin
{
    public function beforeSetTemplate(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, $template)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      
     
            if ($template == 'Magento_Catalog::product/price/final_price.phtml') {
                return ['Rajesh_Rules::product/price/final_price.phtml'];
            } 
            else
            {
                return [$template];
            }
       
    }
}
