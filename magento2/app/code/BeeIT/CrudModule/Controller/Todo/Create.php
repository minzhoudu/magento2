<?php

namespace BeeIT\CrudModule\Controller\Todo;

use BeeIT\CrudModule\Model\TodoItem;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\RequestInterface;

class create implements HttpGetActionInterface
{
    protected $model;
    protected $request;

    public function __construct(ObjectManagerInterface $objectManager, RequestInterface $request)
    {
        $this->model = $objectManager->create(TodoItem::class);
        $this->request = $request;
    }

    public function execute(): string
    {
        $message = 'Done';
        $this->model->setData('test123');
        $this->model->save();

        return $message;
    }
}
