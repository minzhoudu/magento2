<?php

namespace BeeIT\CrudModule\Model\ResourceModel\TodoItem;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \BeeIT\CrudModule\Model\TodoItem;
use BeeIT\CrudModule\Model\ResourceModel\TodoItem as TodoItemResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            TodoItem::class,
            TodoItemResource::class
        );
    }
}
