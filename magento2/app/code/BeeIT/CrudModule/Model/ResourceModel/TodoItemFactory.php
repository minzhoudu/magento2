<?php

namespace BeeIT\CrudModule\Model\ResourceModel;

use Magento\Framework\ObjectManagerInterface;

class TodoItemFactory
{
    protected ?ObjectManagerInterface $_objectManager = null;

    protected mixed $_instanceName = null;

    public function __construct(ObjectManagerInterface $objectManager, $instanceName = TodoItem::class)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
