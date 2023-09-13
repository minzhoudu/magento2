<?php

namespace BeeIT\RESTmodule\Model;

use BeeIT\RESTmodule\Api\TodoItemRepositoryInterface;
use BeeIT\CrudModule\Model\TodoItemFactory;
use Magento\Framework\App\RequestInterface;

class TodoItemRepository implements TodoItemRepositoryInterface
{

    protected TodoItemFactory $todoItemFactory;
    protected RequestInterface $request;

    public function __construct(TodoItemFactory $todoItemFactory, RequestInterface $request)
    {
        $this->todoItemFactory = $todoItemFactory;
        $this->request = $request;
    }

    public function getAll(): array
    {
        $allItems = [];

        $model = $this->todoItemFactory->create();
        $items = $model->getCollection();

        foreach ($items as $item) {
            $allItems[] = $item->getData();
        }

        return [
            'message'=>"Success",
            'data'=>$allItems
        ];
    }

    public function update(): array
    {
        $id = $this->request->getParam('id');
        $description = $this->request->getParam('description');

        if (!$id || !$description) {
            http_response_code(404);
            return [
                'message'=>"ID or DESCRIPTION is missing"
            ];
        }

        $model = $this->todoItemFactory->create();
        $item = $model->load($id);
        $item->setData('description', $description);
        $item->save();

        http_response_code(200);
        header("Content-type: application/json");

        return [
            'message'=>"Successfully updated item $id",
            'data'=>null
        ];
    }

    public function create(): array
    {
        $description = $this->request->getParam('description');

        if (!$description) {
            $message = "Please add description";
            http_response_code(400);

            return [
                'message'=>$message,
                'data'=>null
            ];
        }

        $model = $this->todoItemFactory->create();
        $model->setData('description', $description);
        $model->save();

        http_response_code(201);
        header("Content-type: application/json");

        return [
            'message'=>"Successfully created item with description $description",
            'data'=>null
        ];
    }

    public function getById(): array
    {
        $id = $this->request->getParam('id');
        $todoItem = $this->todoItemFactory->create();
        $item = $todoItem->load($id);
        $itemData = $item->getData();

        http_response_code(200);
        header("Content-type: application/json");

        return [
            'message'=>"success",
            'data'=>$itemData
        ];
    }

    public function delete(): array
    {
        $message = "Item deleted";
        $id = $this->request->getParam('id');
        $todoItem = $this->todoItemFactory->create();
        $item = $todoItem->load($id);
        $item->delete();

        http_response_code(200);
        header("Content-type: application/json");

        return [
            'msg'=>$message,
            'data'=>null
        ];
    }
}
