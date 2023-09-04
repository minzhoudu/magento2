<?php

namespace BeeIT\CrudModule\Controller\Todo;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

use BeeIT\CrudModule\Model\TodoItemFactory;

class Create implements HttpGetActionInterface
{
    protected RequestInterface $request;
    protected TodoItemFactory $_todoItemFactory;
    protected PageFactory $_pageFactory;

    public function __construct(
        TodoItemFactory $todoItemFactory,
        RequestInterface $request,
        PageFactory $pageFactory
    ) {
        $this->_todoItemFactory = $todoItemFactory;
        $this->request = $request;
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        $message = "Error occurred";
        $description = $this->request->getParam('description');

        if ($description) {
            $model = $this->_todoItemFactory->create();
            $model->setData('description', $description);
            $model->save();
            $message = "Todo item created with description $description";
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage
            ->getLayout()
            ->getBlock('crudmodule.custom.block')
            ->setData("message", $message);

        return $resultPage;
    }
}
