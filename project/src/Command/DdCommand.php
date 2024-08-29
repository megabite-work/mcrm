<?php

namespace App\Command;

use App\Repository\UserRepository;
use App\Repository\WebNomenclatureRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'dd',
    description: 'Add a short description for your command',
)]
class DdCommand extends Command
{
    public function __construct(private WebNomenclatureRepository $webNomenclatureRepository, private UserRepository $repo)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
        //     ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ids = $this->repo->findAllUserFavoriteIds(3);
        $favorites = $this->webNomenclatureRepository->findAllUserFavoritesByIds($ids);
        print_r($favorites);
        return Command::SUCCESS;
    }
}
