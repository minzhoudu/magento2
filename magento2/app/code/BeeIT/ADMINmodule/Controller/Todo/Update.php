<?php

namespace BeeIT\ADMINmodule\Controller\Todo;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use BeeIT\CrudModule\Model\TodoItemFactory;

class Update implements HttpGetActionInterface
{
    const XML_PATH_URL = 'todo_item/general_settings_group/import_url';
    const XML_PATH_UPDATE = 'todo_item/general_settings_group/update_existing_checkbox';

    private ScopeConfigInterface $config;
    protected JsonFactory $resultJsonFactory;
    protected TodoItemFactory $todoItemFactory;

    public function __construct(
        JsonFactory $resultJsonFactory,
        ScopeConfigInterface $config,
        TodoItemFactory $todoItemFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->config = $config;
        $this->todoItemFactory = $todoItemFactory;
    }

    public function getUrl()
    {
        return $this->config->getValue(self::XML_PATH_URL);
    }

    public function shouldUpdate()
    {
        return $this->config->getValue(self::XML_PATH_UPDATE);
    }

    private function fetchData($url)
    {
        $data = file_get_contents($url);
        return json_decode($data);
    }

    public function execute()
    {
        $url = $this->getUrl();
        $shouldUpdate = $this->shouldUpdate();
        $fetchedTodos = $this->fetchData($url);
        $result = $this->resultJsonFactory->create();

        if (!$shouldUpdate) {
            return $result->setData(['status' => 'Not Updated']);
        }

        foreach ($fetchedTodos as $todo) {
            $model = $this->todoItemFactory->create();
            $model->setData('description', $todo->description);
            $model->save();
        }


        return $result->setData(['status'=>'Updated', 'data' => $fetchedTodos]);
    }
}
