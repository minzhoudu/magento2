<?php

namespace BeeIT\CLImodule\Console\Command;

use BeeIT\CrudModule\Model\TodoItemFactory;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowAllCommand extends Command
{
    protected TodoItemFactory $_todoItemFactory;

    public function __construct(TodoItemFactory $todoItemFactory)
    {
        $this->_todoItemFactory = $todoItemFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('todocrud:show-all')
            ->setDescription('Query all todo items');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        try {
            $model = $this->_todoItemFactory->create();
            $items = $model->getCollection();

            if (!$items->getSize()) {
                $output->writeln('<info>No items found.</info>');
                return;
            }

            $output->writeln('<info>ToDo items list:</info>');
            foreach ($items as $item) {
                $output->writeln("ID:" . $item->getData('row_id'));
                $output->writeln("DESCRIPTION:" . $item->getData('description'));
                $output->writeln('===============================');
            }
        } catch (\Exception $e) {
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
        }
    }
}
