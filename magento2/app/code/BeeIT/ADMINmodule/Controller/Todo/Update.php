<?php

namespace BeeIT\ADMINmodule\Controller\Todo;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\RequestInterface;

use BeeIT\CrudModule\Model\TodoItemFactory;
use BeeIT\ADMINmodule\Logger\CustomLogger;

class Update implements HttpGetActionInterface
{
    const XML_PATH_URL = 'todo_item/general_settings_group/import_url';
    const XML_PATH_UPDATE = 'todo_item/general_settings_group/update_existing_checkbox';

    private ScopeConfigInterface $config;
    protected JsonFactory $resultJsonFactory;
    protected TodoItemFactory $todoItemFactory;
    protected CustomLogger $logger;
    protected RequestInterface $request;

    public function __construct(
        JsonFactory $resultJsonFactory,
        ScopeConfigInterface $config,
        TodoItemFactory $todoItemFactory,
        CustomLogger $logger,
        RequestInterface $request
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->config = $config;
        $this->todoItemFactory = $todoItemFactory;
        $this->logger = $logger;
        $this->request = $request;
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

        $this->logger->info("HTTP verb: {$this->request->getMethod()}");
        $this->logger->info("URL of the request: {$url}");

        if (!$shouldUpdate) {
            $this->logger->alert('Nothing was updated');
            return $result->setData(['status' => 'Not Updated']);
        }

        foreach ($fetchedTodos as $todo) {
            $model = $this->todoItemFactory->create();
            $model->setData('description', $todo->description);
            $model->save();
            $this->logger->info("TODO: {$todo->id} {$todo->description}");
        }


        return $result->setData(['status'=>'Updated', 'data' => $fetchedTodos]);
    }
}
