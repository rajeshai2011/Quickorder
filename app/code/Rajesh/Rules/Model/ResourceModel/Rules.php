<?php

namespace Rajesh\Rules\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rules extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('catalogrule_product', 'rule_product_id');
    }
}
