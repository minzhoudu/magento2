<?php

namespace BeeIT\CLImodule\Console\Command;

use BeeIT\CrudModule\Model\TodoItemFactory;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends Command
{
    protected TodoItemFactory $_todoItemFactory;

    public function __construct(TodoItemFactory $todoItemFactory)
    {
        $this->_todoItemFactory = $todoItemFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('todocrud:delete')
            ->setDescription('Deletes todo item')
            ->addArgument('id', InputArgument::REQUIRED, 'Todo item ID');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        try {
            $id = $input->getArgument('id');

            $model = $this->_todoItemFactory->create();
            $item = $model->load($id);
            $item->delete();

            $output->writeln('<info>Todo item deleted successfully</info>');
        } catch (\Exception $e) {
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
        }
    }
}
