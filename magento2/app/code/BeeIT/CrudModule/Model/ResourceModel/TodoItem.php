<?php

namespace BeeIT\CrudModule\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TodoItem extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('beeit_todocrud_todoitem', 'row_id');
    }
}
