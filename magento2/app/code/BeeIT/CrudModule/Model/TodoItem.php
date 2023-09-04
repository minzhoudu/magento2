<?php

namespace BeeIT\CrudModule\Model;

use Magento\Framework\Model\AbstractModel;
use BeeIT\CrudModule\Model\ResourceModel\TodoItem as TodoItemResource;

class TodoItem extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(TodoItemResource::class);
    }
}
