<?php

namespace BeeIT\CrudModule\Controller\Todo;

use BeeIT\CrudModule\Model\TodoItemFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Delete implements HttpGetActionInterface
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
        $id = $this->request->getParam('id');

        if ($id) {
            $model = $this->_todoItemFactory->create();
            $item = $model->load($id);
            $item->delete();

            $message = "Todo item with id $id was deleted successfully";
        }

        $resultPage = $this->_pageFactory->create();
        $resultPage
            ->getLayout()
            ->getBlock('crudmodule.custom.block')
            ->setData("message", $message);

        return $resultPage;
    }
}
