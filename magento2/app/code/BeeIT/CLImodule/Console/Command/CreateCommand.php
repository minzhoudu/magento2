<?php

namespace BeeIT\CLImodule\Console\Command;

use BeeIT\CrudModule\Model\TodoItemFactory;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    protected TodoItemFactory $_todoItemFactory;

    public function __construct(TodoItemFactory $todoItemFactory)
    {
        $this->_todoItemFactory = $todoItemFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('todocrud:create')
            ->setDescription('Creates new todo item')
            ->addArgument('description', InputArgument::REQUIRED, 'Todo item description');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        try {
            $description = $input->getArgument('description');

            $model = $this->_todoItemFactory->create();
            $model->setData('description', $description);
            $model->save();

            $output->writeln('<info>Todo item created successfully</info>');
        } catch (\Exception $e) {
            $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
        }
    }
}
