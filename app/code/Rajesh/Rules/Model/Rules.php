<?php

namespace Rajesh\Rules\Model;

use Magento\Framework\Model\AbstractModel;

class Rules extends AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Rajesh\Rules\Model\ResourceModel\Rules');
    }
}
